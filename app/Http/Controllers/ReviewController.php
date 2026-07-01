<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // ========================
    // USER: Simpan review baru
    // ========================
    public function store(Request $request)
    {
        $request->validate([
            'movie_id'    => 'required|exists:movies,id',
            'rating'      => 'required|integer|min:1|max:10',
            'review_text' => 'required|string|min:5',
            'is_spoiler'  => 'nullable|boolean',
        ]);

        // Cek apakah user sudah punya review untuk film ini
        $exists = Review::where('user_id', Auth::id())
            ->where('movie_id', $request->movie_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Anda sudah memberikan review untuk film ini.');
        }

        Review::create([
            'user_id'     => Auth::id(),
            'movie_id'    => $request->movie_id,
            'rating'      => $request->rating,
            'review_text' => $request->review_text,
            'is_spoiler'  => $request->boolean('is_spoiler'),
        ]);

        return back()->with('success', 'Review berhasil ditambahkan.');
    }

    // ========================
    // USER: Edit review sendiri
    // ========================
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        // Pastikan hanya pemilik yang bisa edit
        if ($review->user_id !== Auth::id()) {
            return back()->with('error', 'Anda tidak bisa mengedit review orang lain.');
        }

        $request->validate([
            'rating'      => 'required|integer|min:1|max:10',
            'review_text' => 'required|string|min:5',
            'is_spoiler'  => 'nullable|boolean',
        ]);

        $review->update([
            'rating'      => $request->rating,
            'review_text' => $request->review_text,
            'is_spoiler'  => $request->boolean('is_spoiler'),
        ]);

        return back()->with('success', 'Review berhasil diperbarui.');
    }

    // ========================
    // USER: Hapus review sendiri
    // ========================
    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        // Pastikan hanya pemilik yang bisa hapus
        if ($review->user_id !== Auth::id()) {
            return back()->with('error', 'Anda tidak bisa menghapus review orang lain.');
        }

        $review->delete();

        return back()->with('success', 'Review berhasil dihapus.');
    }

    // ========================
    // ADMIN: Hapus review manapun
    // ========================
    public function adminDestroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return back()->with('success', 'Review berhasil dihapus oleh Admin.');
    }
}
