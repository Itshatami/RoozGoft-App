<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get('database/data/articles.json');
        $articles = collect(json_decode($json, true));
        $articles->each(function ($article) {
            Article::create([
                'user_id' => $article['user_id'],
                'category_id' => $article['category_id'],
                'title' => $article['title'],
                'content' => $article['content'],
                'public' => $article['public']

            ]);
        });
    }
}
