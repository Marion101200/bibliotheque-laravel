<!DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

```
<title>Mes emprunts</title>

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

    .emprunts {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 25px;
    }

    .emprunt {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .emprunt img {
        display: block;
        width: 150px;
        height: 220px;
        object-fit: cover;
        margin: 0 auto 15px;
        border-radius: 5px;
    }

    .emprunt h2 {
        font-size: 20px;
    }

    .retour {
        margin-top: 15px;
    }

    .retour button {
        padding: 10px 15px;
        background-color: #333;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .retour button:hover {
        background-color: #555;
    }
</style>
```

</head>

<body>
    @include('components.navbar')


<h1>📚 Mes emprunts</h1>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

@if($emprunts->isEmpty())

    <p>Vous n'avez aucun manga actuellement emprunté.</p>

@else

    <div class="emprunts">

        @foreach($emprunts as $emprunt)

            <div class="emprunt">

                @if($emprunt->manga->image)
                    <img
                        src="{{ asset('storage/' . $emprunt->manga->image) }}"
                        alt="{{ $emprunt->manga->titre }}"
                    >
                @endif

                <h2>{{ $emprunt->manga->titre }}</h2>

                <p>
                    <strong>Auteur :</strong>
                    {{ $emprunt->manga->auteur }}
                </p>

                <p>
                    <strong>Emprunté le :</strong>
                    {{ $emprunt->date_emprunt }}
                </p>

<form action="{{ route('emprunts.destroy', $emprunt) }}" method="POST" class="retour" > @csrf @method('DELETE')

<button type="submit">
    Rendre le manga
</button>

</form>

            </div>

        @endforeach

    </div>

@endif


</body>
</html>
