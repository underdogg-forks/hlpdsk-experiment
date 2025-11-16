<?php

namespace App\Model\helpdesk\Form;

use App\Models\BaseModel;

class Fields extends BaseModel
{
    protected $table = 'custom_form_fields';

    public $timestamps = true;

    protected $casts = [
        'forms_id' => 'integer',
        'required' => 'boolean',
    ];

    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['forms_id', 'label', 'name', 'type', 'value', 'required'];

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

    public function valueRelation()
    {
        $related = \App\Model\helpdesk\Form\FieldValue::class;

        return $this->hasMany($related, 'field_id');
    }

    public function values()
    {
        $value = $this->valueRelation();

        return $value;
    }

    public function form()
    {
        return $this->belongsTo(\App\Model\helpdesk\Form\Form_name::class, 'forms_id', 'id');
    }

    #endregion
    #region Accessors
    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function valuesAsString()
    {
        $string = '';
        $values = $this->values()->pluck('field_value')->toArray();
        if (count($values) > 0) {
            $string = implode(',', $values);
        }

        return $string;
    }

    public function requiredFieldForCheck()
    {
        $check = false;
        $required = $this->attributes['required'];
        if ($required === '1') {
            $check = true;
        }

        return $check;
    }

    public function nonRequiredFieldForCheck()
    {
        $check = false;
        $required = $this->attributes['required'];
        if ($required !== '1') {
            $check = true;
        }

        return $check;
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

    public function scopeRequired($query)
    {
        return $query->where('required', '1');
    }

    #endregion
    #region Factory
    /*
    |--------------------------------------------------------------------------
    | Factory
    |--------------------------------------------------------------------------
    */
    #endregion

    public function deleteValues()
    {
        $values = $this->values()->get();
        if ($values->count() > 0) {
            foreach ($values as $value) {
                $value->delete();
            }
        }
    }

    public function delete()
    {
        $this->deleteValues();
        parent::delete();
    }
}
