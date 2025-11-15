<?php

namespace App\Model\MailJob;

use App\Models\BaseModel;
use Lang;

class QueueService extends BaseModel
{
    protected $table = 'queue_services';

    public $timestamps = true;

    protected $casts = [
        'status' => 'boolean',
    ];

    protected $guarded = [];

    protected $fillable = ['name', 'short_name', 'status'];

    #region Static Methods
    /*
    |--------------------------------------------------------------------------
    | Static Methods
    |--------------------------------------------------------------------------
    */

    public function getExtraField($key)
    {
        $value = '';
        $setting = $this->extraFieldRelation()->where('key', $key)->first();
        if ($setting) {
            $value = $setting->value;
        }

        return $value;
    }

    public function isActivate()
    {
        $check = true;
        $settings = $this->extraFieldRelation()->get();
        if ($settings->count() == 0) {
            $check = false;
        }

        return $check;
    }

    #endregion

    #region Relationships
    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function extraFieldRelation()
    {
        $related = \App\Model\MailJob\FaveoQueue::class;

        return $this->hasMany($related, 'service_id');
    }

    #endregion

    #region Accessors
    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getName()
    {
        $name = $this->attributes['name'];
        $id = $this->attributes['id'];
        $html = '<a href='.url('queue/'.$id).'>'.$name.'</a>';

        return $html;
    }

    public function getStatus()
    {
        $status = $this->attributes['status'];
        $html = "<span style='color:red'>".Lang::get('lang.inactive').'</span>';
        if ($status == 1) {
            $html = "<span style='color:green'>".Lang::get('lang.active').'</span>';
        }

        return $html;
    }

    public function getAction()
    {
        $id = $this->attributes['id'];
        $status = $this->attributes['status'];
        $html = '<a href='.url('queue/'.$id.'/activate')." class='btn btn-primary'>".Lang::get('lang.activate').'</a>';
        if ($status == 1) {
            $html = "<a href='#' class='btn btn-primary' disabled>".Lang::get('lang.activate').'</a>';
        }

        return $html;
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
