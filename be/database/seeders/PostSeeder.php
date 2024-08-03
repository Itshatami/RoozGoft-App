<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get('database/data/posts.json');
        $posts = collect(json_decode($json, true));
        $posts->each(function ($post) {
            Post::create([
                'user_id' => $post['user_id'],
                'title' => $post['title'],
                'content' => $post['content'],
                'public' => $post['public']

            ]);
        });
    }
}
