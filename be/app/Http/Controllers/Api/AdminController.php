<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function data(Request $request)
    {
        $user = $request->user();
        return response()->json(['status' => true, 'user' => $user], 200);
    }
}
