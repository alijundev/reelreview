@extends('layouts.app')
@section('title', 'Daftar Film')

@section('content')
<div class="container">

    {{-- FILTER BAR --}}
    <form action="{{ route('movies.index') }}" method="GET" class="filter-bar">
        <label for="genre" style="font-size:0.9rem; font-weight:600;">Filter Genre:</label>
        <select name="genre" id="genre" onchange="this.form.submit()">
            <option value="">Semua Genre</option>
            @foreach($genres as $genre)
                <option value="{{ $genre->id }}"
                    {{ request('genre') == $genre->id ? 'selected' : '' }}>
                    {{ $genre->name }}
                </option>
            @endforeach
        </select>

        @if(request('search') || request('genre'))
            <a href="{{ route('movies.index') }}" class="btn btn-secondary btn-sm">Reset</a>
        @endif

        @if(request('search'))
            <span class="text-muted">Hasil pencarian: <strong>"{{ request('search') }}"</strong></span>
        @endif
    </form>

    {{-- DAFTAR FILM --}}
    <div class="page-header">
        <h1>🎬 Daftar Film</h1>
        <p>Total {{ $movies->total() }} film ditemukan.</p>
    </div>

    @if($movies->count() > 0)
        <div class="movie-grid">
            @foreach($movies as $movie)
                <a href="{{ route('movies.show', $movie->id) }}" style="text-decoration:none; color:inherit;">
                    <div class="movie-card">
                        <div class="movie-card-genre">{{ $movie->genre->name }}</div>
                        <div class="movie-card-title">{{ $movie->title }}</div>
                        <div class="movie-card-meta">{{ $movie->director }} &bull; {{ $movie->release_year }}</div>
                        <div class="movie-card-meta">{{ $movie->duration }} menit</div>
                        @if($movie->reviews_avg_rating)
                            <div class="movie-card-rating">⭐ {{ number_format($movie->reviews_avg_rating, 1) }}/10</div>
                        @else
                            <div class="text-muted" style="font-size:0.8rem;">Belum ada rating</div>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>

        {{-- PAGINATION --}}
        <div class="pagination">
            {{ $movies->links() }}
        </div>
    @else
        <div class="card text-center">
            <p class="text-muted">Tidak ada film yang ditemukan.</p>
        </div>
    @endif

    {{-- REKOMENDASI --}}
    @if($recommendations->count() > 0 && !request('search') && !request('genre'))
        <div class="page-header mt-3">
            <h1>⭐ Film Terbaik</h1>
            <p>Berdasarkan rating tertinggi dari pengguna.</p>
        </div>
        <div class="movie-grid">
            @foreach($recommendations as $movie)
                <a href="{{ route('movies.show', $movie->id) }}" style="text-decoration:none; color:inherit;">
                    <div class="movie-card">
                        <div class="movie-card-genre">{{ $movie->genre->name }}</div>
                        <div class="movie-card-title">{{ $movie->title }}</div>
                        <div class="movie-card-meta">{{ $movie->director }} &bull; {{ $movie->release_year }}</div>
                        <div class="movie-card-rating">⭐ {{ number_format($movie->reviews_avg_rating, 1) }}/10</div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif

</div>
@endsection
