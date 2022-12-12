<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class LoginController extends Controller
{

    /**
     * Show login form.
     */
    public function index()
    {
        return view('auth.login');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'Incorrect credentials');
        }
        return redirect()->route('posts.index', ['user' => auth()->user()]);
    }
}