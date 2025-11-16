<?php

namespace App\Model\helpdesk\Ticket;

use App\Models\BaseModel;

class Ticket_Form_Data extends BaseModel
{
    protected $table = 'ticket_form_data';

    public $timestamps = true;

    protected $casts = [
        'ticket_id' => 'integer',
    ];

    protected $guarded = [];

    protected $fillable = ['id', 'ticket_id', 'title', 'content', 'created_at', 'updated_at'];

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

    public function ticket()
    {
        return $this->belongsTo(\App\Model\helpdesk\Ticket\Tickets::class, 'ticket_id', 'id');
    }

    #endregion
    #region Accessors
    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFieldKeyLabel()
    {
        $value = $this->attributes['title'];
        $fields = new \App\Model\helpdesk\Form\Fields();
        $field = $fields->where('name', $value)->first();
        if ($field) {
            $value = $field->label;
        }

        return $value;
    }

    public function isHidden()
    {
        $check = false;
        $value = $this->attributes['title'];
        $fields = new \App\Model\helpdesk\Form\Fields();
        $field = $fields->where('name', $value)->first();
        if ($field && $field->type == 'hidden') {
            $check = true;
        }

        return $check;
    }

    public function getHidden()
    {
        $value = $this->attributes['title'];
        $fields = new \App\Model\helpdesk\Form\Fields();
        $field = $fields->where('name', $value)->first();
        if ($field && $field->type == 'hidden') {
            return $field->label;
        }
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
