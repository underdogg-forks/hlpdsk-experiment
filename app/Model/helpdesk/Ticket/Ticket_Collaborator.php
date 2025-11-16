<?php

namespace App\Model\helpdesk\Ticket;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Ticket_Collaborator extends BaseModel
{
    protected $table = 'ticket_collaborator';

    public $timestamps = true;

    protected $casts = [
        'isactive' => 'boolean',
        'ticket_id' => 'integer',
        'user_id' => 'integer',
    ];

    protected $guarded = [];

    protected $fillable = [
        'id', 'isactive', 'ticket_id', 'user_id', 'role', 'updated_at', 'created_at',
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

    /**
     * Get ticket this collaborator belongs to
     */
    public function ticket()
    {
        return $this->belongsTo(\App\Model\helpdesk\Ticket\Tickets::class, 'ticket_id');
    }

    /**
     * Get user who is the collaborator
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
     * Scope to get active collaborators
     */
    public function scopeActive($query)
    {
        return $query->where('isactive', 1);
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
