@extends('layouts.admin')


@section('content')

<x-guest-layout>
    
        
<div style="width: 60em; padding-left: 10em;">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register-doctor') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"  />
            </div>

            <div class="mt-4">
                <x-label for="mobile" :value="__('Mobile')" />

                <x-input id="mobile" class="block mt-1 w-full" type="number" name="mobile" :value="old('mobile')" required />
            </div>

            <div class="mt-4">
                <x-label for="year" :value="__('Year')" />
                <select class="block w-full form-select mt-1" for="year" name="year">
                    <option value="1">First Year</option>
                    <option value="2">Second Year</option>
                    <option value="3">Third Year</option>
                    <option value="4">Fourth Year</option>
                    <option value="5">Fifth Year</option>
                    <option value="6">Six Year</option>
                </select>
            </div>
            <div class="mt-4">
                <x-label for="faculty_id" :value="__('faculty_id')" />
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
                    {{ __('Register Doctor') }}
                </x-button>
            </div>
        </form>
        </div>
</x-guest-layout>
@endsection