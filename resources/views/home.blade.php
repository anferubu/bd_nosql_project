@extends('layouts.base')

@section('title')
    Home
@endsection

@section('content')
    @if ($posts->count())
    <div class="flex flex-col items-center w-full">
        @foreach($posts as $post)
        <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}" class="flex flex-col items-center w-full">
            <img src="{{ asset('uploads') . '/' . $post->image }}" alt="post {{ $post->title }}" class="rounded-lg w-1/2 md:w-1/3 m-3">
        </a>
        <div class="pb-10 text-center">
            <p class="font-bold">
                <a href="{{ route('posts.index', $post->user) }}">
                    {{ $post->user->username }}
                </a>
                 ::
                <span class="font-medium italic text-sky-500 lowercase">{{ $post->title }}</span>
            </p>
            <p class="font-normal text-sm text-gray-500">
                ~ {{ $post->created_at->diffForHumans() }}
            </p>
        </div>
        @endforeach
    </div>
    <div class="my-10">
        {{ $posts->links('pagination::tailwind') }}
    </div>
    @else
    <p class="p-10 text-center text-gray-400">
        There's nothing to see
    </p>
    @endif
@endsection