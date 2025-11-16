<?php

namespace App\Model\kb;

use App\Models\BaseModel;

/**
 * Define the Model of comment table.
 */
class Comment extends BaseModel
{
    protected $table = 'kb_comment';

    public $timestamps = true;

    protected $casts = [
        'article_id' => 'integer',
        'status' => 'integer',
    ];

    protected $guarded = [];

    protected $fillable = ['article_id', 'name', 'email', 'website', 'comment', 'status'];

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

    public function article()
    {
        return $this->belongsTo(\App\Model\kb\Article::class, 'article_id', 'id');
    }

    #endregion
    #region Accessors
    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getNameAttribute($value)
    {
        return strip_tags($value);
    }

    public function getCommentAttribute($value)
    {
        return strip_tags($value);
    }

    #endregion
    #region Mutators
    /*
    |--------------------------------------------------------------------------
    | Mutators
    |--------------------------------------------------------------------------
    */

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strip_tags($value);
    }

    public function setCommentAttribute($value)
    {
        $this->attributes['comment'] = strip_tags($value);
    }

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
