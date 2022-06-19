<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAgreement extends Model
{
    use HasFactory;
    protected $fillable = [
        'path'
    ];

    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $table = 'order_agreements';
}
