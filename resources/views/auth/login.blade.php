@extends('layouts.guest')

@section('title', 'Login')

@section('content')
    <!-- Header Section -->
    <div class="text-center mb-8">
        <div class="flex justify-center mb-4">
            <div class="w-16 h-16 bg-gradient-to-r from-primary to-secondary rounded-2xl flex items-center justify-center shadow-lg">
                <svg class="w-8 h-8 text-white" viewBox="0 0 50 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M49.626 11.564a.809.809 0 0 1 .028.209v10.972a.8.8 0 0 1-.402.694l-9.209 5.302V39.25c0 .286-.152.55-.4.694L20.42 51.01c-.044.025-.092.041-.14.058-.018.006-.035.017-.054.022a.805.805 0 0 1-.41 0c-.022-.006-.042-.018-.063-.026-.044-.016-.09-.03-.132-.054L.402 39.944A.801.801 0 0 1 0 39.25V6.334c0-.072.016-.142.028-.21.015-.084.044-.165.08-.242.036-.065.08-.125.13-.18.065-.068.138-.13.217-.186l19.22-11.066c.248-.143.54-.143.788 0l19.22 11.066a.803.803 0 0 1 .348.366c.035.077.064.158.08.242zm-1.574 10.718v-9.124l-3.363 1.936-4.126 2.376v9.124l7.489-4.312zm-9.61 16.505v-9.13l-4.056 2.31-8.156 4.646v9.168l12.212-6.994zm-17.85 6.993V35.64l-8.131-4.634v9.168l8.131 4.634zm-10.327-28.85v9.124l7.489 4.312v-9.124L8.365 14.236 4.265 12.299zm8.91-5.31L9.683 6.864l19.396-11.164 9.491 5.442-19.396 11.165zM8.365 23.18L39.42 6.334l-.001-.001-19.22-11.066L.977 6.334l7.388 4.246zm-6.789 3.931l7.489 4.312v16.498l-7.489-4.312V27.11zm8.91 20.81l12.212 6.994v-16.498l-4.126-2.305-8.086-4.53V43.92zm13.492-8.05l12.252-6.994V15.372l-4.126 2.376-8.126 4.676v16.447z" fill="currentColor"/>
                </svg>
            </div>
        </div>
        <h1 class="text-3xl font-bold text-dark dark:text-light mb-2">Welcome Back</h1>
        <p class="text-gray-600 dark:text-gray-400">Sign in to access your RFID Attendance System</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="bg-green-50 border-l-4 border-green-400 text-green-700 p-4 rounded-lg mb-6 dark:bg-green-900/20 dark:border-green-400 dark:text-green-300">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                {{ session('status') }}
            </div>
        </div>
    @endif

    <!-- Login Form -->
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-dark dark:text-light mb-2">
                Email Address
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                    </svg>
                </div>
                <input id="email" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors dark:bg-gray-700 dark:text-white @error('email') border-red-500 @enderror" 
                       placeholder="Enter your email address"
                       required 
                       autofocus 
                       autocomplete="username">
            </div>
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-dark dark:text-light mb-2">
                Password
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <input id="password" 
                       type="password" 
                       name="password"
                       class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors dark:bg-gray-700 dark:text-white @error('password') border-red-500 @enderror"
                       placeholder="Enter your password"
                       required 
                       autocomplete="current-password">
            </div>
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="flex items-center">
                <input id="remember_me" 
                       type="checkbox" 
                       name="remember"
                       class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary dark:focus:ring-primary dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" 
                   class="text-sm text-primary hover:text-secondary transition-colors font-medium">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <button type="submit" 
                class="w-full bg-gradient-to-r from-primary to-secondary hover:from-primary/90 hover:to-secondary/90 text-white font-bold py-3 px-4 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center justify-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
            </svg>
            <span>Sign In</span>
        </button>
    </form>

    <!-- Register Link -->
    <div class="mt-6 text-center">
        <p class="text-gray-600 dark:text-gray-400">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-primary hover:text-secondary transition-colors font-medium">
                Create one here
            </a>
        </p>
    </div>
@endsection
