@extends('layouts.base')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="container mx-auto lg:flex justify-center">
        <div class="w-full lg:w-1/2 xl:w-1/3 p-5">
            <img src="{{ asset('uploads') . '/' . $post->image }}" alt="post {{ $post->title }}" class="rounded-lg">
            <div class="flex items-center gap-3 ">
                @auth
                @if ($post->checkLike(auth()->user()))
                <form action="{{ route('posts.likes.destroy', $post) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="my-4">
                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="red" viewBox="0 0 24 24" stroke="red" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
                @else
                <form action="{{ route('posts.likes.store', $post) }}" method="POST">
                    @csrf
                    <div class="my-4">
                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
                @endif
                @endauth
                <p class="my-2">{{ $post->likes->count() }} likes</p>
            </div>
            <div class="pb-10">
                <p class="font-bold">
                    <a href="{{ route('posts.index', $post->user) }}">
                        {{ $post->user->username }}
                    </a>
                     ::
                    <span class="font-medium italic text-sky-500 lowercase">{{ $post->title }}</span>
                </p>
                <p class="mt-1">
                    {{ $post->description }}
                </p>
                <p class="text-sm text-gray-500 mt-2">
                    {{ $post->created_at->diffForHumans() }}
                </p>
            </div>
            @auth
                @if ($post->user_id === auth()->user()->id)
                <form action="{{ route('posts.destroy', $post) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="flex w-full items-center justify-center gap-2 border border-red-100 p-2 font-bold text-red-600 hover:bg-red-50 text-sm rounded cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete post
                    </button>
                </form>
                @endif
            @endauth
        </div>
        <div class="w-full lg:w-1/2 xl:w-1/3 px-5">
            <div class="p-5 mb-5">
                <div class="mb-5 h-80 overflow-y-auto">
                    @if ($post->comments->count())
                        @foreach ($post->comments as $comment)
                            <div class="mb-5">
                                <a href="{{ route('posts.index', $comment->user) }}" class="font-bold">
                                    {{ $comment->user->username }}
                                </a>
                                <span>
                                    - {{$comment->comment}}
                                </span>
                                <p class="text-sm text-gray-500">
                                    {{$comment->created_at->diffForHumans()}}
                                </p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center text-gray-400">
                            There's no comments
                        </p>
                    @endif
                </div>
                @auth
                @if (session('status'))
                    <p class="text-gray-400 font-light">
                        {{ session('status') }}
                    </p>
                @endif
                <form action="{{ route('comments.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <textarea id="comment" name="comment" placeholder="add a comment..." class="border p-3 w-full rounded-lg resize-none"></textarea>
                        @error('comment')
                            <p class="text-red-500 my-2 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <input type="submit" value="Comment" class="hover:bg-gray-100 transition-colors cursor-pointer font-bold w-full p-3 text-gray-500 rounded-lg border">
                </form>
                @endauth
            </div>
        </div>
    </div>
@endsection