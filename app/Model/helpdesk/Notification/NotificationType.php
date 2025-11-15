<?php

namespace App\Model\helpdesk\Notification;

use App\Models\BaseModel;

class NotificationType extends BaseModel
{
    protected $table = 'notification_types';

    public $timestamps = true;

    protected $casts = [];

    protected $guarded = [];

    protected $fillable = [

        'message', 'type', 'icon_class',
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

    public function notifications()
    {
        return $this->hasMany(\App\Model\helpdesk\Notification\Notification::class, 'type_id', 'id');
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
