@extends('layouts.app')
@section('title', 'Login')

@section('content')
<div class="auth-wrapper">
    <div class="auth-box">
        <h2>Login ke ReelReview</h2>

        @if ($errors->any())
            <div class="alert alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-full">Login</button>
        </form>

        <p class="text-center mt-2 text-muted">
            Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
        </p>
    </div>
</div>
@endsection
