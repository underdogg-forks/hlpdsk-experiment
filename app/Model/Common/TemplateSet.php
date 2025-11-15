<?php

namespace App\Model\Common;

use App\Models\BaseModel;

class TemplateSet extends BaseModel
{
    protected $table = 'template_sets';

    public $timestamps = true;

    protected $casts = [
        'active' => 'boolean',
    ];

    protected $guarded = [];

    protected $fillable = ['name', 'active'];

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

    /**
     * Get templates in this set
     */
    public function templates()
    {
        return $this->hasMany(\App\Model\Common\Template::class, 'set_id');
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

    /**
     * Scope to get active template sets
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
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
