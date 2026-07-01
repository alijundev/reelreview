@extends('layouts.admin')
@section('title', 'Edit Film')

@section('content')
    <div class="page-header">
        <h1>✏️ Edit Film: {{ $movie->title }}</h1>
    </div>

    <div class="card" style="max-width: 600px;">
        <form action="{{ route('admin.movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Judul Film</label>
                <input type="text" id="title" name="title"
                       value="{{ old('title', $movie->title) }}" required>
                @error('title')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="synopsis">Sinopsis</label>
                <textarea id="synopsis" name="synopsis" rows="4" required>{{ old('synopsis', $movie->synopsis) }}</textarea>
                @error('synopsis')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="director">Sutradara</label>
                <input type="text" id="director" name="director"
                       value="{{ old('director', $movie->director) }}" required>
                @error('director')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                <div class="form-group">
                    <label for="release_year">Tahun Rilis</label>
                    <input type="number" id="release_year" name="release_year"
                           min="1900" max="{{ date('Y') + 1 }}"
                           value="{{ old('release_year', $movie->release_year) }}" required>
                    @error('release_year')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="duration">Durasi (menit)</label>
                    <input type="number" id="duration" name="duration"
                           min="1" value="{{ old('duration', $movie->duration) }}" required>
                    @error('duration')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="form-group">
                <label for="genre_id">Genre</label>
                <select id="genre_id" name="genre_id" required>
                    <option value="">-- Pilih Genre --</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}"
                            {{ old('genre_id', $movie->genre_id) == $genre->id ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
                @error('genre_id')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group" style="border: 1px dashed #cbd5e1; padding: 1rem; border-radius: 6px; background: #f8fafc; margin-bottom: 1rem;">
                <label style="font-weight: 700; margin-bottom: 0.5rem; display: block; color: #1e293b;">🖼️ Poster Film</label>
                
                @if($movie->poster)
                    <div style="margin-bottom: 1rem;">
                        <span style="font-size: 0.8rem; color: #6b7280; display: block; margin-bottom: 0.25rem;">Poster Saat Ini:</span>
                        <img src="{{ $movie->poster_url }}" alt="Poster {{ $movie->title }}" style="width: 100px; height: auto; border-radius: 4px; border: 1px solid #cbd5e1; display: block;">
                    </div>
                @endif

                <div class="form-group">
                    <label for="poster_file" style="font-weight: 500;">Unggah File Baru (PNG, JPG, JPEG, WEBP)</label>
                    <input type="file" id="poster_file" name="poster_file" accept="image/*">
                    @error('poster_file')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div style="text-align: center; margin: 0.5rem 0; color: #94a3b8; font-size: 0.85rem; font-weight: 600;">— ATAU —</div>

                <div class="form-group">
                    <label for="poster_url" style="font-weight: 500;">URL Gambar dari Internet</label>
                    <input type="url" id="poster_url" name="poster_url"
                           value="{{ old('poster_url', (str_starts_with($movie->poster, 'http') ? $movie->poster : '')) }}" placeholder="https://example.com/poster.jpg">
                    @error('poster_url')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="flex gap-1">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
