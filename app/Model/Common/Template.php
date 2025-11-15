<?php

namespace App\Model\Common;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Template extends BaseModel
{
    protected $table = 'templates';

    public $timestamps = true;

    protected $casts = [
        'type' => 'integer',
    ];

    protected $guarded = [];

    protected $fillable = ['name', 'message', 'type', 'variable', 'subject', 'set_id'];

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
     * Get the template set this template belongs to
     */
    public function templateSet()
    {
        return $this->belongsTo(\App\Model\Common\TemplateSet::class, 'set_id');
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
     * Scope to get templates by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope to get templates by set
     */
    public function scopeBySet($query, $setId)
    {
        return $query->where('set_id', $setId);
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
