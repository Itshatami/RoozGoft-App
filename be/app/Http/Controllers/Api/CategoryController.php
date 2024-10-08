<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        if (!$categories) return response()->json(['status' => false, 'message' => 'Empty categories'], 200);
        return response()->json(['status' => true, 'message' => 'all categories', 'categories' => $categories], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate request
        $v = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'displayName' => 'required|min:3|max:255',
            'description' => 'required',
            'image' => 'nullable|image',
            'colorPallet' => 'required|max:10'
        ]);
        if ($v->fails())
            return response()->json(['status' => false, 'error' => $v->messages()], 400);

        // store image
        if ($request->has('image')) {
            $ImageName = Carbon::now()->microsecond . '.' . $request->image->extension();
            $request->image->storeAs('images/categories', $ImageName, 'public');
        }

        // store category
        try {
            $category = Category::create([
                "name" => $request->name,
                'displayName' => $request->displayName,
                'description' => $request->description,
                'image' => $ImageName,
                'colorPallet' => $request->colorPallet
            ]);
            if (!$category)
                throw new Exception("store category faild!");
            return response()->json(['status' => true, 'message' => 'با موفقیت ایجاد شد!', 'category' => $category], 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => false, 'error' => $th->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        if (!$category)
            return response()->json(['status' => false, 'message' => 'category not found!'], 404);

        return response()->json(['status' => true, 'category' => $category, 'articles' => $category->articles], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if (!$category)
            return response()->json(['status' => false, 'message' => 'not found category'], 404);

        
        
        $v = Validator::make($request->all(), [
            'name' => 'required',
            'displayName' => 'required',
            'description' => 'required',
            'image' => 'required|image',
            'colorPallet' => 'required'
        ]);
        if ($v->fails())
            return response()->json(['status' => false, 'error' => $v->messages()], 400);

        // store image
        if ($request->has('image')) {
            $ImageName = Carbon::now()->microsecond . '.' . $request->image->extension();
            $request->image->storeAs('images/categories', $ImageName, 'public');
            $category->image = $ImageName;
        }

        //update category
        try {
            $category->name = $request->name;
            $category->displayName = $request->displayName;
            $category->description = $request->description;
            $category->colorPallet = $request->colorPallet;
            $category->save();
            if (!$category)
                throw new Exception("update category faild");
            return  response()->json(['status' => true, 'category' => $category], 201);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if (!$category) return response()->json(['status' => false, 'message' => 'not found'], 404);
        $category->delete();
        return response()->json(['status' => true, 'message' => 'deleted'], 200);
    }
}
