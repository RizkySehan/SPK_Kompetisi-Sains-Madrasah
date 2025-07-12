@section('title', 'Login | Sistem Pendukung Keputusan')

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <div class="mb-6">
            <h3 class="text-3xl font-bold text-green-900 mb-6 text-center uppercase">Login</h3>
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

    <!-- Password -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Password')" />

        <div x-data="{ show: false }" class="relative">
            <input :type="show ? 'text' : 'password'" id="password" name="password" required
                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                autocomplete="current-password" />

            <button type="button" @click="show = !show"
                class="absolute inset-y-0 right-0 top-0 p-3 flex items-center text-gray-500 focus:outline-none hover:opacity-60">
                <i :class="show ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'"></i>
            </button>
        </div>

        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

        <!-- Forgot Password + Remember Me -->
        {{-- <div class="flex justify-between items-center mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-green-700 shadow-sm focus:ring-green-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">Remember me</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-sm text-green-700 hover:text-green-900 hover:underline" href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            @endif
        </div> --}}

        <!-- Login Button -->
        <div class="my-6">
            <x-primary-button class="w-full justify-center py-3 text-8xl">
                {{ __('Login') }}
            </x-primary-button>
        </div>

        <!-- Register link -->
        {{-- <div class="text-center mt-6 text-sm text-gray-600">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-green-700 hover:underline">Register</a>
        </div> --}}
    </form>
</x-guest-layout>
