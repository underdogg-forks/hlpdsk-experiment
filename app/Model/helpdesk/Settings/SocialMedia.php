<?php

namespace App\Model\helpdesk\Settings;

use App\Models\BaseModel;

class SocialMedia extends BaseModel
{
    protected $table = 'social_media';

    public $timestamps = true;

    protected $casts = [];

    protected $guarded = [];

    protected $fillable = [
        'provider',
        'key',
        'value',
    ];

    #region Static Methods
    /*
    |--------------------------------------------------------------------------
    | Static Methods
    |--------------------------------------------------------------------------
    */

    public function getvalueByKey($provider, $key = '', $login = true)
    {
        $social = '';
        if ($key == 'redirect' && $login == true) {
            $social = url('social/login/'.$provider);
        }
        if ($key !== '' && $key !== 'redirect') {
            $social = $this->where('provider', $provider)->where('key', $key)->first();
        } elseif ($key !== 'redirect') {
            $social = $this->where('provider', $provider)->pluck('value', 'key')->toArray();
        }
        if (is_object($social)) {
            $social = $social->value;
        }

        return $social;
    }

    public function checkActive($provider)
    {
        $check = '';
        $social = $this->where('provider', $provider)->where('key', 'status')->first();
        if ($social) {
            $value = $social->value;
            if ($value === '1') {
                $check = true;
            }
        }

        return $check;
    }

    public function checkInactive($provider)
    {
        $check = '';
        $social = $this->where('provider', $provider)->where('key', 'status')->first();
        if ($social) {
            $value = $social->value;
            if ($value === '0') {
                $check = true;
            }
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
