<?php

namespace App\Model\helpdesk\Agent;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Teams extends BaseModel
{
    protected $table = 'teams';

    public $timestamps = true;

    protected $casts = [
        'status' => 'boolean',
        'assign_alert' => 'boolean',
    ];

    protected $guarded = [];

    protected $fillable = [
        'name', 'status', 'team_lead', 'assign_alert', 'admin_notes',
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
     * Get team members
     */
    public function members()
    {
        return $this->belongsToMany(\App\User::class, 'team_assign_agent', 'team_id', 'agent_id');
    }

    /**
     * Get team lead
     */
    public function teamLead()
    {
        return $this->belongsTo(\App\User::class, 'team_lead');
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
     * Scope to get active teams
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
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
