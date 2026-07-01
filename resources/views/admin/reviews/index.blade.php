@extends('layouts.admin')
@section('title', 'Review Pengguna')

@section('content')
    <div class="page-header">
        <h1>💬 Review Pengguna</h1>
        <p>Total {{ $reviews->total() }} review.</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Pengguna</th>
                <th>Film</th>
                <th>Rating</th>
                <th>Review</th>
                <th>Spoiler</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reviews as $review)
                <tr>
                    <td>{{ $review->user->name }}</td>
                    <td>
                        <a href="{{ route('movies.show', $review->movie->id) }}">
                            {{ $review->movie->title }}
                        </a>
                    </td>
                    <td><span class="badge badge-rating">⭐ {{ $review->rating }}/10</span></td>
                    <td style="max-width: 250px;">
                        <span style="font-size:0.85rem;">{{ Str::limit($review->review_text, 80) }}</span>
                    </td>
                    <td>{{ $review->is_spoiler ? '⚠️ Ya' : '-' }}</td>
                    <td class="text-muted">{{ $review->created_at->format('d M Y') }}</td>
                    <td>
                        <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST"
                              onsubmit="return confirm('Hapus review ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada review.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{ $reviews->links() }}
    </div>
@endsection
