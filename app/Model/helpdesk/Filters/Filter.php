<?php

namespace App\Model\helpdesk\Filters;

use App\Models\BaseModel;

class Filter extends BaseModel
{
    protected $table = 'filters';

    public $timestamps = true;

    protected $casts = [
        'ticket_id' => 'integer',
    ];

    protected $guarded = [];

    protected $fillable = ['ticket_id', 'key', 'value'];

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

    public function ticket()
    {
        return $this->belongsTo(\App\Model\helpdesk\Ticket\Tickets::class, 'ticket_id', 'id');
    }

    #endregion
    #region Accessors
    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getLabelTitle($ticketid)
    {
        $filter = $this->where('ticket_id', $ticketid)->where('key', 'label')->first();
        $output = [];
        if ($filter && $filter->value) {
            $labelids = explode(',', $filter->value);
            $labels = new Label();
            $label = $labels->whereIn('title', $labelids)->get();
            if ($label->count() > 0) {
                foreach ($label as $key => $l) {
                    $output[$key] = $l->titleWithColor();
                }
            }
        }

        return $output;
    }

    public function getTagsByTicketId($ticketid)
    {
        $filter = $this->where('key', 'tag')->where('ticket_id', $ticketid)->pluck('value')->toArray();

        return $filter;
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

    public function scopeByKey($query, $key)
    {
        return $query->where('key', $key);
    }

    public function scopeByTicket($query, $ticketId)
    {
        return $query->where('ticket_id', $ticketId);
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
