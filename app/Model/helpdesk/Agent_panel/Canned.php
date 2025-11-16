<?php

namespace App\Model\helpdesk\Agent_panel;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Canned extends BaseModel
{
    protected $table = 'canned_response';

    public $timestamps = true;

    protected $casts = [
        'user_id' => 'integer',
    ];

    protected $guarded = [];

    protected $fillable = ['user_id', 'title', 'message', 'created_at', 'updated_at'];

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
     * Get user who created this canned response
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
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
     * Scope to get canned responses by user
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
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
