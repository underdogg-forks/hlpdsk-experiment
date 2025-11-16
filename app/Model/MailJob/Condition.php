<?php

namespace App\Model\MailJob;

use App\Models\BaseModel;

class Condition extends BaseModel
{
    protected $table = 'conditions';

    public $timestamps = true;

    protected $casts = [];

    protected $guarded = [];

    protected $fillable = ['job', 'value'];

    #region Static Methods
    /*
    |--------------------------------------------------------------------------
    | Static Methods
    |--------------------------------------------------------------------------
    */

    public function getConditionValue($job)
    {
        $value = ['condition' => '', 'at' => ''];
        $condition = $this->where('job', $job)->first();
        if ($condition) {
            $condition_value = explode(',', $condition->value);
            $value = ['condition' => $condition_value, 'at' => ''];
            if (is_array($condition_value)) {
                $value = ['condition' => $this->checkArray(0, $condition_value), 'at' => $this->checkArray(1, $condition_value)];
            }
        }

        return $value;
    }

    public function checkArray($key, $array)
    {
        $value = '';
        if (is_array($array)) {
            if (array_key_exists($key, $array)) {
                $value = $array[$key];
            }
        }

        return $value;
    }

    public function checkActiveJob()
    {
        $result = ['fetching' => '', 'notification' => '', 'work' => '', 'message' => '', 'remind' => ''];
        $emails = new \App\Model\helpdesk\Settings\Email();
        $email = $emails->find(1);
        if ($email) {
            if ($email->email_fetching == 1) {
                $result['fetching'] = true;
            }
            if ($email->notification_cron == 1) {
                $result['notification'] = true;
            }
        }
        $works = new \App\Model\helpdesk\Workflow\WorkflowClose();
        $work = $works->find(1);
        //dd($work);
        if ($work) {
            if ($work->condition == 1) {
                $result['work'] = true;
            }
        }

        return $result;
    }

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
