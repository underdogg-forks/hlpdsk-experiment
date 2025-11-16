<?php

namespace App\Model\helpdesk\Settings;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Alert extends BaseModel
{
    protected $table = 'settings_alert_notice';

    public $timestamps = true;

    protected $casts = [
        'ticket_status' => 'boolean',
        'ticket_admin_email' => 'boolean',
        'ticket_department_manager' => 'boolean',
        'message_status' => 'boolean',
        'internal_status' => 'boolean',
        'assignment_status' => 'boolean',
        'transfer_status' => 'boolean',
        'overdue_status' => 'boolean',
        'system_error' => 'boolean',
        'sql_error' => 'boolean',
        'excessive_failure' => 'boolean',
    ];

    protected $guarded = [];

    protected $fillable = [
        'id', 'ticket_status', 'ticket_admin_email', 'ticket_department_manager',
        'ticket_organization_accmanager', 'message_status', 'message_last_responder', 'message_assigned_agent',
        'message_department_manager', 'message_organization_accmanager', 'internal_status', 'internal_last_responder',
        'internal_assigned_agent', 'internal_department_manager', 'assignment_status', 'assignment_assigned_agent',
        'assignment_team_leader', 'assignment_team_member', 'transfer_status', 'transfer_assigned_agent', 'transfer_department_manager',
        'transfer_department_member', 'overdue_status', 'overdue_assigned_agent', 'overdue_department_manager',
        'overdue_department_member', 'system_error', 'sql_error', 'excessive_failure',
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

    #endregion

    #region Factory
    /*
    |--------------------------------------------------------------------------
    | Factory
    |--------------------------------------------------------------------------
    */
    #endregion
}
