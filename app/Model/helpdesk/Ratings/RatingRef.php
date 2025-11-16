<?php

namespace App\Model\helpdesk\Ratings;

use App\Models\BaseModel;

class RatingRef extends BaseModel
{
    protected $table = 'rating_ref';

    public $timestamps = true;

    protected $casts = [
        'rating_id' => 'integer',
        'ticket_id' => 'integer',
        'thread_id' => 'integer',
        'rating_value' => 'integer',
    ];

    protected $guarded = [];

    protected $fillable = [

        'rating_id', 'ticket_id', 'thread_id', 'rating_value',
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

    public function rating()
    {
        return $this->belongsTo(\App\Model\helpdesk\Ratings\Rating::class, 'rating_id', 'id');
    }

    public function ticket()
    {
        return $this->belongsTo(\App\Model\helpdesk\Ticket\Tickets::class, 'ticket_id', 'id');
    }

    public function thread()
    {
        return $this->belongsTo(\App\Model\helpdesk\Ticket\Ticket_Thread::class, 'thread_id', 'id');
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
