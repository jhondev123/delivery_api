<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_product_toppings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_product_id')->constrained();
            $table->foreignId('topping_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_product_toppings', function (Blueprint $table) {
            $table->dropForeign(['order_product_id']);
            $table->dropForeign(['topping_id']);
        });
        Schema::dropIfExists('order_product_toppings');
    }
};
