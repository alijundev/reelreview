@extends('layouts.admin')
@section('title', 'Kelola Film')

@section('content')
    <div class="page-header flex justify-between items-center">
        <div>
            <h1>🎬 Kelola Film</h1>
            <p>Total {{ $movies->total() }} film.</p>
        </div>
        <a href="{{ route('admin.movies.create') }}" class="btn btn-primary">+ Tambah Film</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Genre</th>
                <th>Sutradara</th>
                <th>Tahun</th>
                <th>Durasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($movies as $i => $movie)
                <tr>
                    <td>{{ ($movies->currentPage() - 1) * $movies->perPage() + $i + 1 }}</td>
                    <td>
                        <a href="{{ route('movies.show', $movie->id) }}">{{ $movie->title }}</a>
                    </td>
                    <td><span class="badge badge-genre">{{ $movie->genre->name }}</span></td>
                    <td>{{ $movie->director }}</td>
                    <td>{{ $movie->release_year }}</td>
                    <td>{{ $movie->duration }} mnt</td>
                    <td class="flex gap-1">
                        <a href="{{ route('admin.movies.edit', $movie->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.movies.destroy', $movie->id) }}" method="POST"
                              onsubmit="return confirm('Hapus film {{ $movie->title }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada film.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{ $movies->links() }}
    </div>
@endsection
