@extends('layouts.master')

@section('content')
<h2>Admin Login</h2>
<div class="d-flex gap-5">
    <a href="{{ url('/') }}" class="btn btn-primary">
        Back
    </a>
</div>
<form method="POST" action="/admin/login">
    @csrf
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control">
        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <button class="btn btn-primary">Login</button>
</form>
@endsection
