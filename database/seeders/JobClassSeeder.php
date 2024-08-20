<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('job_class')->insert([
            ['class' => 'Class A', 'fee' => '100'],
            ['class' => 'Class B', 'fee' => '70'],
            ['class' => 'Class C', 'fee' => '50'],
            ['class' => 'Class D', 'fee' => '30'],
            ['class' => 'Class E', 'fee' => '30'],
        ]);
    }
}
