<?php

namespace App\Model\kb;

use App\Models\BaseModel;

class Social extends BaseModel
{
    protected $table = 'social';

    public $timestamps = true;

    protected $casts = [];

    protected $guarded = [];

    protected $fillable = ['linkedin', 'stumble', 'google', 'deviantart', 'flickr', 'skype', 'rss', 'twitter', 'facebook', 'youtube', 'vimeo', 'pinterest', 'dribbble', 'instagram'];

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
