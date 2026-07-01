<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ReelReview - Platform review dan rekomendasi film">
    <title>@yield('title', 'ReelReview') | ReelReview</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="navbar">
        <a href="{{ route('movies.index') }}" class="navbar-brand">🎬 ReelReview</a>

        {{-- Search Bar --}}
        <form action="{{ route('movies.index') }}" method="GET" class="navbar-search">
            <input type="text" name="search" placeholder="Cari film..." value="{{ request('search') }}">
            <button type="submit">Cari</button>
        </form>

        {{-- Links --}}
        <ul class="navbar-links">
            <li><a href="{{ route('movies.index') }}">Film</a></li>

            @auth
                @if(auth()->user()->isAdmin())
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
                @else
                    <li><a href="{{ route('watchlist.index') }}">Watchlist</a></li>
                @endif
                <li>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline">
                        @csrf
                        <button type="submit" style="background:none;border:none;color:#cbd5e1;cursor:pointer;font-size:0.9rem;">
                            Logout ({{ auth()->user()->name }})
                        </button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @endauth
        </ul>
    </nav>

    {{-- FLASH MESSAGES --}}
    <div class="container" style="margin-top: 1rem; margin-bottom: 0;">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif
    </div>

    {{-- MAIN CONTENT --}}
    @yield('content')

    <footer>
        &copy; {{ date('Y') }} ReelReview &mdash; Tugas Sistem Operasi &mdash; Docker Compose + Laravel
    </footer>

</body>
</html>
