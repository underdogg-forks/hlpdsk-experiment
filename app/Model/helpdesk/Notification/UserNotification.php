<?php

namespace App\Model\helpdesk\Notification;

use App\Models\BaseModel;

class UserNotification extends BaseModel
{
    protected $table = 'user_notification';

    public $timestamps = true;

    protected $casts = [
        'notification_id' => 'integer',
        'user_id' => 'integer',
        'is_read' => 'boolean',
    ];

    protected $guarded = [];

    protected $fillable = [

        'notification_id', 'user_id', 'is_read',
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

    public function notification()
    {
        $related = \App\Model\helpdesk\Notification\Notification::class;
        $id = 'notification_id';

        return $this->belongsTo($related, $id);
    }

    public function users()
    {
        $related = \App\User::class;
        $id = 'user_id';

        return $this->belongsTo($related, $id);
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

    public function scopeUnread($query)
    {
        return $query->where('is_read', 0);
    }

    public function scopeRead($query)
    {
        return $query->where('is_read', 1);
    }

    #endregion
    #region Factory
    /*
    |--------------------------------------------------------------------------
    | Factory
    |--------------------------------------------------------------------------
    */
    #endregion

//    public function delete() {
//        //$this->notification()->delete();
//        parent::delete();
//    }
}
