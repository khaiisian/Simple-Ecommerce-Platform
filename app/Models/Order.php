<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $primaryKey = 'order_id';

    protected $fillable = [
        'payment_type_id',
    ];

    public function payment_type()
    {
        return $this->belongsTo(Payment_Type::class, 'payment_type_id', 'payment_type_id');
    }

    public function item()
    {
        return $this->belongsToMany(Item::class, 'item_order', 'order_id', 'item_id')
            ->withPivot('quantity', 'total_price');
    }
}