@extends('layouts.base')

@section('title')
    {{ $user->username }} account
@endsection

@section('content')
    <section class="flex justify-center">
        <div class="flex w-10/12 md:w-8/12 lg:w-6/12 ">
            <div class="w-1/3 lg:w-6/12 px-5 flex justify-end mb-5">
                <img src="{{ $user->image ? asset('profiles') . '/' . $user->image : asset('img/user.svg') }}" alt="User profile" class="w-32 rounded-full">
            </div>
            <div class="w-2/3 lg:w-6/12 px-5">
                <div class="flex items-center gap-2">
                    <h2 class="text-gray-700 text-4xl font-thin mb-4">
                        {{ $user->username }}
                    </h2>
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{ route('profile.index') }}" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                            </a>
                        @elseif($user->id !== auth()->user()->id)
                            @if(!$user->isfollowing(auth()->user()))
                            <form action="{{ route('users.follow', $user) }}" method="POST">
                                @csrf
                                <input type="submit" value="Follow" class="rounded-lg px-3 py-1 ml-3 text-xs font-bold cursor-pointer border hover:bg-sky-100 border-sky-100">
                            </form>
                            @else
                            <form action="{{ route('users.unfollow', $user) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="submit" value="Unfollow" class="rounded-lg px-3 py-1 ml-3 text-xs font-bold cursor-pointer border bg-red-100 hover:bg-red-200 border-red-100">
                            </form>
                            @endif
                        @endif
                    @endauth
                </div>

                <div class="flex justify-between">
                    <p class="text-gray-800 text-sm mb-3 font-bold">
                        {{ $user->posts()->count() }}
                        <span class="font-normal">
                            posts
                        </span>
                    </p>
                    <p class="text-gray-800 text-sm mb-3 font-bold">
                        {{ $user->followers->count() }}
                        <span class="font-normal">
                            @choice('follower|followers', $user->followers->count())
                        </span>
                    </p>
                    <p class="text-gray-800 text-sm mb-3 font-bold">
                        {{ $user->following->count() }}
                        <span class="font-normal">
                            following
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="container mx-auto mt-10 w-8/12 border-t-2 pt-10">
        @if($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($posts as $post)
            <a href="{{ route('posts.show', ['post' => $post, 'user' => $user]) }}">
                <img src="{{ asset('uploads') . '/' . $post->image }}" alt="post {{ $post->title }}" class="rounded">
            </a>
            @endforeach
        </div>
        <div class="my-10">
            {{ $posts->links('pagination::tailwind') }}
        </div>
        @else
        <p class="text-gray-400 text-center">There's nothing posted</p>
        @endif
    </section>
@endsection