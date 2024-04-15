<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\User; // Import the User model

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate JSON data
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to log in the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication successful
            
            Auth::guard('api')->user(); // instance of the logged user
            Auth::guard('api')->check(); // if a user is authenticated
            Auth::guard('api')->id(); // the id of the authenticated user
            
            $token = \App\Models\User::find(Auth::id())->generateToken();


            return response()->json([
                'data' => [
                    'id' => auth()->id(),
                    'name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                    'created_at' => auth()->user()->created_at,
                    'updated_at' => auth()->user()->updated_at,
                    'api_token' => $token,
                ],
            ]);
            
            
        }

        // Authentication failed
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function logout(Request $request)
    {
        $user = $request->user('api');

        if ($user) {
            // Retrieve the user's API token
            $apiToken = $user->api_token;

            // Update the user's row in the 'users' table to revoke the token
            DB::table('users')
                ->where('api_token', $apiToken)
                ->update(['api_token' => null]);

            return response()->json(['message' => 'User logged out successfully.'], 200);
        }

        return response()->json(['message' => 'User not authenticated.'], 401);
    }

}
