<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:3|max:55',
            'email' => 'required|email|max:55',
            'password' => 'required|min:3|max:55',
            'confirmPassword' => 'required|same:password',
        ]);
        if ($validator->fails())
            return response()->json($validator->errors(), 422);


        try {
            DB::beginTransaction();
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
            ]);
            if ($user) {
                DB::commit();
                $token = $user->createToken('myToken')->accessToken;
            } else {
                throw new Exception("cant create user");
            }
            return response()->json(['user' => $user, 'token' => $token]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 400);
        }
    }
}
