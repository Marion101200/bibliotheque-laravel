<!DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

```
<title>Catalogue des mangas</title>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 30px;
        background-color: #f5f5f5;
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
    }

    .catalogue {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 25px;
    }

    .manga {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .manga img {
        display: block;
        width: 150px;
        height: 220px;
        object-fit: cover;
        margin: 0 auto 15px;
        border-radius: 5px;
    }

    .manga h2 {
        margin-top: 0;
        font-size: 20px;
    }

    .manga p {
        margin: 8px 0;
    }

    .disponible {
        color: green;
        font-weight: bold;
    }

    .indisponible {
        color: red;
        font-weight: bold;
    }

.emprunter {
    display: inline-block;
    margin-top: 15px;
    padding: 10px 15px;
    background-color: #333;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.emprunter:hover {
    background-color: #555;
}
</style>
```

</head>

<body>

```
<h1>📚 Catalogue des mangas</h1>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<div class="catalogue">

    @forelse($mangas as $manga)

        <div class="manga">

            @if($manga->image)
                <img
                    src="{{ asset('storage/' . $manga->image) }}"
                    alt="{{ $manga->titre }}"
                >
            @endif

            <h2>{{ $manga->titre }}</h2>

            <p>
                <strong>Auteur :</strong>
                {{ $manga->auteur }}
            </p>

            <p>
                <strong>Genre :</strong>
                {{ $manga->genre }}
            </p>

            <p>
                <strong>Nombre de tomes :</strong>
                {{ $manga->nombre_tomes }}
            </p>

            @if($manga->disponible)

                <p class="disponible">
                    Disponible
                </p>

<form action="{{ route('emprunts.store', $manga) }}" method="POST"> @csrf

<button type="submit" class="emprunter">
    Emprunter
</button>

</form>

            @else

                <p class="indisponible">
                    Indisponible
                </p>

            @endif

        </div>

    @empty

        <p>Aucun manga dans le catalogue.</p>

    @endforelse

</div>
```

</body>
</html>
