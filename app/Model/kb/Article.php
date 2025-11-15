<?php

namespace App\Model\kb;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Article extends BaseModel
{
    use SearchableTrait;

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'name'        => 10,
            'slug'        => 10,
            'description' => 10,
        ],
    ];

    protected $table = 'kb_article';

    public $timestamps = true;

    protected $casts = [
        'type' => 'integer',
        'status' => 'integer',
    ];

    protected $guarded = [];

    protected $fillable = ['name', 'slug', 'description', 'type', 'status', 'publish_time'];

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
     * Get categories this article belongs to
     */
    public function categories()
    {
        return $this->belongsToMany(\App\Model\kb\Category::class, 'kb_article_relationship', 'article_id', 'category_id');
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

    /**
     * Scope to get published articles
     */
    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Scope to get articles by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
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
