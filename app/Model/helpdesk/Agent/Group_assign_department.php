<?php

namespace App\Model\helpdesk\Agent;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Group_assign_department extends BaseModel
{
    protected $table = 'group_assign_department';

    public $timestamps = true;

    protected $casts = [
        'group_id' => 'integer',
        'department_id' => 'integer',
    ];

    protected $guarded = [];

    protected $fillable = ['group_id', 'department_id'];

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
     * Get group this assignment belongs to
     */
    public function group()
    {
        return $this->belongsTo(\App\Model\helpdesk\Agent\Groups::class, 'group_id');
    }

    /**
     * Get department this assignment belongs to
     */
    public function department()
    {
        return $this->belongsTo(\App\Model\helpdesk\Agent\Department::class, 'department_id');
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
