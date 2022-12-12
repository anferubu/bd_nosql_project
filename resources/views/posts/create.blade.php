@extends('layouts.base')

@section('title')
    Create a new post
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('content')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>
        <div class="md:w-1/2 p-10 mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="title" class="mb-2 block text-gray-500 font-bold">
                        Title
                    </label>
                    <input id="title" name="title" type="text" placeholder="A new post" class="border p-3 w-full rounded-lg @error('title') border-red-500 @enderror" value="{{ old('title') }}">
                    @error('title')
                        <p class="text-red-500 my-2 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="description" class="mb-2 block text-gray-500 font-bold">
                        Description
                    </label>
                    <textarea id="description" name="description" class="border p-3 w-full rounded-lg resize-none @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 my-2 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input name="image" type="hidden" value="{{ old('image') }}">
                    @error('image')
                        <p class="text-red-500 my-2 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <input type="submit" value="Post" class="bg-red-400 hover:bg-red-500 transition-colors cursor-pointer font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection