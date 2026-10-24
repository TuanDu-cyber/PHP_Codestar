<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'title' => 'Núi tuyết mùa thu',
            'category' => 'Travel',
            'excerpt' => 'Mô tả ngắn về bài viết.',
            'image' => 'images/posts/nui-tuyet.jpg',
            'published_at' => '2018-12-12',
        ]);

        Post::create([
            'title' => 'Rừng thông vàng',
            'category' => 'Nature',
            'excerpt' => 'Mô tả ngắn về bài viết.',
            'image' => 'images/posts/rung-thong.jpg',
            'published_at' => '2018-12-10',
        ]);

        Post::create([
            'title' => 'Hành trình phía Bắc',
            'category' => 'Tours',
            'excerpt' => 'Mô tả ngắn về bài viết.',
            'image' => 'images/posts/hanh-trinh.jpg',
            'published_at' => '2018-12-08',
        ]);
    }
}
