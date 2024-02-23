@extends('layouts.admin')


@section('content')

<x-guest-layout>
    
        
<div style="width: 60em; padding-left: 10em;">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('accounts.update',$user->id) }}">
            @csrf
            @method('put')

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full @error('name') is-invalid @enderror" type="text" name="name" :value="old('name', $user->name)" required autofocus />
                @error('name')
				<p class="invalid-feedback">{{ $message }}</p>
				@enderror
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full @error('email') is-invalid @enderror" type="email" name="email" :value="old('email', $user->email)" />
                @error('email')
				<p class="invalid-feedback">{{ $message }}</p>
				@enderror
            </div>

            <div class="mt-4">
                <x-label for="mobile" :value="__('Mobile')" />

                <x-input id="mobile" class="block mt-1 w-full @error('mobile') is-invalid @enderror" type="number" name="mobile" :value="old('mobile', $user->mobile)" required />
                @error('mobile')
				<p class="invalid-feedback">{{ $message }}</p>
				@enderror
            </div>

            <div class="mt-4">
                <x-label for="year" :value="__('Year')" />
                <select class="block w-full form-select mt-1 @error('year') is-invalid @enderror" for="year" name="year">
                    <option value="1" @if (old('year',$user->year) == 1) selected @endif>First Year</option>
                    <option value="2" @if (old('year',$user->year) == 2) selected @endif>Second Year</option>
                    <option value="3" @if (old('year',$user->year) == 3) selected @endif>Third Year</option>
                    <option value="4" @if (old('year',$user->year) == 4) selected @endif>Fourth Year</option>
                    <option value="5" @if (old('year',$user->year) == 5) selected @endif>Fifth Year</option>
                    <option value="6" @if (old('year',$user->year) == 6) selected @endif>Six Year</option>
                </select>
                @error('year')
				<p class="invalid-feedback">{{ $message }}</p>
				@enderror
            </div>
            <div class="mt-4">
                <x-label for="faculty_id" :value="__('Faculty')" />
                <select class="block w-full form-select mt-1" for="faculty_id" name="faculty_id">
                    @foreach($faculties as $faculty)
                    <option value="{{$faculty->id}}" {{ $faculty->id == old('faculty_id',$user->faculty_id) ? 'selected' : '' }}>{{$faculty->name}}</option>
                    @endforeach
                </select>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-4">
                    {{ __('Update ' . $user->role) }}
                </x-button>
            </div>
        </form>
        </div>
</x-guest-layout>
@endsection