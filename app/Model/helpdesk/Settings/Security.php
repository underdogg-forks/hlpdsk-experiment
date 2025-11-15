<?php

namespace App\Model\helpdesk\Settings;

use App\Models\BaseModel;

class Security extends BaseModel
{
    /* Using auto_response table  */

    protected $table = 'settings_security';

    public $timestamps = true;

    protected $casts = [
        'backlist_offender' => 'boolean',
        'backlist_threshold' => 'integer',
        'lockout_period' => 'integer',
        'days_to_keep_logs' => 'integer',
    ];

    protected $guarded = [];

    /* Set fillable fields in table */
    protected $fillable = [

        'id', 'lockout_message', 'backlist_offender', 'backlist_threshold', 'lockout_period', 'days_to_keep_logs',
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
