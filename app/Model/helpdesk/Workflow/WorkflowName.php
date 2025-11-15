<?php

namespace App\Model\helpdesk\Workflow;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class WorkflowName extends BaseModel
{
    protected $table = 'workflow_name';

    public $timestamps = true;

    protected $casts = [
        'status' => 'integer',
        'order' => 'integer',
    ];

    protected $guarded = [];

    protected $fillable = ['id', 'name', 'status', 'order', 'target', 'internal_note', 'updated_at', 'created_at'];

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
     * Get workflow actions
     */
    public function actions()
    {
        return $this->hasMany(\App\Model\helpdesk\Workflow\WorkflowAction::class, 'workflow_id');
    }

    /**
     * Get workflow rules
     */
    public function rules()
    {
        return $this->hasMany(\App\Model\helpdesk\Workflow\WorkflowRules::class, 'workflow_id');
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
     * Scope to get active workflows
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
