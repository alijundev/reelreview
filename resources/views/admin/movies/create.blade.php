@extends('layouts.admin')
@section('title', 'Tambah Film')

@section('content')
    <div class="page-header">
        <h1>➕ Tambah Film Baru</h1>
    </div>

    <div class="card" style="max-width: 600px;">
        <form action="{{ route('admin.movies.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Judul Film</label>
                <input type="text" id="title" name="title"
                       value="{{ old('title') }}" required>
                @error('title')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="synopsis">Sinopsis</label>
                <textarea id="synopsis" name="synopsis" rows="4" required>{{ old('synopsis') }}</textarea>
                @error('synopsis')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="director">Sutradara</label>
                <input type="text" id="director" name="director"
                       value="{{ old('director') }}" required>
                @error('director')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                <div class="form-group">
                    <label for="release_year">Tahun Rilis</label>
                    <input type="number" id="release_year" name="release_year"
                           min="1900" max="{{ date('Y') + 1 }}"
                           value="{{ old('release_year') }}" required>
                    @error('release_year')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="duration">Durasi (menit)</label>
                    <input type="number" id="duration" name="duration"
                           min="1" value="{{ old('duration') }}" required>
                    @error('duration')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="form-group">
                <label for="genre_id">Genre</label>
                <select id="genre_id" name="genre_id" required>
                    <option value="">-- Pilih Genre --</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}"
                            {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
                @error('genre_id')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="flex gap-1">
                <button type="submit" class="btn btn-primary">Simpan Film</button>
                <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
