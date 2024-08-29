<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ArticleCategory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'articles';
    protected $fillable = [
        'title',
        'slug',
        'content',
        'description',
        'article_category_id',
        'tags',
        'thumbnail',
        'photos',
        'admin_id',
        'status',
        'is_featured',
        'is_hot',
        'meta_title',
        'meta_description'
    ];

    public function articleCategory()
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'admin_id');

    }
}
