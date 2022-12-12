<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class SignupController extends Controller
{
    /**
     * Show the sign up form.
     */
    public function index()
    {
        return view('auth.signup');
    }


    /**
     * Register a user in the social network.
     *
     * First validate data. Once validated,
     * create the user and save it in the database.
     * Authenticate it and redirect to home.
     */
    public function store(Request $request)
    {
        $request->request->add(
            ['username' => Str::slug($request->username)]
        );
        $this->validate($request, [
            'name' => 'required|min:4|max:30',
            'username' => 'required|unique:users|min:4|max:20',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|min:8',
        ]);
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        auth()->attempt($request->only('email', 'password'));
        return redirect()->route('posts.index', $request->username);
    }
}