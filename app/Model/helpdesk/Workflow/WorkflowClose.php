<?php

namespace App\Model\helpdesk\Workflow;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class WorkflowClose extends BaseModel
{
    protected $table = 'workflow_close';

    public $timestamps = true;

    protected $casts = [
        'days' => 'integer',
        'send_email' => 'boolean',
        'status' => 'integer',
    ];

    protected $guarded = [];

    protected $fillable = ['id', 'days', 'condition', 'send_email', 'status', 'updated_at', 'created_at'];

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

    /**
     * Scope to get active workflow close rules
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
