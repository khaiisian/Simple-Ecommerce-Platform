<?php

namespace Database\Seeders;

use App\Models\Payment_Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Payment_Type::create([
            'payment_type_name' => 'Credit Card',
        ]);

        Payment_Type::create([
            'payment_type_name' => 'Bank Transfer',
        ]);

        Payment_Type::create([
            'payment_type_name' => 'Cash on Delivery',
        ]);

        Payment_Type::create([
            'payment_type_name' => 'Mobile Payment',
        ]);
    }
}