@extends('layouts.admin')
@section('title', 'Dashboard Admin')

@section('content')
    <div class="page-header">
        <h1>📊 Dashboard</h1>
        <p>Ringkasan data aplikasi ReelReview.</p>
    </div>

    {{-- STATISTIK --}}
    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-card-number">{{ $stats['total_movies'] }}</div>
            <div class="stat-card-label">Film</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-number">{{ $stats['total_genres'] }}</div>
            <div class="stat-card-label">Genre</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-number">{{ $stats['total_reviews'] }}</div>
            <div class="stat-card-label">Review</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-number">{{ $stats['total_users'] }}</div>
            <div class="stat-card-label">Pengguna</div>
        </div>
    </div>

    {{-- REVIEW TERBARU --}}
    <div class="page-header">
        <h2 style="font-size:1.1rem;">💬 Review Terbaru</h2>
    </div>

    @if($latestReviews->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Pengguna</th>
                    <th>Film</th>
                    <th>Rating</th>
                    <th>Spoiler</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($latestReviews as $review)
                    <tr>
                        <td>{{ $review->user->name }}</td>
                        <td>
                            <a href="{{ route('movies.show', $review->movie->id) }}">
                                {{ $review->movie->title }}
                            </a>
                        </td>
                        <td><span class="badge badge-rating">⭐ {{ $review->rating }}/10</span></td>
                        <td>{{ $review->is_spoiler ? '⚠️ Ya' : '-' }}</td>
                        <td class="text-muted">{{ $review->created_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary btn-sm mt-1">Lihat Semua Review</a>
    @else
        <p class="text-muted">Belum ada review.</p>
    @endif
@endsection
