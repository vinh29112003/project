<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthAPIRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(AuthAPIRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password), // Hash the password
            'phone_number' => $request->phone_number,
            'email' => $request->email,

        ]);
        $user->assignRole('user'); // Assign a default role, e.g., 'user'
    
        // Return a response
        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }

    public function login(UserRequest $request)
    {
        $user = User::where('username', $request->username)->first();
        if (!$user || !password_verify($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);
        }
        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user,
        ]);

    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out']);
    }
}
