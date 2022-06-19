<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutYear extends Model
{
    use HasFactory;
    protected $fillable = ['year'];
    protected $casts = ['year' => 'integer'];
    public function months(){
      return $this->hasMany(AboutMonth::class, 'year_id');
    }
    public $timestamps = false;
}
