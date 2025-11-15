<?php

namespace App\Models;

use App\Models\BaseModel;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Groups Model
 * 
 * Represents agent groups with their permissions and settings.
 */
class Group extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'groups';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'group_status' => 'boolean',
        'can_create_ticket' => 'boolean',
        'can_edit_ticket' => 'boolean',
        'can_post_ticket' => 'boolean',
        'can_close_ticket' => 'boolean',
        'can_assign_ticket' => 'boolean',
        'can_delete_ticket' => 'boolean',
        'can_ban_email' => 'boolean',
        'can_manage_canned' => 'boolean',
        'can_manage_faq' => 'boolean',
        'can_view_agent_stats' => 'boolean',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    #region Static Methods
    /*
    |--------------------------------------------------------------------------
    | Static Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Check if a group exists by ID
     *
     * @param int $id
     * @return bool
     */
    public static function existsById($id)
    {
        return static::where('id', $id)->exists();
    }

    #endregion

    #region Relationships
    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Get the users assigned to this group
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'assign_group');
    }

    /**
     * Get the department assignments for this group
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departmentAssignments()
    {
        return $this->hasMany(\App\Model\helpdesk\Agent\Group_assign_department::class, 'group_id');
    }

    #endregion

    #region Accessors
    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    /**
     * Get the group's active status as a readable string
     *
     * @return string
     */
    public function getStatusTextAttribute()
    {
        return $this->group_status ? 'Active' : 'Inactive';
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
     * Scope a query to only include active groups
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('group_status', 1);
    }

    /**
     * Scope a query to only include inactive groups
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInactive($query)
    {
        return $query->where('group_status', 0);
    }

    /**
     * Scope to check if group has assigned agents
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasAssignedAgents($query)
    {
        return $query->whereHas('users');
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
