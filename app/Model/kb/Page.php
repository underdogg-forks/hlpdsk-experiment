<?php

namespace App\Model\kb;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Page extends BaseModel
{
    protected $table = 'kb_pages';

    public $timestamps = true;

    protected $casts = [
        'status' => 'integer',
        'visibility' => 'integer',
    ];

    protected $guarded = [];

    protected $fillable = ['name', 'slug', 'status', 'visibility', 'description'];

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

    /**
     * Scope to get active pages
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Scope to get public pages
     */
    public function scopePublic($query)
    {
        return $query->where('visibility', 1);
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
