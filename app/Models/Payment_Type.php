<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_Type extends Model
{
    use HasFactory;

    protected $table = 'payment_types';

    protected $primaryKey = 'payment_type_id';

    protected $fillable = [
        'payment_type_name'
    ];

    public function sale()
    {
        return $this->hasMany(Order::class, 'payment_type_id', 'payment_type_id');
    }
}