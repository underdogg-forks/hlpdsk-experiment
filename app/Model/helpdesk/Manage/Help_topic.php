<?php

namespace App\Model\helpdesk\Manage;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Help_topic extends BaseModel
{
    protected $table = 'help_topic';

    public $timestamps = true;

    protected $casts = [
        'parent_topic' => 'integer',
        'custom_form' => 'integer',
        'department' => 'integer',
        'ticket_status' => 'integer',
        'priority' => 'integer',
        'sla_plan' => 'integer',
        'status' => 'integer',
        'type' => 'integer',
        'auto_assign' => 'boolean',
        'auto_response' => 'boolean',
    ];

    protected $guarded = [];

    protected $fillable = [
        'id', 'topic', 'parent_topic', 'custom_form', 'department', 'ticket_status', 'priority',
        'sla_plan', 'thank_page', 'ticket_num_format', 'internal_notes', 'status', 'type', 'auto_assign',
        'auto_response',
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
     * Get department this help topic belongs to
     */
    public function department()
    {
        return $this->belongsTo(\App\Model\helpdesk\Agent\Department::class, 'department');
    }

    /**
     * Get tickets using this help topic
     */
    public function tickets()
    {
        return $this->hasMany(\App\Model\helpdesk\Ticket\Tickets::class, 'help_topic_id');
    }

    /**
     * Get parent help topic
     */
    public function parentTopic()
    {
        return $this->belongsTo(\App\Model\helpdesk\Manage\Help_topic::class, 'parent_topic');
    }

    /**
     * Get child help topics
     */
    public function childTopics()
    {
        return $this->hasMany(\App\Model\helpdesk\Manage\Help_topic::class, 'parent_topic');
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
     * Scope to get active help topics
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
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
