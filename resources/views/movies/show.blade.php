@extends('layouts.app')
@section('title', $movie->title)

@section('content')
<div class="container">

    {{-- INFO FILM --}}
    <div class="card">
        <div class="flex justify-between items-center mb-2">
            <div>
                <span class="badge badge-genre">{{ $movie->genre->name }}</span>
            </div>
            <a href="{{ route('movies.index') }}" class="btn btn-secondary btn-sm">← Kembali</a>
        </div>

        <h1 style="font-size:1.6rem; margin-bottom:0.5rem;">{{ $movie->title }}</h1>

        <div class="text-muted mb-2">
            🎬 {{ $movie->director }} &nbsp;|&nbsp;
            📅 {{ $movie->release_year }} &nbsp;|&nbsp;
            ⏱️ {{ $movie->duration }} menit
        </div>

        @if($avgRating)
            <div style="font-size:1.1rem; color:#d97706; font-weight:700; margin-bottom:0.75rem;">
                ⭐ Rating rata-rata: {{ number_format($avgRating, 1) }}/10
                <span class="text-muted" style="font-size:0.85rem;">({{ $reviews->count() }} review)</span>
            </div>
        @else
            <p class="text-muted mb-2">Belum ada rating.</p>
        @endif

        <p style="line-height:1.7;">{{ $movie->synopsis }}</p>
    </div>

    {{-- TOMBOL WATCHLIST --}}
    @auth
        @if(!auth()->user()->isAdmin())
            @if($inWatchlist)
                <div class="alert alert-info">✅ Film ini sudah ada di watchlist Anda.</div>
            @else
                <form action="{{ route('watchlist.store') }}" method="POST" class="mb-2">
                    @csrf
                    <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                    <button type="submit" class="btn btn-success">+ Tambah ke Watchlist</button>
                </form>
            @endif
        @endif
    @endauth

    {{-- FORM REVIEW --}}
    @auth
        @if(!auth()->user()->isAdmin())
            <div class="card mt-2">
                @if($userReview)
                    <h2 class="card-title">✏️ Edit Review Anda</h2>
                    <form action="{{ route('reviews.update', $userReview->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="rating">Rating (1–10)</label>
                            <input type="number" id="rating" name="rating"
                                   min="1" max="10" value="{{ old('rating', $userReview->rating) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="review_text">Review</label>
                            <textarea id="review_text" name="review_text" required>{{ old('review_text', $userReview->review_text) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="is_spoiler" value="1"
                                    {{ $userReview->is_spoiler ? 'checked' : '' }}>
                                Tandai sebagai spoiler
                            </label>
                        </div>
                        <div class="flex gap-1">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <form action="{{ route('reviews.destroy', $userReview->id) }}" method="POST"
                                  onsubmit="return confirm('Hapus review ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus Review</button>
                            </form>
                        </div>
                    </form>
                @else
                    <h2 class="card-title">✍️ Tulis Review</h2>
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                        <div class="form-group">
                            <label for="rating">Rating (1–10)</label>
                            <input type="number" id="rating" name="rating"
                                   min="1" max="10" value="{{ old('rating') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="review_text">Review</label>
                            <textarea id="review_text" name="review_text"
                                      placeholder="Tulis ulasan Anda..." required>{{ old('review_text') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="is_spoiler" value="1">
                                Tandai sebagai spoiler
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Review</button>
                    </form>
                @endif
            </div>
        @endif
    @else
        <div class="card text-center mt-2">
            <p class="text-muted">
                <a href="{{ route('login') }}">Login</a> untuk menulis review dan menambahkan ke watchlist.
            </p>
        </div>
    @endauth

    {{-- DAFTAR REVIEW --}}
    <div class="page-header mt-3">
        <h2 style="font-size:1.2rem;">💬 Review Pengguna ({{ $reviews->count() }})</h2>
    </div>

    @forelse($reviews as $review)
        <div class="card">
            <div class="flex justify-between items-center mb-1">
                <strong>{{ $review->user->name }}</strong>
                <span class="rating-display">⭐ {{ $review->rating }}/10</span>
            </div>

            @if($review->is_spoiler)
                <div class="mb-1">
                    <span class="badge badge-spoiler">⚠️ Mengandung Spoiler</span>
                </div>
                <div class="spoiler-content" id="spoiler-{{ $review->id }}">
                    <p>{{ $review->review_text }}</p>
                </div>
                <button class="btn btn-warning btn-sm mt-1"
                        onclick="document.getElementById('spoiler-{{ $review->id }}').classList.toggle('revealed')">
                    Tampilkan / Sembunyikan Spoiler
                </button>
            @else
                <p>{{ $review->review_text }}</p>
            @endif

            <div class="text-muted mt-1">{{ $review->created_at->format('d M Y') }}</div>
        </div>
    @empty
        <div class="card text-center">
            <p class="text-muted">Belum ada review untuk film ini.</p>
        </div>
    @endforelse

</div>
@endsection
