<?php

namespace App\Model\helpdesk\Settings;

use App\Models\BaseModel;

class CommonSettings extends BaseModel
{
    protected $table = 'common_settings';

    public $timestamps = true;

    protected $casts = [
        'status' => 'integer',
    ];

    protected $guarded = [];

    protected $fillable = [
        'status', 'option_name', 'option_value', 'optional_field', 'created_at', 'updated_at',
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

    public function getStatus($option_name)
    {
        $status = '';
        $schema = $this->where('option_name', $option_name)->first();
        if ($schema) {
            $status = $schema->status;
        }

        return $status;
    }

    public function getOptionValue($option, $field = '')
    {
        $schema = $this->where('option_name', $option);
        if ($field != '') {
            $schema = $schema->where('optional_field', $field);

            return $schema->first();
        }
        $value = $schema->get();

        return $value;
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

    public function scopeByOption($query, $option)
    {
        return $query->where('option_name', $option);
    }

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
