<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profile.index');
    }

    public function store(Request $request)
    {
        $request->request->add(
            ['username' => Str::slug($request->username)]
        );
        $this->validate($request, [
            'username' => [
                'required',
                'unique:users,username,'.auth()->user()->id,
                'min:4',
                'max:20',
                'not_in:edit-profile',
            ],
        ]);
        if ($request->image) {
            $image = $request->file('image');
            $imgName = Str::uuid() . "." . $image->extension();
            $imgPath = public_path('profiles') . '/' . $imgName;
            $imgServer = Image::make($image);
            $imgServer->fit(1000, 1000);
            $imgServer->save($imgPath);
        }
        $user = User::find(auth()->user()->id);
        $user->username = $request->username;
        $user->image = $imgName ?? auth()->user()->image ?? null;
        $user->save();
        return redirect()->route('posts.index', $user->username);
    }
}
