<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Item extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    protected $primaryKey = 'order_item_id';

    protected $fillable = [
        'item_id',
        'order_id',
        'quantity',
        'total_price'
    ];
}