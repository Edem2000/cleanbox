<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Translatable;
    protected $fillable = ['name_ru', 'name_uz', 'name_en', 'description_ru', 'description_uz', 'description_en', 'price', 'img', 'img2', 'img3', 'img_doubled'];
    protected $casts = [
      'visible' => 'integer',
      'active' => 'integer',
      'num_sold' => 'integer',
    ];
}
