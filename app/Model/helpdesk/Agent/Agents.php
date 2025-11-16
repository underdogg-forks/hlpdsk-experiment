<?php

namespace App\Model\helpdesk\Agent;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Agents extends BaseModel
{
    protected $table = 'agents';

    public $timestamps = true;

    protected $casts = [
        'account_type' => 'integer',
        'account_status' => 'integer',
        'assign_group' => 'integer',
        'primary_dpt' => 'integer',
        'limit_access' => 'boolean',
        'directory_listing' => 'boolean',
        'vocation_mode' => 'boolean',
        'daylight_save' => 'boolean',
    ];

    protected $guarded = [];

    protected $fillable = [
        'user_name', 'first_name', 'last_name', 'email', 'phone', 'mobile', 'agent_sign',
        'account_type', 'account_status', 'assign_group', 'primary_dpt', 'agent_tzone',
        'daylight_save', 'limit_access', 'directory_listing', 'vocation_mode', 'assign_team',
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
     * Get assigned group
     */
    public function group()
    {
        return $this->belongsTo(\App\Model\helpdesk\Agent\Groups::class, 'assign_group');
    }

    /**
     * Get primary department
     */
    public function primaryDepartment()
    {
        return $this->belongsTo(\App\Model\helpdesk\Agent\Department::class, 'primary_dpt');
    }

    /**
     * Get assigned team
     */
    public function team()
    {
        return $this->belongsTo(\App\Model\helpdesk\Agent\Teams::class, 'assign_team');
    }

    #endregion

    #region Accessors
    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    /**
     * Get full name
     */
    public function getFullNameAttribute()
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

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
     * Scope to get active agents
     */
    public function scopeActive($query)
    {
        return $query->where('account_status', 1);
    }

    /**
     * Scope to get agents on vacation
     */
    public function scopeOnVacation($query)
    {
        return $query->where('vocation_mode', 1);
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
