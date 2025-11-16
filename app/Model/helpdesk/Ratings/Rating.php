<?php

namespace App\Model\helpdesk\Ratings;

use App\Models\BaseModel;

class Rating extends BaseModel
{
    protected $table = 'ratings';

    public $timestamps = true;

    protected $casts = [
        'display_order' => 'integer',
        'allow_modification' => 'boolean',
        'rating_scale' => 'integer',
        'restrict' => 'boolean',
    ];

    protected $guarded = [];

    protected $fillable = [

        'name', 'display_order', 'allow_modification', 'rating_scale', 'rating_area', 'restrict',
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

    public function ratingReferences()
    {
        return $this->hasMany(\App\Model\helpdesk\Ratings\RatingRef::class, 'rating_id', 'id');
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

    #endregion
    #region Factory
    /*
    |--------------------------------------------------------------------------
    | Factory
    |--------------------------------------------------------------------------
    */
    #endregion
}
