<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPressArticle extends Model
{
    use HasFactory, Translatable;
    protected $fillable = [
        'name_ru',
        'name_uz',
        'name_en',
        'img',
        'link',
    ];
    protected $primaryKey = 'id';
    protected $table = 'blog_press_articles';
}
