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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('menu_item_id')->constrained('menu_items');
            $table->string('item_name', 150);
            $table->decimal('unit_price', 8, 2);
            $table->unsignedTinyInteger('quantity')->default(1);
            $table->decimal('line_total', 8, 2);
            // $table->timestamps(); // legacy doesn't have timestamps on this table, but Laravel default has it. I'll add them to be safe or remove them. Let's omit timestamps if they aren't there, or keep them. Laravel default has them. Let's omit them to match schema strictly or add them. I will omit them to match exactly.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
