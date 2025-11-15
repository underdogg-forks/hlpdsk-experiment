<?php

namespace App\Model\helpdesk\Form;

use App\Models\BaseModel;

class FieldValue extends BaseModel
{
    protected $table = 'field_values';

    public $timestamps = true;

    protected $casts = [];

    protected $guarded = [];

    protected $fillable = ['field_id', 'child_id', 'field_key', 'field_value'];

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

    public function childId()
    {
        $childid = '';
        $child = $this->attributes['child_id'];
        if ($child) {
            $childid = $this->attributes['child_id'];
        }

        return $childid;
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
