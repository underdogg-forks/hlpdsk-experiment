<?php

namespace App\Model\helpdesk\Email;

use App\Models\BaseModel;

class Emails extends BaseModel
{
    protected $table = 'emails';

    public $timestamps = true;

    protected $casts = [
        'department' => 'integer',
        'priority' => 'integer',
        'help_topic' => 'integer',
        'fetching_port' => 'integer',
        'sending_port' => 'integer',
        'auto_response' => 'boolean',
        'fetching_status' => 'boolean',
        'move_to_folder' => 'boolean',
        'delete_email' => 'boolean',
        'do_nothing' => 'boolean',
        'sending_status' => 'boolean',
        'authentication' => 'boolean',
        'header_spoofing' => 'boolean',
        'imap_config' => 'boolean',
    ];

    protected $guarded = [];

    protected $fillable = [
        'email_address', 'email_name', 'department', 'priority', 'help_topic',
        'user_name', 'password', 'fetching_host', 'fetching_port', 'fetching_protocol', 'fetching_encryption', 'mailbox_protocol',
        'folder', 'sending_host', 'sending_port', 'sending_protocol', 'sending_encryption', 'internal_notes', 'auto_response',
        'fetching_status', 'move_to_folder', 'delete_email', 'do_nothing',
        'sending_status', 'authentication', 'header_spoofing', 'imap_config',
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

    public function extraFieldRelation()
    {
        $related = \App\Model\MailJob\FaveoMail::class;

        return $this->hasMany($related, 'email_id');
    }

    #endregion
    #region Accessors
    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getCurrentDrive()
    {
        $drive = $this->attributes['sending_protocol'];
        $mailServices = new \App\Model\MailJob\MailService();
        $id = '';
        $mailService = $mailServices->where('short_name', $drive)->first();
        if ($mailService) {
            $id = $mailService->id;
        }

        return $id;
    }

    public function getExtraField($key)
    {
        $value = '';
        $id = $this->attributes['id'];
        $services = new \App\Model\MailJob\FaveoMail();
        $service = $services->where('email_id', $id)->where('key', $key)->first();
        if ($service) {
            $value = $service->value;
        }

        return $value;
    }

    public function getPasswordAttribute($value)
    {
        try {
            if ($value) {
                return \Crypt::decrypt($value);
            }
        } catch (\Exception $e) {
            return;
        }

        return $value;
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

    public function scopeActive($query)
    {
        return $query->where('fetching_status', 1);
    }

    #endregion
    #region Factory
    /*
    |--------------------------------------------------------------------------
    | Factory
    |--------------------------------------------------------------------------
    */
    #endregion

    public function deleteExtraFields()
    {
        $fields = $this->extraFieldRelation()->get();
        if ($fields->count() > 0) {
            foreach ($fields as $field) {
                $field->delete();
            }
        }
    }

    public function delete()
    {
        $this->deleteExtraFields();
        parent::delete();
    }
}
