<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    // ========================
    // ADMIN: Daftar genre
    // ========================
    public function index()
    {
        $genres = Genre::withCount('movies')->orderBy('name')->get();
        return view('admin.genres.index', compact('genres'));
    }

    // ========================
    // ADMIN: Simpan genre baru
    // ========================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:genres,name',
        ]);

        Genre::create(['name' => $request->name]);

        return redirect()->route('admin.genres.index')->with('success', 'Genre berhasil ditambahkan.');
    }

    // ========================
    // ADMIN: Form edit genre
    // ========================
    public function edit($id)
    {
        $genre = Genre::findOrFail($id);
        return view('admin.genres.edit', compact('genre'));
    }

    // ========================
    // ADMIN: Update genre
    // ========================
    public function update(Request $request, $id)
    {
        $genre = Genre::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100|unique:genres,name,' . $id,
        ]);

        $genre->update(['name' => $request->name]);

        return redirect()->route('admin.genres.index')->with('success', 'Genre berhasil diperbarui.');
    }

    // ========================
    // ADMIN: Hapus genre
    // ========================
    public function destroy($id)
    {
        $genre = Genre::findOrFail($id);

        // Cegah hapus jika genre masih dipakai film
        if ($genre->movies()->count() > 0) {
            return back()->with('error', 'Genre tidak dapat dihapus karena masih digunakan oleh ' . $genre->movies()->count() . ' film.');
        }

        $genre->delete();

        return redirect()->route('admin.genres.index')->with('success', 'Genre berhasil dihapus.');
    }
}
