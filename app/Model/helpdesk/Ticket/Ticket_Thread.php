<?php

namespace App\Model\helpdesk\Ticket;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Ticket_Thread extends BaseModel
{
    protected $table = 'ticket_thread';

    public $timestamps = true;

    protected $casts = [
        'ticket_id' => 'integer',
        'staff_id' => 'integer',
        'user_id' => 'integer',
        'thread_type' => 'integer',
        'source' => 'integer',
        'is_internal' => 'boolean',
    ];

    protected $guarded = [];

    protected $fillable = [
        'id', 'ticket_id', 'staff_id', 'user_id', 'thread_type', 'poster', 'source', 'is_internal', 'title', 'body', 'format', 'ip_address', 'created_at', 'updated_at',
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
     * Get ticket this thread belongs to
     */
    public function ticket()
    {
        return $this->belongsTo(\App\Model\helpdesk\Ticket\Tickets::class, 'ticket_id');
    }

    /**
     * Get attachments for this thread
     */
    public function attach()
    {
        return $this->hasMany(\App\Model\helpdesk\Ticket\Ticket_attachments::class, 'thread_id');
    }

    /**
     * Get user who posted this thread
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    /**
     * Get staff member who posted this thread
     */
    public function staff()
    {
        return $this->belongsTo(\App\User::class, 'staff_id');
    }

    #endregion

    #region Accessors
    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    /**
     * Get title with quotes replaced
     */
    public function getTitleAttribute($value)
    {
        return str_replace('"', "'", $value);
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
     * Scope to get internal threads
     */
    public function scopeInternal($query)
    {
        return $query->where('is_internal', 1);
    }

    /**
     * Scope to get public threads
     */
    public function scopePublic($query)
    {
        return $query->where('is_internal', 0);
    }

    #endregion

    #region Factory
    /*
    |--------------------------------------------------------------------------
    | Factory
    |--------------------------------------------------------------------------
    */
    #endregion

    /**
     * Override delete to cascade attachments
     */
    public function delete()
    {
        $this->attach()->delete();
        return parent::delete();
    }
}

        //return $content;
        return $this->purify($content);
    }

    public function purifyOld($value)
    {
        require_once base_path('vendor'.DIRECTORY_SEPARATOR.'htmlpurifier'.DIRECTORY_SEPARATOR.'library'.DIRECTORY_SEPARATOR.'HTMLPurifier.auto.php');
        $path = base_path('vendor'.DIRECTORY_SEPARATOR.'htmlpurifier'.DIRECTORY_SEPARATOR.'library'.DIRECTORY_SEPARATOR.'HTMLPurifier'.DIRECTORY_SEPARATOR.'DefinitionCache'.DIRECTORY_SEPARATOR.'Serializer');
        if (!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        $config = \HTMLPurifier_Config::createDefault();
        $config->set('HTML.Trusted', true);
        $config->set('Filter.YouTube', true);

        $purifier = new \HTMLPurifier($config);
        if ($value != strip_tags($value)) {
            $value = $purifier->purify($value);
        }

        return $value;
    }

    public function purify()
    {
        $value = $this->attributes['body'];
        $str = str_replace("'", '"', $value);
        $html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $str);
        $string = trim(preg_replace('/\s+/', ' ', $html));
        $content = $this->inlineAttachment($string);

        return $content;
    }

    public function setTitleAttribute($value)
    {
        if ($value == '') {
            $this->attributes['title'] = 'No available';
        } else {
            $this->attributes['title'] = $value;
        }
    }

    public function removeScript($html)
    {
        $doc = new \DOMDocument();

        // load the HTML string we want to strip
        $doc->loadHTML($html);

        // get all the script tags
        $script_tags = $doc->getElementsByTagName('script');

        $length = $script_tags->length;

        // for each tag, remove it from the DOM
        for ($i = 0; $i < $length; $i++) {
            $script_tags->item($i)->parentNode->removeChild($script_tags->item($i));
        }

        // get the HTML string back
        $no_script_html_string = $doc->saveHTML();

        return $no_script_html_string;
    }

    public function firstContent()
    {
        $poster = $this->attributes['poster'];
        if ($poster == 'client') {
            return 'yes';
        }

        return 'no';
    }

    public function inlineAttachment($body)
    {
        $attachments = $this->attach;
        if ($attachments->count() > 0) {
            foreach ($attachments as $key => $attach) {
                if ($attach->poster == 'INLINE' || $attach->poster == 'inline') {
                    $search = $attach->name;
                    $replace = "data:$attach->type;base64,".$attach->file;
                    $b = str_replace($search, $replace, $body);
                    $body = $b;
                }
            }
        }

        return $body;
    }

    public function getSubject()
    {
        $subject = strip_tags($this->attributes['title']);
        $array = imap_mime_header_decode($subject);
        $title = '';
        if (is_array($array) && count($array) > 0) {
            foreach ($array as $text) {
                $title .= $text->text;
            }

            return wordwrap($title, 70, "<br>\n");
        }

        return wordwrap($subject, 70, "<br>\n");
    }

    public function user()
    {
        $related = \App\User::class;
        $foreignKey = 'user_id';

        return $this->belongsTo($related, $foreignKey);
    }
}
