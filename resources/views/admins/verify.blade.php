@extends('layouts.master')

@section('content')
<h2>Admin Email Verification</h2>
<div class="d-flex gap-5">
    <a href="{{ url('/') }}" class="btn btn-primary">
        Back
    </a>
</div>
<form method="POST" action="{{ route('admin.verify') }}">
    @csrf
    <div class="mb-3">
        <label>Verification Code</label>
        <input type="text" name="verification_code" class="form-control">
        @error('verification_code') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <button class="btn btn-success">Verify</button>
</form>
@endsection
