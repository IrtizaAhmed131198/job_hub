<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BlogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blog')->insert([
            [
                'title' => 'First Blog Post',
                'content' => 'Content for the first blog post.',
                'author' => 'John Doe',
                'image' => 'assets/blog_images/img-blog-1.png',
                'published_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Second Blog Post',
                'content' => 'Content for the second blog post.',
                'author' => 'Jane Doe',
                'image' => 'assets/blog_images/img-blog-2.png',
                'published_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Third Blog Post',
                'content' => 'Content for the third blog post.',
                'author' => 'Alice Smith',
                'image' => 'assets/blog_images/img-blog-3.png',
                'published_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Fourth Blog Post',
                'content' => 'Content for the fourth blog post.',
                'author' => 'Bob Johnson',
                'image' => 'assets/blog_images/img-blog-4.png',
                'published_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Fifth Blog Post',
                'content' => 'Content for the fifth blog post.',
                'author' => 'Charlie Brown',
                'image' => 'assets/blog_images/img-blog-5.png',
                'published_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
