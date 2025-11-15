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
use App\Services\GroupService;
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
     * @var GroupService
     */
    protected $groupService;

    /**
     * Create a new controller instance.
     *
     * @param GroupService $groupService
     * @return type void
     */
    public function __construct(GroupService $groupService)
    {
        $this->middleware('auth');
        $this->middleware('roles');
        $this->groupService = $groupService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param type Department              $department
     * @param type Group_assign_department $group_assign_department
     *
     * @return type Response
     */
    public function index(Department $department, Group_assign_department $group_assign_department)
    {
        try {
            $groups = $this->groupService->getAll();
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
     * @param type GroupRequest $request
     *
     * @return type Response
     */
    public function store(GroupRequest $request)
    {
        try {
            $this->groupService->create($request->all());

            return redirect('groups')->with('success', Lang::get('lang.group_created_successfully'));
        } catch (Exception $e) {
            return $this->redirectWithError('lang.group_can_not_create', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param type int $id
     *
     * @return type Response
     */
    public function edit($id)
    {
        try {
            $groups = $this->groupService->find($id);

            if (!$groups) {
                return $this->redirectWithError('lang.group_can_not_update', 'Group not found');
            }

            return view('themes.default1.admin.helpdesk.agent.groups.edit', compact('groups'));
        } catch (Exception $e) {
            return $this->redirectWithError('lang.group_can_not_update', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param type int                 $id
     * @param type GroupUpdateRequest  $request
     *
     * @return type Response
     */
    public function update($id, GroupUpdateRequest $request)
    {
        try {
            $this->groupService->update($id, $request->all());

            return redirect('groups')->with('success', Lang::get('lang.group_updated_successfully'));
        } catch (Exception $e) {
            return $this->redirectWithError('lang.group_can_not_update', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param type int $id
     *
     * @return type Response
     */
    public function destroy($id)
    {
        try {
            $this->groupService->delete($id);

            return redirect('groups')->with('success', Lang::get('lang.group_deleted_successfully'));
        } catch (Exception $e) {
            return $this->redirectWithError('lang.group_cannot_delete', $e->getMessage());
        }
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
