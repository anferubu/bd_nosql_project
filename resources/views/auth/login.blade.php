@extends('layouts.base')

@section('title')
    Login
@endsection

@section('content')
    <div class="md:flex md:justify-center md:gap-20 md:items-center">
        <div class="md:w-6/12">
            <img src="{{ asset('img/login.jpg') }}" alt="User login image" class="rounded-lg">
        </div>
        <div class="md:w-4/12 p-6">
            <form action="{{ route('login') }}" method="POST" novalidate>
                @csrf
                @if (session('status'))
                    <p class="text-red-500 my-2 text-sm">
                        {{ session('status') }}
                    </p>
                @endif
                <div class="mb-5">
                    <label for="email" class="mb-2 block text-gray-500 font-bold">
                        Email
                    </label>
                    <input id="email" name="email" type="email" placeholder="johndoe@example.com" class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 my-2 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block text-gray-500 font-bold">
                        Password
                    </label>
                    <input id="password" name="password" type="password" placeholder="********" class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-red-500 my-2 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="checkbox" name="remember">
                    <label class="text-gray-500 text-sm">Keep session open</label>
                </div>

                <input type="submit" value="Login" class="bg-red-400 hover:bg-red-500 transition-colors cursor-pointer font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection