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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('sale_by');
            $table->integer('customer_id')->nullable();
            $table->integer('customer_phone')->nullable();
            $table->string('payment_system');
            $table->string('payment_status');
            $table->string('order_status');
            $table->string('paid');
            $table->string('due');
            $table->integer('sub_total');
            $table->integer('total_discount');
            $table->integer('total_tax');
            $table->integer('total_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
