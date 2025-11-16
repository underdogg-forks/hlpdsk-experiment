<?php

namespace App\Model\helpdesk\Form;

use App\Models\BaseModel;

class Form_name extends BaseModel
{
    protected $table = 'form_name';

    public $timestamps = false;

    protected $casts = [
        'status' => 'integer',
        'no_of_fields' => 'integer',
    ];

    protected $guarded = [];

    protected $fillable = ['id', 'name', 'status', 'no_of_fields'];

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

    public function fields()
    {
        return $this->hasMany(\App\Model\helpdesk\Form\Fields::class, 'forms_id', 'id');
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
