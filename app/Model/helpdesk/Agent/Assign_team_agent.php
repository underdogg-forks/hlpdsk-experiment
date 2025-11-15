<?php

namespace App\Model\helpdesk\Agent;

use App\Models\BaseModel;

class Assign_team_agent extends BaseModel
{
    protected $table = 'team_assign_agent';

    public $timestamps = true;

    protected $casts = [
        'team_id' => 'integer',
        'agent_id' => 'integer',
    ];

    protected $guarded = [];

    protected $fillable = ['id', 'team_id', 'agent_id', 'updated_at', 'created_at'];

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

    public function team()
    {
        return $this->belongsTo(\App\Model\helpdesk\Agent\Teams::class, 'team_id', 'id');
    }

    public function agent()
    {
        return $this->belongsTo(\App\Model\helpdesk\Agent\Agents::class, 'agent_id', 'id');
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
