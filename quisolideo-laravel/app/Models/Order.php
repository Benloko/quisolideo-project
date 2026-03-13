<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'address_line1',
        'address_line2',
        'city',
        'country',
        'status',
        'payment_method',
        'payment_status',
        'stripe_session_id',
        'stripe_payment_intent_id',
        'paid_at',
        'subtotal',
        'shipping',
        'total',
        'notes',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping' => 'decimal:2',
        'total' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
