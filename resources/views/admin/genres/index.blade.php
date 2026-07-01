@extends('layouts.admin')
@section('title', 'Kelola Genre')

@section('content')
    <div class="page-header flex justify-between items-center">
        <div>
            <h1>🏷️ Kelola Genre</h1>
            <p>Total {{ $genres->count() }} genre.</p>
        </div>
    </div>

    {{-- FORM TAMBAH GENRE --}}
    <div class="card mb-2">
        <h2 class="card-title">Tambah Genre Baru</h2>
        <form action="{{ route('admin.genres.store') }}" method="POST" style="display:flex; gap:0.75rem; align-items:flex-end;">
            @csrf
            <div class="form-group" style="flex:1; margin-bottom:0;">
                <label for="name">Nama Genre</label>
                <input type="text" id="name" name="name"
                       value="{{ old('name') }}" placeholder="Contoh: Action" required>
                @error('name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>

    {{-- TABEL GENRE --}}
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Genre</th>
                <th>Jumlah Film</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($genres as $i => $genre)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $genre->name }}</td>
                    <td>{{ $genre->movies_count }} film</td>
                    <td class="flex gap-1">
                        <a href="{{ route('admin.genres.edit', $genre->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.genres.destroy', $genre->id) }}" method="POST"
                              onsubmit="return confirm('Hapus genre {{ $genre->name }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Belum ada genre.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
