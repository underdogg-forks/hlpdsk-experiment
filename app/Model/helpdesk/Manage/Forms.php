<?php

namespace App\Model\helpdesk\Manage;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Forms extends BaseModel
{
    protected $table = 'forms';

    public $timestamps = true;

    protected $casts = [
        'type' => 'integer',
        'visibility' => 'integer',
    ];

    protected $guarded = [];

    protected $fillable = ['id', 'title', 'instruction', 'label', 'type', 'visibility', 'variable', 'internal_notes'];

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
     * Scope to get forms by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
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
