<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User; // Import the User model

class RegisterController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    }

    protected function create(Request $request)
    {
        // Extract JSON data from the request
        $data = $request->json()->all();

        // Create the new user record
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return $user;
    }

    public function register(Request $request)
    {
        // Validate the JSON data
        $this->validator($request->json()->all())->validate();

        // Create the user
        $user = $this->create($request);

        // Trigger the Registered event
        event(new Registered($user));

        // Return the registered user as JSON response
        return $this->registered($request, $user)
            ?: response()->json(['message' => 'User registered successfully'], 201);
    }

    protected function registered(Request $request, $user)
    {
        $user->generateToken();

        return response()->json(['data' => $user->toArray()], 201);
    }
}
