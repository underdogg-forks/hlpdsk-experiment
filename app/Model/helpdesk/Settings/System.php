<?php

namespace App\Model\helpdesk\Settings;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class System extends BaseModel
{
    protected $table = 'settings_system';

    public $timestamps = true;

    protected $casts = [
        'status' => 'integer',
        'page_size' => 'integer',
        'log_level' => 'integer',
        'api_enable' => 'boolean',
        'api_key_mandatory' => 'boolean',
    ];

    protected $guarded = [];

    protected $fillable = [
        'id', 'status', 'url', 'name', 'department', 'page_size', 'log_level', 'purge_log', 'name_format',
        'time_farmat', 'date_format', 'date_time_format', 'day_date_time', 'time_zone', 'content', 'api_key', 'api_enable', 'api_key_mandatory', 'version',
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

    /**
     * Scope to get active system settings
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
