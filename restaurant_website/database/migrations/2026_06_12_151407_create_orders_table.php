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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('customer_name', 100);
            $table->string('customer_phone', 20);
            $table->enum('order_type', ['dine-in', 'takeaway', 'pickup', 'delivery']);
            $table->unsignedInteger('table_number')->nullable();
            $table->text('delivery_address')->nullable();
            $table->text('special_notes')->nullable();
            $table->enum('payment_method', ['cash', 'online_transfer'])->default('cash');
            $table->string('receipt_path')->nullable();
            $table->decimal('subtotal', 8, 2)->default(0.00);
            $table->decimal('tax', 8, 2)->default(0.00);
            $table->decimal('delivery_fee', 8, 2)->default(0.00);
            $table->decimal('total', 8, 2)->default(0.00);
            $table->enum('status', ['pending', 'confirmed', 'preparing', 'ready', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

