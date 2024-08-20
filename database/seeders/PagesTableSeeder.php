<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pages')->insert([
            [
                'title' => 'Page Title 1',
                'sub_title' => 'Sub Title 1',
                'short_description' => 'Short Description 1',
                'long_description' => 'Long Description 1',
                'image' => 'image1.jpg',
                'banner_image' => 'banner1.jpg',
                'link' => 'https://example.com/page1',
                'page_type' => 'type1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Page Title 2',
                'sub_title' => 'Sub Title 2',
                'short_description' => 'Short Description 2',
                'long_description' => 'Long Description 2',
                'image' => 'image2.jpg',
                'banner_image' => 'banner2.jpg',
                'link' => 'https://example.com/page2',
                'page_type' => 'type2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more dummy data as needed
        ]);
    }
}
