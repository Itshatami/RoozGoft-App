<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        if ($validator->fails()) {
            return response()->json($validator->errors()->first(), 422);
        }

        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'province_id' => 1,
                'city_id' => 1
            ]);
            if ($user) {
                DB::commit();
                $token = $user->createToken('myToken')->accessToken;
            } else {
                throw new Exception("cant create user");
            }
            return $this->sResponse(['user' => $user, 'token' => $token]);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->eResponse($e->getMessage(), 400);
        }
    }
}
