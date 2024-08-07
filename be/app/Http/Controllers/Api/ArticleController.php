<?php

namespace App\Http\Controllers\Api;

use Exception;
use Carbon\Carbon;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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
           // validate request
           $v = Validator::make($request->all(), [
            'category_id' => 'required',
            'title' => 'required|min:3|max:255',
            'content' => 'required',
            'image' => 'nullable|image',
        ]);
        if ($v->fails())
            return response()->json(['status' => false, 'error' => $v->messages()], 400);

        // store image
        if ($request->has('image')) {
            $ImageName = Carbon::now()->microsecond . '.' . $request->image->extension();
            $request->image->storeAs('images/articles', $ImageName, 'public');
        }

        

        // store category
        try {
            $article = Article::create([
                "user_id" => $request->user()->id,
                'category_id' => $request->category_id,
                'title' => $request->title,
                'content' => $request->content,
                'image' => $ImageName
            ]);
            if (!$article)
                throw new Exception("store article faild!");
            return response()->json(['status' => true, 'message' => 'با موفقیت ایجاد شد!', 'article' => $article], 201);
        } catch (Exception $e) {
            //throw $th;
            return response()->json(['status' => false, 'error' => $e->getMessage()], 400);
        }
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
