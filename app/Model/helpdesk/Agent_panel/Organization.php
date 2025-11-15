<?php

namespace App\Model\helpdesk\Agent_panel;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Organization extends BaseModel
{
    protected $table = 'organization';

    public $timestamps = true;

    protected $casts = [];

    protected $guarded = [];

    protected $fillable = ['id', 'name', 'phone', 'website', 'address', 'head', 'internal_notes'];

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
     * Get user relations for this organization
     */
    public function userRelation()
    {
        return $this->hasMany(\App\Model\helpdesk\Agent_panel\User_org::class, 'org_id');
    }

    /**
     * Get organization head
     */
    public function head()
    {
        return $this->belongsTo(\App\User::class, 'head');
    }

    #endregion

    #region Accessors
    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    /**
     * Get user IDs for this organization
     */
    public function getUserIds()
    {
        return $this->userRelation()->pluck('user_id')->toArray();
    }

    /**
     * Get users query for this organization
     */
    public function users()
    {
        $user_ids = $this->getUserIds();
        return \App\User::whereIn('id', $user_ids);
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

    #endregion

    #region Factory
    /*
    |--------------------------------------------------------------------------
    | Factory
    |--------------------------------------------------------------------------
    */
    #endregion
}
