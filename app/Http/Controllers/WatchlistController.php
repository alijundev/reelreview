<?php

namespace App\Http\Controllers;

use App\Models\Watchlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatchlistController extends Controller
{
    // ========================
    // USER: Tampilkan daftar watchlist
    // ========================
    public function index()
    {
        $watchlists = Watchlist::with('movie.genre')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('watchlist.index', compact('watchlists'));
    }

    // ========================
    // USER: Tambah film ke watchlist
    // ========================
    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
        ]);

        // Cek duplikat
        $exists = Watchlist::where('user_id', Auth::id())
            ->where('movie_id', $request->movie_id)
            ->exists();

        if ($exists) {
            return back()->with('info', 'Film sudah ada di watchlist Anda.');
        }

        Watchlist::create([
            'user_id'  => Auth::id(),
            'movie_id' => $request->movie_id,
        ]);

        return back()->with('success', 'Film berhasil ditambahkan ke watchlist.');
    }

    // ========================
    // USER: Hapus film dari watchlist
    // ========================
    public function destroy($id)
    {
        $watchlist = Watchlist::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $watchlist->delete();

        return back()->with('success', 'Film berhasil dihapus dari watchlist.');
    }
}
