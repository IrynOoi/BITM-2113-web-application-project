<?php
// <!-- LegacyDataSeeder.php -->
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class LegacyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sqlPath = database_path('legacy/seed_data_new.sql');
        if (File::exists($sqlPath)) {
            $sql = File::get($sqlPath);
            // The sql script contains 'USE restaurant_oms;' which might cause issues if DB name differs
            // We can remove it or let it run
            $sql = str_replace('USE restaurant_oms;', '', $sql);
            DB::unprepared($sql);
            $this->command->info('Legacy seed data imported successfully.');
        } else {
            $this->command->error('legacy/seed_data.sql not found!');
        }
    }
}