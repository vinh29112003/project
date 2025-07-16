<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController
{
    public function showLoginForm()
    {
        return view('user.login');
    }
    public function login(UserRequest $request)
    {
        $scredentials = $request->only('username', 'password');
        if (Auth::attempt($scredentials)) {
            $request->session()->regenerate();
            return redirect()->route('category.index')->with('success', 'Login successful!');
        } else {
            return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
        }
    }
    public function showRegistrationForm()
    {
        return view('user.register');
    }
    public function register(CreateUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'username' => $request->username,
            'phone_number' => $request->phone_number,
        ]);
        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
