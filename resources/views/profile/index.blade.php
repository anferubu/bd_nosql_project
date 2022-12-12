@extends('layouts.base')

@section('title')
    Edit profile | {{ auth()->user()->username }}
@endsection

@section('content')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2">
            <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block text-gray-500 font-bold">
                        Username
                    </label>
                    <input id="username" name="username" type="text" class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" value="{{ auth()->user()->username }}">
                    @error('username')
                        <p class="text-red-500 my-2 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="image" class="mb-2 block text-gray-500 font-bold">
                        Profile Image
                    </label>
                    <input id="image" name="image" type="file" class="border p-3 w-full rounded-lg" accept=".jpg, .jpeg, .png">
                </div>
                <input type="submit" value="Save changes" class="bg-red-400 hover:bg-red-500 transition-colors cursor-pointer font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection