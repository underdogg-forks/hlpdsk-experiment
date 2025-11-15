<?php

namespace App\Model\kb;

use App\Models\BaseModel;

class Settings extends BaseModel
{
    /**
     * @param $table, $fillable
     */
    protected $table = 'kb_settings';

    public $timestamps = true;

    protected $casts = [
        'pagination' => 'integer',
        'port' => 'integer',
    ];

    protected $guarded = [];

    protected $fillable = ['language', 'dateformat', 'company_name', 'website', 'phone', 'address', 'logo', 'timezone',
        'background', 'version', 'pagination', 'port', 'host', 'encryption', 'email', 'password', ];

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
