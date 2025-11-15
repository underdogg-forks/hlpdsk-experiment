<?php

namespace App\Model\helpdesk\Manage;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Sla_plan extends BaseModel
{
    protected $table = 'sla_plan';

    public $timestamps = true;

    protected $casts = [
        'grace_period' => 'integer',
        'status' => 'integer',
        'transient' => 'integer',
        'ticket_overdue' => 'integer',
    ];

    protected $guarded = [];

    protected $fillable = [
        'name', 'grace_period', 'admin_note', 'status', 'transient', 'ticket_overdue',
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
     * Get help topics using this SLA plan
     */
    public function helpTopics()
    {
        return $this->hasMany(\App\Model\helpdesk\Manage\Help_topic::class, 'sla_plan');
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
     * Scope to get active SLA plans
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
