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
        Schema::create('items', function (Blueprint $table) {
            $table->id('item_id');
            $table->string('item_name', 100);
            $table->string('item_desc', 500);
            $table->decimal('item_price', 10, 2);
            $table->string('image', 255);
            $table->integer('stock');
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('category_id')->on('categories');
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