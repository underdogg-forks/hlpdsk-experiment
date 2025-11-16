<?php

namespace App\Model\helpdesk\Filters;

use App\Models\BaseModel;
use Lang;

class Label extends BaseModel
{
    protected $table = 'labels';

    public $timestamps = true;

    protected $casts = [
        'order' => 'integer',
        'status' => 'integer',
    ];

    protected $guarded = [];

    protected $fillable = ['title', 'color', 'order', 'status'];

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

    #endregion
    #region Accessors
    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function titleWithColor()
    {
        $title = $this->title;
        $color = $this->color;
        if ($title && $color) {
            return "<span class='label' style='background-color:".$color."; color: #FFF;'>".$title.'</span>';
        } else {
            return '--';
        }
    }

    public function status()
    {
        $status = $this->status;
        $output = Lang::get('lang.disabled');
        if ($status == 1) {
            $output = Lang::get('lang.enabled');
        }

        return $output;
    }

    public function isChecked($ticketid)
    {
        $title = $this->attributes['title'];
        $output = '';
        $filters = new Filter();
        $filter = $filters
                ->where('ticket_id', $ticketid)
                ->where('key', 'label')
                ->where('value', $title)
                ->first();
        if ($filter && $filter->value) {
            $output = 'checked';
        }

        return $output;
    }

    public function assignedLabels($ticketid)
    {
        $output = '';
        $filters = new Filter();
        $filter = $filters->where('ticket_id', $ticketid)->where('key', 'label')->select('value')->get();
        if (count($filter) > 0) {
            foreach ($filter as $fil) {
                $label = $this->where('title', $fil->value)->select('title', 'color')->first();
                if ($label) {
                    $output .= '&nbsp;&nbsp;'.$label->titleWithColor().'&nbsp;&nbsp;';
                }
            }
        }

        return $output;
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
