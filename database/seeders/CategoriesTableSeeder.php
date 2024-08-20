<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Engineering', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Healthcare', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Education', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Finance', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Technology', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Marketing & Communication', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Content Writer', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'System Anaylst', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Designers', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Human Resources', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('categories')->insert($categories);
    }
}
