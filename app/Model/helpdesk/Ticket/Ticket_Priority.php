<?php

namespace App\Model\helpdesk\Ticket;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Ticket_Priority extends BaseModel
{
    protected $primaryKey = 'priority_id';

    protected $table = 'ticket_priority';

    public $timestamps = false;

    protected $casts = [
        'status' => 'integer',
        'user_priority_status' => 'integer',
        'priority_urgency' => 'integer',
        'ispublic' => 'boolean',
    ];

    protected $guarded = [];

    protected $fillable = [
        'priority_id', 'priority', 'status', 'user_priority_status', 'priority_desc', 'priority_color', 'priority_urgency', 'ispublic', 'created_at', 'updated_at',
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
     * Get tickets with this priority
     */
    public function tickets()
    {
        return $this->hasMany(\App\Model\helpdesk\Ticket\Tickets::class, 'priority_id', 'priority_id');
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
     * Scope to get active priorities
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Scope to get public priorities
     */
    public function scopePublic($query)
    {
        return $query->where('ispublic', 1);
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
