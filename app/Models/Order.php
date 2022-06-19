<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    use HasFactory;

    protected $fillable = [
        'customer',
        'phone',
        'address',
        'payment_method',
        'delivery',
        'status',
        'amount',
        'processing_status',
        'comment',
    ];
    
    protected $casts = [
    	'message_id' => 'integer',
    ];

    protected $primaryKey = 'id';

    protected $table = 'orders';

    /**
     * Relationships
     */

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
    public function agreement()
    {
        return $this->hasOne(OrderAgreement::class, 'order_id');
    }

    /**
     * Mutators
     */

    public function getAmountAttribute($value)
    {
        return $value / 100;
    }

    /**
     * Accessors
     */

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = $value * 100;
    }
}
