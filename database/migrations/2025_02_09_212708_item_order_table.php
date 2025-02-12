<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('item_order', function (Blueprint $table) {
            $table->id('item_order_id');
            $table->bigInteger('item_id')->unsigned();
            $table->foreign('item_id')->references('item_id')->on('items');
            $table->bigInteger('order_id')->unsigned();
            $table->foreign('order_id')->references('order_id')->on('orders');
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};