@extends('layouts.master')

@section('content')
    <h2>Admin Registration</h2>
    <div class="d-flex gap-5">
        <a href="{{ url('/') }}" class="btn btn-primary">
            Back
        </a>
    </div>
    <form action="{{ route('admin.register') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}"
                class="form-control  @error('first_name') is-invalid @enderror">
            @error('first_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control">
            @error('last_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" value="{{ old('email') }}" class="form-control">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
        Already have an account? <a href="{{ route('show.admin.login.form') }}"> Sign In</a>
    </form>
@endsection
