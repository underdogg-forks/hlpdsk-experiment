<?php

namespace App\Model\helpdesk\Agent;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Department extends BaseModel
{
    protected $table = 'department';

    public $timestamps = true;

    protected $casts = [
        'type' => 'integer',
        'sla' => 'integer',
        'ticket_assignment' => 'integer',
        'auto_ticket_response' => 'boolean',
        'auto_message_response' => 'boolean',
        'group_access' => 'integer',
    ];

    protected $guarded = [];

    protected $fillable = [
        'name', 'type', 'sla', 'manager', 'ticket_assignment', 'outgoing_email',
        'template_set', 'auto_ticket_response', 'auto_message_response',
        'auto_response_email', 'recipient', 'group_access', 'department_sign',
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

    /**
     * Get tickets belonging to this department
     */
    public function tickets()
    {
        return $this->hasMany(\App\Model\helpdesk\Ticket\Tickets::class, 'dept_id');
    }

    /**
     * Get agents assigned to this department
     */
    public function agents()
    {
        return $this->belongsToMany(\App\User::class, 'department_assign_agents', 'department_id', 'user_id');
    }

    /**
     * Get the manager of this department
     */
    public function manager()
    {
        return $this->belongsTo(\App\User::class, 'manager');
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

    /**
     * Scope to get active departments
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
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
