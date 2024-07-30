<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Register
    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'username' => 'required|min:3|max:55',
            'email' => 'required|email',
            'password' => 'required|min:8|max:55',
            'confirmPassword' => 'required|same:password'
        ]);

        // request validate fails
        if ($v->fails())
            return response()->json(["status" => false, "message" => "validations fails", "data" => $v->errors()], 401);

        // check user exists
        $user = User::where('username', $request->username)->first();
        if ($user)
            return response()->json(['status' => false, 'message' => 'این نام کاربری قبلا ثبت شده!'], 401);

        // check email already registered
        $email = User::where('email', $request->email)->value("email");
        if ($email)
            return response()->json(['status' => false, 'message' => 'این ایمیل قبلا ثبت شده'], 401);
        try {
            DB::beginTransaction();
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            if (!$user)
                throw new Exception("user create falis");
            DB::commit();
            return response()->json(['status' => true, 'message' => 'user created'], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage()], 401);
        }
    }

    // Login
    public function login(Request $request)
    {
        // validate request
        $v = Validator::make($request->all(), [
            'username' => 'required|min:3|max:55',
            'password' => 'required|min:8|max:55',
        ]);

        if ($v->fails())
            return response()->json(['status' => false, 'message' => 'validator fails', 'data' => $v->messages()], 401);

        // check user exists
        /*
         * if we want to create Personal access tokens we must use Elequent insted of DB fecad
         * $user = DB::table('users')->where('username', $request->username)->first();
         */
        $user = User::where('username', $request->username)->first();
        if (!$user)
            return response()->json(['status' => false, 'message' => 'user does not register'], 401);
        // check password matches
        if (!Hash::check($request->password, $user->password))
            return response(['status' => false, 'message' => 'password incorrect'], 401);
        // create token
        $token = $user->createToken(env("JWT_SECRET"))->accessToken;
        return response()->json(['status' => true, 'user' => $user, 'token' => $token], 202);
    }

    public function logout(Request $request)
    {
        /*
         * for use $request->user() we must add middleware('auth:api) in this route
        */
        $user = $request->user();
        $user->tokens()->delete();
        return response()->json(['status' => true, 'message' => 'leged out!'], 202);
    }

    public function authAdmin(Request $request)
    {
        // validate request
        $v = Validator::make($request->all(), [
            'username' => 'required|min:3|max:55',
            'password' => 'required|min:8|max:55',
        ]);

        // validate fails
        if ($v->fails())
            return response()->json(['status' => false, 'message' => 'validator fails', 'data' => $v->messages()], 401);

        // Check user exists
        $user = User::where('username', $request->username)->first();
        if (!$user)
            return response()->json(['status' => false, 'message' => 'user does not register'], 401);

        // check password matches
        if (!Hash::check($request->password, $user->password))
            return response(['status' => false, 'message' => 'password incorrect'], 401);
        // create token
        $token = $user->createToken(env("JWT_SECRET"))->accessToken;
        return response()->json(['status' => true, 'user' => $user, 'token' => $token], 202);


        // check for role
        foreach ($user->roles as $role) {
            if ($role->role == "admin" || $role->role == "editor") {
                // create token
                $token = $user->createToken(env("JWT_SECRET"))->accessToken;
                return response()->json(['status' => true, 'user' => $user, 'token' => $token], 202);
            }
        }
    }
}
