<?php

namespace App\Http\Controllers\Admin\helpdesk;

// controllers
use App\Http\Controllers\Controller;
// requests
use App\Http\Requests\helpdesk\GroupRequest;
use App\Http\Requests\helpdesk\GroupUpdateRequest;
use App\Model\helpdesk\Agent\Department;
// models
use App\Model\helpdesk\Agent\Group_assign_department;
use App\Model\helpdesk\Agent\Groups;
use App\User;
use Exception;
// classes
use Illuminate\Http\Request;
use Lang;

/**
 * GroupController.
 *
 * @author      Ladybird <info@ladybirdweb.com>
 */
class GroupController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return type void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roles');
    }

    /**
     * Display a listing of the resource.
     *
     * @param type Groups                  $group
     * @param type Department              $department
     * @param type Group_assign_department $group_assign_department
     *
     * @return type Response
     */
    public function index(Groups $group, Department $department, Group_assign_department $group_assign_department)
    {
        try {
            $groups = $group->get();
            $departments = $department->pluck('id');

            return view('themes.default1.admin.helpdesk.agent.groups.index', compact('departments', 'group_assign_department', 'groups'));
        } catch (Exception $e) {
            return $this->redirectWithError('lang.failed_to_load_the_page');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return type Response
     */
    public function create()
    {
        try {
            return view('themes.default1.admin.helpdesk.agent.groups.create');
        } catch (Exception $e) {
            return $this->redirectWithError('lang.failed_to_load_the_page');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param type Groups       $group
     * @param type GroupRequest $request
     *
     * @return type Response
     */
    public function store(Groups $group, GroupRequest $request)
    {
        try {
            $group->fill($request->input())->save();

            return redirect('groups')->with('success', Lang::get('lang.group_created_successfully'));
        } catch (Exception $e) {
            return $this->redirectWithError('lang.group_can_not_create', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param type int    $id
     * @param type Groups $group
     *
     * @return type Response
     */
    public function edit($id, Groups $group)
    {
        try {
            $groups = $group->whereId($id)->first();

            return view('themes.default1.admin.helpdesk.agent.groups.edit', compact('groups'));
        } catch (Exception $e) {
            return $this->redirectWithError('lang.group_can_not_update', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param type int     $id
     * @param type Groups  $group
     * @param type Request $request
     *
     * @return type Response
     */
    public function update($id, Groups $group, GroupUpdateRequest $request)
    {
        $var = $group->whereId($id)->first();
        
        if (!$var) {
            return $this->redirectWithError('lang.group_can_not_update', 'Group not found');
        }

        // Early return: Check if group is assigned and trying to deactivate
        if ($this->isGroupAssignedAndInactivating($id, $request)) {
            return $this->redirectWithError('lang.group_can_not_update', Lang::get('lang.can-not-inactive-group'));
        }

        try {
            $this->updateGroupFields($var, $request);
            $var->save();

            return redirect('groups')->with('success', Lang::get('lang.group_updated_successfully'));
        } catch (Exception $e) {
            return $this->redirectWithError('lang.group_can_not_update', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param type int                     $id
     * @param type Groups                  $group
     * @param type Group_assign_department $group_assign_department
     *
     * @return type Response
     */
    public function destroy($id, Groups $group, Group_assign_department $group_assign_department)
    {
        // Early return: Check if agents are assigned
        if ($this->hasAssignedAgents($id)) {
            $message = '<li>'.Lang::get('lang.there_are_agents_assigned_to_this_group_please_unassign_them_from_this_group_to_delete').'</li>';
            return redirect('groups')->with('fails', Lang::get('lang.group_cannot_delete').$message);
        }

        try {
            $group_assign_department->where('group_id', $id)->delete();
            $groups = $group->whereId($id)->first();
            $groups->delete();

            return redirect('groups')->with('success', Lang::get('lang.group_deleted_successfully'));
        } catch (Exception $e) {
            return $this->redirectWithError('lang.group_cannot_delete', $e->getMessage());
        }
    }

    /**
     * Check if group has agents assigned and is being inactivated
     *
     * @param int     $id
     * @param Request $request
     * @return bool
     */
    private function isGroupAssignedAndInactivating($id, $request)
    {
        $is_group_assigned = User::select('id')->where('assign_group', '=', $id)->count();
        return $is_group_assigned >= 1 && $request->input('group_status') == '0';
    }

    /**
     * Update group fields from request
     *
     * @param Groups  $group
     * @param Request $request
     * @return void
     */
    private function updateGroupFields($group, $request)
    {
        $fields = [
            'name',
            'group_status',
            'can_create_ticket',
            'can_edit_ticket',
            'can_post_ticket',
            'can_close_ticket',
            'can_assign_ticket',
            'can_delete_ticket',
            'can_ban_email',
            'can_manage_canned',
            'can_manage_faq',
            'can_view_agent_stats',
            'department_access',
            'admin_notes',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                $group->$field = $request->input($field);
            }
        }
    }

    /**
     * Check if group has assigned agents
     *
     * @param int $id
     * @return bool
     */
    private function hasAssignedAgents($id)
    {
        return User::where('assign_group', '=', $id)->exists();
    }

    /**
     * Redirect back with error message
     *
     * @param string $langKey
     * @param string $details
     * @return \Illuminate\Http\RedirectResponse
     */
    private function redirectWithError($langKey, $details = '')
    {
        $message = Lang::get($langKey);
        if ($details) {
            $message .= '<li>'.$details.'</li>';
        }
        return redirect('groups')->with('fails', $message);
    }
}
