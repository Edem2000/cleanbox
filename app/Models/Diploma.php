<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\Traits\Translatable;

class Diploma extends Model
{
  use HasFactory, Translatable;
  protected $fillable = ['name_ru', 'name_uz', 'name_en', 'img'];
  protected $casts = ['active' => 'integer'];
}
