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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('category');
            $table->string('brand');
            $table->string('unit');
            $table->string('warehouse');
            $table->string('status');
            $table->string('description');
            $table->string('image');
            $table->string('sku');
            $table->string('barcode');
            $table->string('price');
            $table->string('discount_type');
            $table->string('discount');
            $table->string('tax');
            $table->string('quantity');
            $table->string('alert_quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
