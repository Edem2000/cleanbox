<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'item_id', 'item_name', 'quantity'
    ];

    protected $primaryKey = 'id';

    protected $table = 'order_items';

    public $timestamps = false;
}
