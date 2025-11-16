<?php

namespace App\Model\helpdesk\Ticket;

use App\Models\BaseModel;
use File;

class Ticket_ThreadOld extends BaseModel
{
    protected $table = 'ticket_thread';

    public $timestamps = true;

    protected $casts = [];

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
    #region Relationships
    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function attach()
    {
        return $this->hasMany(\App\Model\helpdesk\Ticket\Ticket_attachments::class, 'thread_id');
    }

    #endregion
    #region Accessors
    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
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

    public function setTitleAttribute($value)
    {
        if ($value == '') {
            $this->attributes['title'] = 'No available';
        } else {
            $this->attributes['title'] = $value;
        }
    }

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

    /**
     * Delete with cascade
     */
    public function delete()
    {
        $this->attach()->delete();
        parent::delete();
    }

    public function thread($content)
    {
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
        if ($this->attach()->where('poster', 'INLINE')->get()->count() > 0) {
            $search = $this->attach()->where('poster', 'INLINE')->pluck('name')->toArray();
            foreach ($this->attach()->where('poster', 'INLINE')->get() as $key => $attach) {
                $replace[$key] = "data:$attach->type;base64,".$attach->file;
            }
            $body = str_replace($search, $replace, $body);
        }

        return $body;
    }

    public function getSubject()
    {
        $subject = $this->attributes['title'];
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

    public function labels($ticketid)
    {
        $label = new \App\Model\helpdesk\Filters\Label();

        return $label->assignedLabels($ticketid);
    }
}
