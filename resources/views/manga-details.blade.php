<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $manga->titre }}</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
        }

        .manga-detail {
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 40px;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .manga-image {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 8px;
        }

        .no-image {
            height: 450px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ddd;
            color: #777;
            border-radius: 8px;
        }

        h1 {
            margin-top: 0;
        }

        .info {
            margin: 15px 0;
            color: #555;
        }

        .description {
            line-height: 1.6;
            margin-top: 25px;
        }

        .disponible {
            color: #16803c;
            font-weight: bold;
            margin-top: 25px;
        }

        .indisponible {
            color: #c62828;
            font-weight: bold;
            margin-top: 25px;
        }

        .emprunter {
            margin-top: 15px;
            padding: 12px 20px;
            background-color: #222;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .emprunter:hover {
            background-color: #444;
        }

        .retour {
            display: inline-block;
            margin-top: 25px;
            color: #222;
            text-decoration: none;
        }

        @media (max-width: 700px) {
            .manga-detail {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    @include('components.navbar')

    <div class="container">

        <div class="manga-detail">

            <div>
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
            </div>

            <div>

                <h1>{{ $manga->titre }}</h1>

                <p class="info">
                    <strong>Auteur :</strong>
                    {{ $manga->auteur }}
                </p>

                <p class="info">
                    <strong>Genre :</strong>
                    {{ $manga->genre }}
                </p>

                <p class="info">
                    <strong>Nombre de tomes :</strong>
                    {{ $manga->nombre_tomes }}
                </p>

                @if($manga->description)

                    <div class="description">
                        <h2>Description</h2>

                        <p>
                            {{ $manga->description }}
                        </p>
                    </div>

                @endif

                @if($manga->disponible)

                    <p class="disponible">
                        ● Disponible
                    </p>

                    @auth
                        <form
                            action="{{ route('emprunts.store', $manga) }}"
                            method="POST"
                        >
                            @csrf

                            <button type="submit" class="emprunter">
                                Emprunter ce manga
                            </button>
                        </form>
                    @else
                        <p>
                            Connectez-vous pour emprunter ce manga.
                        </p>
                    @endauth

                @else

                    <p class="indisponible">
                        ● Indisponible
                    </p>

                @endif

                <a href="{{ route('mangas.index') }}" class="retour">
                    ← Retour au catalogue
                </a>

            </div>

        </div>

    </div>

</body>
</html>