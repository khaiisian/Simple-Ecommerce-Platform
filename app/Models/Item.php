<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $primaryKey = 'item_id';

    protected $fillable = [
        'item_name',
        'item_desc',
        'item_price',
        'image',
        'stock',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function sale()
    {
        return $this->belongsToMany(Order::class, 'item_order', 'item_id', 'order_id')
            ->withPivot('quantity', 'total_price');
    }
}