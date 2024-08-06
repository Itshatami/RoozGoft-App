<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // returns all articles
        $articles = Article::all();
        if (!$articles)
            return response()->json(['status' => false, 'message' => 'empty articles table'], 404);
        return  response()->json(['status' => true, 'message' => 'All Articles', 'articles' => $articles], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // existing check
        $article = Article::find($id);
        if (!$article)
            return response()->json(['status' => false, 'message' => 'article not found'], 404);

        $category = $article->category;
        $user = $article->user;
        return response()->json(['status' => true, 'user' => $user, 'category' => $category, 'article' => $article], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
