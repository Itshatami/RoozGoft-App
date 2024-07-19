<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'username' => 'required|min:3|max:55',
            'email' => 'required|email',
            'password' => 'required|min:8|max:55',
            'confirmPassword' => 'required|same:password'
        ]);

        if ($v->fails())
            return response()->json(["status" => false, "message" => "validations fails", "data" => $v->errors()], 401);

        try {
            // $username = DB::table('users')->value('username')-
            DB::beginTransaction();
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password
            ]);
            if (!$user)
                throw new Exception("user create falis");
            DB::commit();
            $token = $user->createToken(env("JWT_SECRET"))->accessToken;
            return response()->json(['status' => true, 'message' => 'user created', 'user' => $user, 'token' => $token],  201);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage()], 401);
        }
    }
}
