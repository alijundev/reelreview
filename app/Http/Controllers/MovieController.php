<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Review;
use App\Models\Watchlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    // ========================
    // PUBLIC: Daftar film
    // ========================
    public function index(Request $request)
    {
        $genres = Genre::orderBy('name')->get();
        $query  = Movie::with('genre')->withAvg('reviews', 'rating');

        // Search berdasarkan judul
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan genre
        if ($request->filled('genre')) {
            $query->where('genre_id', $request->genre);
        }

        $movies = $query->orderBy('title')->paginate(12)->withQueryString();

        // Rekomendasi: 6 film dengan rating tertinggi
        $recommendations = Movie::with('genre')
            ->withAvg('reviews', 'rating')
            ->has('reviews')
            ->orderByDesc('reviews_avg_rating')
            ->take(6)
            ->get();

        return view('movies.index', compact('movies', 'genres', 'recommendations'));
    }

    // ========================
    // PUBLIC: Detail film
    // ========================
    public function show($id)
    {
        $movie   = Movie::with(['genre', 'reviews.user'])->findOrFail($id);
        $reviews = $movie->reviews()->with('user')->latest()->get();
        $avgRating = $movie->reviews()->avg('rating');

        // Cek apakah user sudah punya review & watchlist untuk film ini
        $userReview   = null;
        $inWatchlist  = false;

        if (Auth::check()) {
            $userReview  = $movie->reviews()->where('user_id', Auth::id())->first();
            $inWatchlist = Watchlist::where('user_id', Auth::id())
                ->where('movie_id', $id)
                ->exists();
        }

        return view('movies.show', compact('movie', 'reviews', 'avgRating', 'userReview', 'inWatchlist'));
    }

    // ========================
    // ADMIN: Daftar film di panel
    // ========================
    public function adminIndex()
    {
        $movies = Movie::with('genre')->orderBy('title')->paginate(15);
        return view('admin.movies.index', compact('movies'));
    }

    // ========================
    // ADMIN: Form tambah film
    // ========================
    public function create()
    {
        $genres = Genre::orderBy('name')->get();
        return view('admin.movies.create', compact('genres'));
    }

    // ========================
    // ADMIN: Simpan film baru
    // ========================
    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'synopsis'     => 'required|string',
            'director'     => 'required|string|max:255',
            'release_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'duration'     => 'required|integer|min:1',
            'genre_id'     => 'required|exists:genres,id',
            'poster_file'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'poster_url'   => 'nullable|url|max:500',
        ]);

        $posterPath = null;

        if ($request->hasFile('poster_file')) {
            $path = $request->file('poster_file')->store('posters', 'public');
            $posterPath = 'storage/' . $path;
        } elseif ($request->filled('poster_url')) {
            $posterPath = $request->poster_url;
        }

        Movie::create([
            'title'        => $request->title,
            'synopsis'     => $request->synopsis,
            'director'     => $request->director,
            'release_year' => $request->release_year,
            'duration'     => $request->duration,
            'genre_id'     => $request->genre_id,
            'poster'       => $posterPath,
        ]);

        return redirect()->route('admin.movies.index')->with('success', 'Film berhasil ditambahkan.');
    }

    // ========================
    // ADMIN: Form edit film
    // ========================
    public function edit($id)
    {
        $movie  = Movie::findOrFail($id);
        $genres = Genre::orderBy('name')->get();
        return view('admin.movies.edit', compact('movie', 'genres'));
    }

    // ========================
    // ADMIN: Update film
    // ========================
    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        $request->validate([
            'title'        => 'required|string|max:255',
            'synopsis'     => 'required|string',
            'director'     => 'required|string|max:255',
            'release_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'duration'     => 'required|integer|min:1',
            'genre_id'     => 'required|exists:genres,id',
            'poster_file'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'poster_url'   => 'nullable|url|max:500',
        ]);

        $posterPath = $movie->poster; // Default ke poster lama

        if ($request->hasFile('poster_file')) {
            // Hapus file lama jika ada di local storage
            if ($movie->poster && str_starts_with($movie->poster, 'storage/')) {
                @unlink(public_path(str_replace('storage/', 'storage/app/public/', $movie->poster)));
            }
            $path = $request->file('poster_file')->store('posters', 'public');
            $posterPath = 'storage/' . $path;
        } elseif ($request->filled('poster_url')) {
            $posterPath = $request->poster_url;
        }

        $movie->update([
            'title'        => $request->title,
            'synopsis'     => $request->synopsis,
            'director'     => $request->director,
            'release_year' => $request->release_year,
            'duration'     => $request->duration,
            'genre_id'     => $request->genre_id,
            'poster'       => $posterPath,
        ]);

        return redirect()->route('admin.movies.index')->with('success', 'Film berhasil diperbarui.');
    }

    // ========================
    // ADMIN: Hapus film
    // ========================
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->route('admin.movies.index')->with('success', 'Film berhasil dihapus.');
    }
}
