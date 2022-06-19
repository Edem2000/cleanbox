<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogNewsArticle extends Model
{
    use HasFactory, Translatable;
    protected $fillable = [
        'name_ru',
        'name_uz',
        'name_en',
        'content_ru',
        'content_uz',
        'content_en',
        'img',
        'views',
        'shares',
        'active',
    ];
    protected $primaryKey = 'id';
    protected $table = 'blog_news_articles';
}
