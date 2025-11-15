<?php

namespace App\Model\helpdesk\Workflow;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class WorkflowAction extends BaseModel
{
    protected $table = 'workflow_action';

    public $timestamps = false;

    protected $casts = [];

    protected $guarded = [];

    protected $fillable = ['id', 'workflow_id', 'condition', 'action', 'updated_at', 'created_at'];

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
     * Get workflow this action belongs to
     */
    public function workflow()
    {
        return $this->belongsTo(\App\Model\helpdesk\Workflow\WorkflowName::class, 'workflow_id');
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

    #endregion

    #region Factory
    /*
    |--------------------------------------------------------------------------
    | Factory
    |--------------------------------------------------------------------------
    */
    #endregion
}
