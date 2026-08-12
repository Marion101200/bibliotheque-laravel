<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Catalogue des mangas</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
            color: #222;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .page-title {
            text-align: center;
            margin-bottom: 35px;
        }

        .page-title h1 {
            margin-bottom: 10px;
        }

        .page-title p {
            color: #666;
        }

        .catalogue {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 25px;
        }

        .manga-card {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .manga-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        }

        .manga-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .no-image {
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ddd;
            color: #777;
        }

        .manga-content {
            padding: 20px;
        }

        .manga-content h2 {
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 21px;
        }

        .manga-info {
            margin: 8px 0;
            color: #555;
        }

        .disponible {
            color: #16803c;
            font-weight: bold;
        }

        .indisponible {
            color: #c62828;
            font-weight: bold;
        }

        .emprunt-form {
            margin-top: 18px;
        }

        .emprunter {
            width: 100%;
            padding: 11px;
            background-color: #222;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
        }

        .emprunter:hover {
            background-color: #444;
        }

        .message {
            max-width: 1200px;
            margin: 20px auto;
            padding: 12px 20px;
            background-color: #dff5e5;
            color: #176b2c;
            border-radius: 6px;
        }

        .empty {
            text-align: center;
            padding: 50px;
            color: #666;
        }

        .filtres {
    display: flex;
    gap: 10px;
    margin-bottom: 30px;
    flex-wrap: wrap;
}

.filtres input,
.filtres select {
    padding: 11px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
}

.filtres input {
    flex: 1;
    min-width: 250px;
}

.filtres button,
.filtres a {
    padding: 11px 16px;
    border: none;
    border-radius: 6px;
    text-decoration: none;
    cursor: pointer;
}

.filtres button {
    background-color: #222;
    color: white;
}

.filtres a {
    background-color: #ddd;
    color: #222;
}
    </style>
</head>

<body>

    @include('components.navbar')

    <div class="container">

        <div class="page-title">
            <h1>📚 Catalogue des mangas</h1>
            <p>Découvrez notre collection de mangas</p>
        </div>

        <form method="GET" action="{{ route('mangas.index') }}" class="filtres">

    <input
        type="text"
        name="recherche"
        placeholder="Rechercher un manga ou un auteur..."
        value="{{ request('recherche') }}"
    >

    <select name="genre">
        <option value="">Tous les genres</option>

        @foreach($genres as $genre)
            <option
                value="{{ $genre }}"
                {{ request('genre') == $genre ? 'selected' : '' }}
            >
                {{ $genre }}
            </option>
        @endforeach
    </select>

    <select name="disponibilite">
        <option value="">Toutes les disponibilités</option>

        <option
            value="1"
            {{ request('disponibilite') === '1' ? 'selected' : '' }}
        >
            Disponible
        </option>

        <option
            value="0"
            {{ request('disponibilite') === '0' ? 'selected' : '' }}
        >
            Indisponible
        </option>
    </select>

    <button type="submit">
        Rechercher
    </button>

    <a href="{{ route('mangas.index') }}">
        Réinitialiser
    </a>

</form>

        @if(session('success'))
            <div class="message">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="message">
                {{ session('error') }}
            </div>
        @endif

        @if($mangas->isEmpty())

            <div class="empty">
                <h2>Aucun manga disponible</h2>
                <p>Le catalogue est actuellement vide.</p>
            </div>

        @else

            <div class="catalogue">

                @foreach($mangas as $manga)

                    <div class="manga-card">

                        @if($manga->image)

                            <img
                                src="{{ asset('storage/' . $manga->image) }}"
                                alt="{{ $manga->titre }}"
                                class="manga-image"
                            >

                        @else

                            <div class="no-image">
                                Aucune image
                            </div>

                        @endif

                        <div class="manga-content">

                            <a href="{{ route('mangas.show', $manga) }}">
    <h2>{{ $manga->titre }}</h2>
</a>

                            <p class="manga-info">
                                <strong>Auteur :</strong>
                                {{ $manga->auteur }}
                            </p>

                            <p class="manga-info">
                                <strong>Genre :</strong>
                                {{ $manga->genre }}
                            </p>

                            <p class="manga-info">
                                <strong>Tomes :</strong>
                                {{ $manga->nombre_tomes }}
                            </p>

                            @if($manga->disponible)

                                <p class="disponible">
                                    ● Disponible
                                </p>

                                <form
                                    action="{{ route('emprunts.store', $manga) }}"
                                    method="POST"
                                    class="emprunt-form"
                                >
                                    @csrf

                                    <button type="submit" class="emprunter">
                                        Emprunter
                                    </button>
                                </form>

                            @else

                                <p class="indisponible">
                                    ● Indisponible
                                </p>

                            @endif

                        </div>

                    </div>

                @endforeach

            </div>

        @endif

    </div>

</body>
</html>