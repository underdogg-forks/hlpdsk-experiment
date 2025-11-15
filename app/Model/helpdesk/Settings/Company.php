<?php

namespace App\Model\helpdesk\Settings;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Company extends BaseModel
{
    protected $table = 'settings_company';

    public $timestamps = true;

    protected $casts = [
        'use_logo' => 'boolean',
    ];

    protected $guarded = [];

    protected $fillable = [
        'company_name', 'website', 'phone', 'address', 'landing_page', 'offline_page',
        'thank_page', 'logo', 'use_logo',
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
