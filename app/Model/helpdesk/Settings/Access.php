<?php

namespace App\Model\helpdesk\Settings;

use App\Models\BaseModel;

class Access extends BaseModel
{
    protected $table = 'access';

    public $timestamps = true;

    protected $casts = [
        'bind_agent_ip' => 'boolean',
        'quick_access' => 'boolean',
    ];

    protected $guarded = [];

    protected $fillable = [
        'password_expire', 'reg_method', 'user_session',
        'agent_session', 'reset_ticket_expire', 'password_reset',
        'bind_agent_ip', 'reg_require', 'quick_access',
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
