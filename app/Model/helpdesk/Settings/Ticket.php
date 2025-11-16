<?php

namespace App\Model\helpdesk\Settings;

use App\Models\BaseModel;

class Ticket extends BaseModel
{
    /* Using Ticket table  */

    protected $table = 'settings_ticket';

    public $timestamps = true;

    protected $casts = [
        'num_format' => 'integer',
        'num_sequence' => 'integer',
        'priority' => 'integer',
        'sla' => 'integer',
        'help_topic' => 'integer',
        'max_open_ticket' => 'integer',
        'collision_avoid' => 'integer',
        'lock_ticket_frequency' => 'integer',
        'captcha' => 'boolean',
        'status' => 'integer',
        'claim_response' => 'boolean',
        'assigned_ticket' => 'boolean',
        'answered_ticket' => 'boolean',
        'agent_mask' => 'boolean',
        'html' => 'boolean',
        'client_update' => 'boolean',
        'max_file_size' => 'integer',
    ];

    protected $guarded = [];

    /* Set fillable fields in table */
    protected $fillable = [
        'id', 'num_format', 'num_sequence', 'priority', 'sla', 'help_topic', 'max_open_ticket', 'collision_avoid', 'lock_ticket_frequency',
        'captcha', 'status', 'claim_response', 'assigned_ticket', 'answered_ticket', 'agent_mask', 'html', 'client_update', 'max_file_size',
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
