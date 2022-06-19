<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutMonth extends Model
{
    use HasFactory, Translatable;
    protected $fillable = [
      'year_id',
      'month_id',
      'month_ru',
      'month_uz',
      'month_en',
      'content_ru',
      'content_en',
      'content_uz',
    ];
    protected $casts = [
      'year_id' => 'integer',
      'month_id' => 'integer',
      'active' => 'integer',
    ];
  public $timestamps = false;
  public function year()
  {
    return $this->belongsTo(AboutYear::class);
  }
}
