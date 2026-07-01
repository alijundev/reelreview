<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Review;
use App\Models\User;

class AdminController extends Controller
{
    // ========================
    // ADMIN: Dashboard statistik
    // ========================
    public function dashboard()
    {
        $stats = [
            'total_movies'  => Movie::count(),
            'total_genres'  => Genre::count(),
            'total_reviews' => Review::count(),
            'total_users'   => User::where('role', 'user')->count(),
        ];

        // 5 review terbaru
        $latestReviews = Review::with(['user', 'movie'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'latestReviews'));
    }

    // ========================
    // ADMIN: Pantau semua review
    // ========================
    public function reviews()
    {
        $reviews = Review::with(['user', 'movie'])->latest()->paginate(20);
        return view('admin.reviews.index', compact('reviews'));
    }
}
