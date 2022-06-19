<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'phone', 'email', 'message'];
    protected $table = 'contact_requests';
    protected $casts = [
      'status' => 'integer'
    ];
}
