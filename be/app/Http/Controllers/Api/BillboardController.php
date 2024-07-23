<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;

use App\Models\Billboard;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BillboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return 1;
        $billboards = Billboard::all();
        if (!$billboards)
            return response()->json(['status' => false, 'message' => 'there is no billboard'], 401);

        return response()->json(['status' => true, 'message' => '', 'data' => $billboards], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate request
        $v = Validator::make($request->all(), [
            'title' => 'required|min:3|max:55',
            'caption' => 'required|min:3|max:55',
            'image' => 'required|image',
            'public' => 'required'
        ]);

        if (!$v->fails())
            return response()->json(['status' => false, 'message' => $v->messages()], 401);

        try {
            DB::beginTransaction();

            // store image file
            if ($request->has('image')) {
                $image = Carbon::now()->microsecond . '.' . $request->image->extension();
                $request->image->storeAs('images/billboard', $image, 'public');
            } else {
                throw new Exception("there is no image");
            }


            $billboard = Billboard::create([
                'title' => $request->title,
                'caption' => $request->caption,
                'image' => $image,
            ]);
            if (!$billboard)
                throw new Exception('billboard creation faild!');
            return response()->json(['status' => true, 'message' => 'Billboard created successfully!', 'data' => $billboard], 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => false, 'message' => $th->getMessage()], 402);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Billboard $billboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Billboard $billboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Billboard $billboard)
    {
        //
    }
}
