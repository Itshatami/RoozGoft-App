<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Check if the user is authenticated and has the 'admin' role
        // if ($request->user() && $request->user()->roles === 'admin') {
        //     return $next($request);
        // }

        // Check user exists
        // $user = User::where('username', $request->username)->first();
        $user = $request->user();
        if (!$user)
            return response()->json(['status' => false, 'message' => 'user does not register'], 401);

        // check for role
        foreach ($user->roles as $role) {
            if ($role->role == "admin" || $role->role == "editor") {
                return $next($request);
            }
        }

        // Redirect or respond with an error if the user doesn't have access
        // return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
        // return $next($request);
        return response()->json(['status' => false, 'message' => 'You do not have permission to access this page.'], 402);
    }
}
