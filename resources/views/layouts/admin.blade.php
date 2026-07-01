<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') | ReelReview Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    {{-- NAVBAR ADMIN --}}
    <nav class="navbar">
        <a href="{{ route('admin.dashboard') }}" class="navbar-brand">🎬 ReelReview Admin</a>
        <ul class="navbar-links">
            <li>
                <form action="{{ route('logout') }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" style="background:none;border:none;color:#cbd5e1;cursor:pointer;font-size:0.9rem;">
                        Logout ({{ auth()->user()->name }})
                    </button>
                </form>
            </li>
        </ul>
    </nav>

    <div class="admin-wrapper">
        {{-- SIDEBAR --}}
        <aside class="admin-sidebar">
            <h3>Menu Admin</h3>
            <a href="{{ route('admin.dashboard') }}"
               class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                📊 Dashboard
            </a>
            <a href="{{ route('admin.genres.index') }}"
               class="{{ request()->routeIs('admin.genres.*') ? 'active' : '' }}">
                🏷️ Kelola Genre
            </a>
            <a href="{{ route('admin.movies.index') }}"
               class="{{ request()->routeIs('admin.movies.*') ? 'active' : '' }}">
                🎬 Kelola Film
            </a>
            <a href="{{ route('admin.reviews.index') }}"
               class="{{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
                💬 Review Pengguna
            </a>
            <a href="{{ route('movies.index') }}" style="margin-top: 1rem; border-top: 1px solid #334155; padding-top: 0.75rem;">
                🌐 Lihat Situs
            </a>
        </aside>

        {{-- CONTENT --}}
        <main class="admin-content">
            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif
            @if(session('info'))
                <div class="alert alert-info">{{ session('info') }}</div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>
