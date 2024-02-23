@extends('layouts.admin')


@section('content')

<x-guest-layout>
    
        
<div style="width: 60em; padding-left: 10em;">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-label for="mobile" :value="__('Mobile')" />

                <x-input id="mobile" class="block mt-1 w-full" type="number" name="mobile" :value="old('mobile')" required />
            </div>

            <div class="mt-4">
                <x-label for="year" :value="__('Year')" />
                <select class="block w-full form-select mt-1" for="year" name="year">
                    <option value="first year">First Year</option>
                    <option value="second year">Second Year</option>
                    <option value="third year">Third Year</option>
                    <option value="fourth year">Fourth Year</option>
                    <option value="fifth year">Fifth Year</option>
                    <option value="six year">Six Year</option>
                </select>
            </div>

            <div class="mt-4">
                <x-label for="faculty_id" :value="__('Faculty')" />
                <select class="block w-full form-select mt-1" for="faculty_id" name="faculty_id">
                    @foreach($faculties as $faculty)
                    <option value="{{$faculty->id}}">{{$faculty->name}}</option>
                    @endforeach
                </select>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-4">
                    {{ __('Register Student') }}
                </x-button>
            </div>
        </form>
        </div>
</x-guest-layout>
@endsection