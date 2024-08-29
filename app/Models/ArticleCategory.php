<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'article_categories';

    protected $fillable = [
        'title',
        'content',
        'slug',
        'photos',
        'admin_id',
        'description',
        'status',
        'is_show',
        'parent_id',
        'sort_order',
        'meta_title',
        'meta_description'
    ];

    public $timestamps = true;

    public function articles()
    {
        return $this->hasMany(Article::class, 'article_category_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function articlePost()
    {
        return $this->hasManyThrough(Article::class, ArticleCategory::class, 'parent_id', 'article_category_id', 'id')
            ->where('articles.status', '=', '1')
            ->select(['articles.id', 'articles.title', 'articles.slug', 'articles.status', 'articles.article_category_id', 'articles.thumbnail', 'articles.description', 'articles.updated_at'])
            ->orderBy('articles.updated_at', 'DESC')
            ->limit(6);
    }

    public function parent()
    {
        return $this->hasOne(ArticleCategory::class, 'id', 'parent_id')->orderBy('sort_order');
    }

    public function children()
    {
        return $this->hasMany(ArticleCategory::class, 'parent_id', 'id')->orderBy('sort_order');
    }

    public static function tree()
    {
        return static::with(implode('.', array_fill(0, 100, 'children')))
            ->where([['parent_id', '=', '0'], ['status', '=', 1], ['is_show', '=', 1]])
            ->orderBy('sort_order', 'ASC')
            ->get(['id', 'title', 'slug', 'parent_id']);
    }
}
