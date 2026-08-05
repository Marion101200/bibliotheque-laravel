<!DOCTYPE html>
<html>
<head>
    <title>Bibliothèque Manga</title>
</head>

<body>

<h1>Ma bibliothèque de mangas</h1>

@foreach($mangas as $manga)

    <div>
        <h2>{{ $manga->titre }}</h2>

        <p>Auteur : {{ $manga->auteur }}</p>

        <p>Genre : {{ $manga->genre }}</p>

        <p>Tomes : {{ $manga->nombre_tomes }}</p>

        @if($manga->disponible)
            <p>✅ Disponible</p>
        @else
            <p>❌ Emprunté</p>
        @endif

    </div>

    <hr>

@endforeach

</body>
</html>