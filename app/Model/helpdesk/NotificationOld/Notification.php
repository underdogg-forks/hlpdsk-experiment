<?php

namespace App\Model\helpdesk\Notification;

use App\Models\BaseModel;

class Notification extends BaseModel
{
    protected $table = 'notifications';

    public $timestamps = true;

    protected $casts = [];

    protected $guarded = [];

    protected $fillable = [
        'model_id', 'userid_created', 'type_id',
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

    public function type()
    {
        return $this->belongsTo(\App\Model\helpdesk\Notification\NotificationType::class, 'type_id');
    }

    public function userNotification()
    {
        return $this->hasMany(\App\Model\helpdesk\Notification\UserNotification::class, 'notification_id');
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

    public function scopeByType($query, $typeId)
    {
        return $query->where('type_id', $typeId);
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
