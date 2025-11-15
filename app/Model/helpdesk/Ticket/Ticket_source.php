<?php

namespace App\Model\helpdesk\Ticket;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Ticket_source extends BaseModel
{
    protected $table = 'ticket_source';

    public $timestamps = false;

    protected $casts = [];

    protected $guarded = [];

    protected $fillable = [
        'name', 'value', 'css_class',
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
     * Get tickets with this source
     */
    public function tickets()
    {
        return $this->hasMany(\App\Model\helpdesk\Ticket\Tickets::class, 'source');
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
