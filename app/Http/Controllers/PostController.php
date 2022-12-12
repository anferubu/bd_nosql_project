<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    /**
     * Check if user is authenticated. If not,
     * redirect to the login view.
     */
    public function __construct()
    {
        $this->middleware('auth')
          ->except(['show', 'index']);
    }


    /**
     * Show the user's profile page.
     */
    public function index(User $user)
    {
        $posts = Post::where('user_id', $user->id)
          ->latest()
          ->paginate(18);
        return view('dashboard', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }


    public function create()
    {
        return view('posts.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'max:255',
            'description' => '',
            'image' => 'required',
        ]);
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' => auth()->user()->id,
        ]);
        return redirect()->route('posts.index', auth()->user()->username);
    }


    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user,
        ]);
    }


    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        $imgPath = public_path('uploads/' . $post->image);
        if (File::exists($imgPath)) {
            unlink($imgPath);
        }
        return redirect()->route('posts.index', auth()->user()->username);
    }
}