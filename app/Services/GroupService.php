<?php

namespace App\Services;

use App\Model\helpdesk\Agent\Groups;
use App\Model\helpdesk\Agent\Group_assign_department;
use App\User;
use Exception;

/**
 * GroupService
 * 
 * Handles business logic for group operations.
 * Separates business logic from controller concerns.
 */
class GroupService
{
    /**
     * Create a new group
     *
     * @param array $data
     * @return Groups
     * @throws Exception
     */
    public function create(array $data)
    {
        try {
            $group = new Groups();
            $group->fill($data);
            $group->save();

            return $group;
        } catch (Exception $e) {
            throw new Exception("Failed to create group: " . $e->getMessage());
        }
    }

    /**
     * Update an existing group
     *
     * @param int $id
     * @param array $data
     * @return Groups
     * @throws Exception
     */
    public function update($id, array $data)
    {
        $group = Groups::find($id);

        if (!$group) {
            throw new Exception("Group not found");
        }

        // Validate group can be deactivated
        if (isset($data['group_status']) && $data['group_status'] == '0') {
            if ($this->hasAssignedAgents($id)) {
                throw new Exception("Cannot deactivate group with assigned agents");
            }
        }

        try {
            $this->updateFields($group, $data);
            $group->save();

            return $group;
        } catch (Exception $e) {
            throw new Exception("Failed to update group: " . $e->getMessage());
        }
    }

    /**
     * Delete a group
     *
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function delete($id)
    {
        // Check if agents are assigned
        if ($this->hasAssignedAgents($id)) {
            throw new Exception("Cannot delete group with assigned agents. Please unassign them first.");
        }

        try {
            // Delete department assignments first
            Group_assign_department::where('group_id', $id)->delete();

            // Delete the group
            $group = Groups::find($id);
            if ($group) {
                return $group->delete();
            }

            return false;
        } catch (Exception $e) {
            throw new Exception("Failed to delete group: " . $e->getMessage());
        }
    }

    /**
     * Check if group has assigned agents
     *
     * @param int $id
     * @return bool
     */
    public function hasAssignedAgents($id)
    {
        return User::where('assign_group', '=', $id)->exists();
    }

    /**
     * Get group by ID
     *
     * @param int $id
     * @return Groups|null
     */
    public function find($id)
    {
        return Groups::find($id);
    }

    /**
     * Get all groups
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Groups::all();
    }

    /**
     * Get active groups
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getActive()
    {
        return Groups::where('group_status', 1)->get();
    }

    /**
     * Update group fields from data array
     *
     * @param Groups $group
     * @param array $data
     * @return void
     */
    private function updateFields(Groups $group, array $data)
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
            if (array_key_exists($field, $data)) {
                $group->$field = $data[$field];
            }
        }
    }
}
