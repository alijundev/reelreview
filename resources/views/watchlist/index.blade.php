@extends('layouts.app')
@section('title', 'Watchlist Saya')

@section('content')
<div class="container">
    <div class="page-header">
        <h1>🎯 Watchlist Saya</h1>
        <p>Film yang ingin Anda tonton nanti.</p>
    </div>

    @if($watchlists->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Judul Film</th>
                    <th>Genre</th>
                    <th>Tahun</th>
                    <th>Durasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($watchlists as $item)
                    <tr>
                        <td>
                            <a href="{{ route('movies.show', $item->movie->id) }}">
                                {{ $item->movie->title }}
                            </a>
                        </td>
                        <td>
                            <span class="badge badge-genre">{{ $item->movie->genre->name }}</span>
                        </td>
                        <td>{{ $item->movie->release_year }}</td>
                        <td>{{ $item->movie->duration }} menit</td>
                        <td>
                            <form action="{{ route('watchlist.destroy', $item->id) }}" method="POST"
                                  onsubmit="return confirm('Hapus dari watchlist?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="card text-center">
            <p class="text-muted">Watchlist Anda kosong. <a href="{{ route('movies.index') }}">Cari film</a> dan tambahkan ke watchlist.</p>
        </div>
    @endif
</div>
@endsection
