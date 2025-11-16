<?php

namespace App\Model\helpdesk\Utility;

use App\Models\BaseModel;

class Email extends BaseModel
{
    protected $table = 'email';

    public $timestamps = true;

    protected $casts = [
        'email_fetching' => 'boolean',
        'strip' => 'boolean',
        'all_emails' => 'boolean',
        'email_collaborator' => 'boolean',
        'attachment' => 'boolean',
    ];

    protected $guarded = [];

    /* Set fillable fields in table */
    protected $fillable = [
        'id', 'template', 'sys_email', 'alert_email', 'admin_email', 'mta', 'email_fetching', 'strip',
        'separator', 'all_emails', 'email_collaborator', 'attachment',
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
