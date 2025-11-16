<?php

namespace App\Model\helpdesk\Settings;

use App\Models\BaseModel;

class Responder extends BaseModel
{
    protected $table = 'settings_auto_response';

    public $timestamps = true;

    protected $casts = [];

    protected $guarded = [];

    /* Set fillable fields in table */
    protected $fillable = [
        'id', 'new_ticket', 'agent_new_ticket', 'submitter', 'participants', 'overlimit',
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
