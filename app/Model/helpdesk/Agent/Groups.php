<?php

namespace App\Model\helpdesk\Agent;

use App\Models\BaseModel;

class Groups extends BaseModel
{
    protected $table = 'groups';

    public $timestamps = true;

    protected $casts = [
        'group_status' => 'integer',
        'can_create_ticket' => 'boolean',
        'can_edit_ticket' => 'boolean',
        'can_post_ticket' => 'boolean',
        'can_close_ticket' => 'boolean',
        'can_assign_ticket' => 'boolean',
        'can_delete_ticket' => 'boolean',
        'can_ban_email' => 'boolean',
        'can_manage_canned' => 'boolean',
        'can_manage_faq' => 'boolean',
        'can_view_agent_stats' => 'boolean',
        'department_access' => 'boolean',
    ];

    protected $guarded = [];

    protected $fillable = [
        'name', 'group_status', 'can_create_ticket', 'can_edit_ticket',
        'can_post_ticket', 'can_close_ticket', 'can_assign_ticket',
        'can_delete_ticket', 'can_ban_email',
        'can_manage_canned', 'can_manage_faq', 'can_view_agent_stats',
        'department_access', 'admin_notes',
    ];

    #region Static Methods
    /*
    |--------------------------------------------------------------------------
    | Static Methods
    |--------------------------------------------------------------------------
    */

    #endregion
    #region Relationships
    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function agents()
    {
        return $this->hasMany(\App\Model\helpdesk\Agent\Agents::class, 'primary_dpt', 'id');
    }

    public function departmentAssignments()
    {
        return $this->hasMany(\App\Model\helpdesk\Agent\Group_assign_department::class, 'group_id', 'id');
    }

    #endregion
    #region Accessors
    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    #endregion
    #region Mutators
    /*
    |--------------------------------------------------------------------------
    | Mutators
    |--------------------------------------------------------------------------
    */

    #endregion
    #region Scopes
    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('group_status', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('group_status', 0);
    }

    #endregion
    #region Factory
    /*
    |--------------------------------------------------------------------------
    | Factory
    |--------------------------------------------------------------------------
    */
    #endregion
}
