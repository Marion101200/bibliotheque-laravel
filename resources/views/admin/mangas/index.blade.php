<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des mangas</title>
</head>

<body>

    <h1>Gestion des mangas</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('admin.mangas.create') }}">
        Ajouter un manga
    </a>

    <hr>

    @forelse($mangas as $manga)

        <div>
            @if($manga->image)
                <img
                    src="{{ asset('storage/' . $manga->image) }}"
                    alt="{{ $manga->titre }}"
                    width="100"
                >
            @endif

            <h2>{{ $manga->titre }}</h2>

            <p>Auteur : {{ $manga->auteur }}</p>
            <p>Genre : {{ $manga->genre }}</p>
            <p>Nombre de tomes : {{ $manga->nombre_tomes }}</p>

            @if($manga->disponible)
                <p>Disponible</p>
            @else
                <p>Indisponible</p>
            @endif

            <a href="{{ route('admin.mangas.edit', $manga) }}">
                Modifier
            </a>

            <form
                action="{{ route('admin.mangas.destroy', $manga) }}"
                method="POST"
                style="display:inline"
            >
                @csrf
                @method('DELETE')

                <button type="submit">
                    Supprimer
                </button>
            </form>
        </div>

        <hr>

    @empty

        <p>Aucun manga dans le catalogue.</p>

    @endforelse

</body>
</html>