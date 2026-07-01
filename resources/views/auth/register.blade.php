@extends('layouts.app')
@section('title', 'Register')

@section('content')
<div class="auth-wrapper">
    <div class="auth-box">
        <h2>Daftar Akun Baru</h2>

        @if ($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 1rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" id="name" name="name"
                       value="{{ old('name') }}" required autofocus>
                @error('name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}" required>
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

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation"
                       name="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-primary w-full">Daftar</button>
        </form>

        <p class="text-center mt-2 text-muted">
            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
        </p>
    </div>
</div>
@endsection
