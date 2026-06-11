<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('affiliate_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('affiliate_id')->constrained('affiliates')->cascadeOnDelete();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->string('coupon_code');
            $table->decimal('order_amount', 12, 2);
            $table->decimal('commission_amount', 12, 2);
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->unique(['affiliate_id', 'order_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('affiliate_orders');
    }
};
