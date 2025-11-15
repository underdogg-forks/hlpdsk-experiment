<?php

namespace App\Model\helpdesk\Ticket;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Tickets extends BaseModel
{
    protected $table = 'tickets';

    public $timestamps = true;

    protected $casts = [
        'user_id' => 'integer',
        'priority_id' => 'integer',
        'sla' => 'integer',
        'help_topic_id' => 'integer',
        'status' => 'integer',
        'source' => 'integer',
        'isoverdue' => 'boolean',
        'reopened' => 'boolean',
        'isanswered' => 'boolean',
        'is_deleted' => 'boolean',
        'closed' => 'boolean',
        'is_transfer' => 'boolean',
        'assigned_to' => 'integer',
    ];

    protected $guarded = [];

    protected $fillable = [
        'id', 'ticket_number', 'num_sequence', 'user_id', 'priority_id', 'sla', 
        'help_topic_id', 'max_open_ticket', 'captcha', 'status', 'lock_by', 
        'lock_at', 'source', 'isoverdue', 'reopened', 'isanswered', 'is_deleted', 
        'closed', 'is_transfer', 'transfer_at', 'reopened_at', 'duedate', 
        'closed_at', 'last_message_at', 'last_response_at', 'created_at', 
        'updated_at', 'assigned_to', 'dept_id'
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
     * Get ticket threads
     */
    public function thread()
    {
        return $this->hasMany(\App\Model\helpdesk\Ticket\Ticket_Thread::class, 'ticket_id');
    }

    /**
     * Get ticket collaborators
     */
    public function collaborator()
    {
        return $this->hasMany(\App\Model\helpdesk\Ticket\Ticket_Collaborator::class, 'ticket_id');
    }

    /**
     * Get help topic
     */
    public function helptopic()
    {
        return $this->belongsTo(\App\Model\helpdesk\Manage\Help_topic::class, 'help_topic_id');
    }

    /**
     * Get form data
     */
    public function formdata()
    {
        return $this->hasMany(\App\Model\helpdesk\Ticket\Ticket_Form_Data::class, 'ticket_id');
    }

    /**
     * Get user who created the ticket
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    /**
     * Get assigned agent
     */
    public function assignedAgent()
    {
        return $this->belongsTo(\App\User::class, 'assigned_to');
    }

    /**
     * Get department
     */
    public function department()
    {
        return $this->belongsTo(\App\Model\helpdesk\Agent\Department::class, 'dept_id');
    }

    /**
     * Get priority
     */
    public function priority()
    {
        return $this->belongsTo(\App\Model\helpdesk\Ticket\Ticket_Priority::class, 'priority_id', 'priority_id');
    }

    /**
     * Get ticket source
     */
    public function ticketSource()
    {
        return $this->belongsTo(\App\Model\helpdesk\Ticket\Ticket_source::class, 'source');
    }

    #endregion

    #region Accessors
    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    /**
     * Get extra form fields
     */
    public function getExtraFieldsAttribute()
    {
        if (isset($this->attributes['id'])) {
            return \App\Model\helpdesk\Ticket\Ticket_Form_Data::where('ticket_id', '=', $this->attributes['id'])->get();
        }
        return collect([]);
    }

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
     * Scope to get open tickets
     */
    public function scopeOpen($query)
    {
        return $query->where('closed', 0);
    }

    /**
     * Scope to get closed tickets
     */
    public function scopeClosed($query)
    {
        return $query->where('closed', 1);
    }

    /**
     * Scope to get overdue tickets
     */
    public function scopeOverdue($query)
    {
        return $query->where('isoverdue', 1);
    }

    /**
     * Scope to get answered tickets
     */
    public function scopeAnswered($query)
    {
        return $query->where('isanswered', 1);
    }

    /**
     * Scope to get deleted tickets
     */
    public function scopeDeleted($query)
    {
        return $query->where('is_deleted', 1);
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
