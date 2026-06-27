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
        Schema::table('menu_items', function (Blueprint $table) {
            // In MySQL/Laravel, to change a column type, you need doctrine/dbal, 
            // OR we can just drop it and recreate it (if no data) but we want to preserve data.
            // Wait, we are about to overwrite all data in this table via seeder anyway.
            // Let's just use raw SQL to modify the column.
            \DB::statement("ALTER TABLE menu_items MODIFY category VARCHAR(50) NOT NULL");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            \DB::statement("ALTER TABLE menu_items MODIFY category ENUM('main','drinks','dessert','snacks','soup') NOT NULL");
        });
    }
};
