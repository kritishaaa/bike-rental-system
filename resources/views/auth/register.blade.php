@extends('layouts.renter')

@section('content')
    <div class="flex flex-row justify-center h-[80vh] items-center m-20" style="width: inherit;">
        <form action="{{ route('register') }}" method="POST" class="flex flex-col p-6 w-1/3 shadow-lg bg-white ">
            <legend class="font-semibold text-2xl text-center">Register</legend>
            @csrf


            <!-- Email Address -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>


            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="password_confirmation" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="license_number" :value="__('License Number')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="number" name="license_number"
                    required autocomplete="license_number" />
                <x-input-error :messages="$errors->get('license_number')" class="mt-2" />
            </div>



            <div class="flex flex-col items-center justify-end mt-4">


                <input type="submit" value="Register" class="bg-slate-700 py-2 w-full px-1 text-white rounded-sm">
                <span class=" font-thin text-sm p-1 text-center">Already have an Account ?</span>

                <a href="{{ route('login') }}" class="bg-slate-700 py-2 w-full px-1 text-white rounded-sm text-center">Login
                    on Existing Account</a>
            </div>

        </form>
    </div>
@endsection



{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


















{{-- <x-guest-layout> --}}
{{-- <form method="POST" action="{{ route('register') }}"> --}}
{{-- @csrf --}}
{{--  --}}
{{-- <!-- Name --> --}}
{{-- <div> --}}
{{-- <x-input-label for="name" :value="__('Name')" /> --}}
{{-- <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" /> --}}
{{-- <x-input-error :messages="$errors->get('name')" class="mt-2" /> --}}
{{-- </div> --}}
{{--  --}}
{{-- <!-- Email Address --> --}}
{{-- <div class="mt-4"> --}}
{{-- <x-input-label for="email" :value="__('Email')" /> --}}
{{-- <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" /> --}}
{{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
{{-- </div> --}}
{{--  --}}
{{-- <!-- Password --> --}}
{{-- <div class="mt-4"> --}}
{{-- <x-input-label for="password" :value="__('Password')" /> --}}
{{--  --}}
{{-- <x-text-input id="password" class="block mt-1 w-full" --}}
{{-- type="password" --}}
{{-- name="password" --}}
{{-- required autocomplete="new-password" /> --}}
{{--  --}}
{{-- <x-input-error :messages="$errors->get('password')" class="mt-2" /> --}}
{{-- </div> --}}
{{--  --}}
{{-- <!-- Confirm Password --> --}}
{{-- <div class="mt-4"> --}}
{{-- <x-input-label for="password_confirmation" :value="__('Confirm Password')" /> --}}
{{--  --}}
{{-- <x-text-input id="password_confirmation" class="block mt-1 w-full" --}}
{{-- type="password" --}}
{{-- name="password_confirmation" required autocomplete="new-password" /> --}}
{{--  --}}
{{-- <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" /> --}}
{{-- </div> --}}
{{--  --}}
{{-- <div class="flex items-center justify-end mt-4"> --}}
{{-- <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}"> --}}
{{-- {{ __('Already registered?') }} --}}
{{-- </a> --}}
{{--  --}}
{{-- <x-primary-button class="ml-4"> --}}
{{-- {{ __('Register') }} --}}
{{-- </x-primary-button> --}}
{{-- </div> --}}
{{-- </form> --}}
{{-- </x-guest-layout> --}}
{{--  --}}
