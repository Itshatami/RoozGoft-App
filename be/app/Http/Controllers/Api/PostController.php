<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        if (!$posts)
            return response()->json(['status' => false, 'message' => 'there is no Post!'], 404);
        return response()->json(['status' => true, 'posts' => $posts, 'message' => 'all posts'], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate request
        $v = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image'
        ]);
        if ($v->fails())
            return response()->json(['status' => false, 'message' => $v->messages()], 400);

        // if post have image
        if ($request->has('image')) {
            $ImageName = Carbon::now()->microsecond . '.' . $request->image->extension();
            $request->image->storeAs('images/posts', $ImageName, 'public');
        }

        // create post
        try {
            $post = Post::create([
                'user_id' => $request->user()->id,
                'title' => $request->title,
                'content' => $request->content,
                'image' => $ImageName
            ]);
            if (!$post)
                throw new \ErrorException("faild store post!");
            return response()->json(['status' => true, 'message' => 'created successfully!', 'post' => $post], 201);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // check existing
        $post = Post::find($id);
        if (!$post)
            return response()->json(['status' => false, 'message' => 'post not found!'], 404);

        $user = $post->user;
        return response()->json(['status' => true, 'user' => $user, 'post' => $post], 200);
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
