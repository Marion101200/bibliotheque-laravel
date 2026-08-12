<nav class="navbar">
    <div class="navbar-container">

        <a href="{{ route('mangas.index') }}" class="logo">
            📚 MangaLib
        </a>

        <div class="navbar-links">

            <a href="{{ route('mangas.index') }}">
                Catalogue
            </a>

            @auth
                <a href="{{ route('emprunts.index') }}">
                    Mes emprunts
                </a>

                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin') }}">
                        Administration
                    </a>
                @endif

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit">
                        Déconnexion
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}">
                    Connexion
                </a>

                <a href="{{ route('register') }}">
                    Inscription
                </a>
            @endauth

        </div>

    </div>
</nav>

<style>
    .navbar {
        background-color: #222;
        padding: 15px 30px;
        margin-bottom: 30px;
    }

    .navbar-container {
        max-width: 1200px;
        margin: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        color: white;
        text-decoration: none;
        font-size: 22px;
        font-weight: bold;
    }

    .navbar-links {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .navbar-links a {
        color: white;
        text-decoration: none;
    }

    .navbar-links a:hover {
        text-decoration: underline;
    }

    .navbar-links button {
        background: none;
        border: none;
        color: white;
        cursor: pointer;
        font-size: 16px;
    }

    .navbar-links button:hover {
        text-decoration: underline;
    }
</style>