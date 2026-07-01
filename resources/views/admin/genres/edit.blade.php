@extends('layouts.admin')
@section('title', 'Edit Genre')

@section('content')
    <div class="page-header">
        <h1>✏️ Edit Genre</h1>
    </div>

    <div class="card" style="max-width: 480px;">
        <form action="{{ route('admin.genres.update', $genre->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nama Genre</label>
                <input type="text" id="name" name="name"
                       value="{{ old('name', $genre->name) }}" required>
                @error('name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex gap-1">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.genres.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
