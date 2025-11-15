<?php

namespace App\Model\kb;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Category extends BaseModel
{
    protected $table = 'kb_category';

    public $timestamps = true;

    protected $casts = [
        'status' => 'integer',
        'parent' => 'integer',
    ];

    protected $guarded = [];

    protected $fillable = ['id', 'slug', 'name', 'description', 'status', 'parent', 'created_at', 'updated_at'];

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
     * Get articles in this category
     */
    public function articles()
    {
        return $this->belongsToMany(\App\Model\kb\Article::class, 'kb_article_relationship', 'category_id', 'article_id');
    }

    /**
     * Get parent category
     */
    public function parentCategory()
    {
        return $this->belongsTo(\App\Model\kb\Category::class, 'parent');
    }

    /**
     * Get child categories
     */
    public function childCategories()
    {
        return $this->hasMany(\App\Model\kb\Category::class, 'parent');
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
     * Scope to get active categories
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Scope to get root categories (no parent)
     */
    public function scopeRoot($query)
    {
        return $query->whereNull('parent');
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
