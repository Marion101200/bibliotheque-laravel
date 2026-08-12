<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestion des emprunts</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 30px;
        }

        h1 {
            margin-bottom: 30px;
        }

        .table-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            overflow-x: auto;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #222;
            color: white;
        }

        .en-cours {
            color: #c27a00;
            font-weight: bold;
        }

        .termine {
            color: #16803c;
            font-weight: bold;
        }

        .retour {
            display: inline-block;
            margin-top: 20px;
            color: #222;
            text-decoration: none;
        }

        .filtres {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
    align-items: center;
}

.filtres select,
.filtres button,
.filtres a {
    padding: 10px 15px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

.filtres button {
    background-color: #222;
    color: white;
    cursor: pointer;
}

.filtres a {
    background-color: #ddd;
    color: #222;
    text-decoration: none;
}
    </style>
</head>

<body>

    @include('components.navbar')

    <div class="container">

        <h1>📖 Gestion des emprunts</h1>
        <form method="GET" action="{{ route('admin.emprunts.index') }}" class="filtres">

    <select name="statut">

        <option value="">
            Tous les emprunts
        </option>

        <option
            value="en_cours"
            {{ request('statut') === 'en_cours' ? 'selected' : '' }}
        >
            Emprunts en cours
        </option>

        <option
            value="termine"
            {{ request('statut') === 'termine' ? 'selected' : '' }}
        >
            Emprunts terminés
        </option>

    </select>

    <button type="submit">
        Filtrer
    </button>

    <a href="{{ route('admin.emprunts.index') }}">
        Réinitialiser
    </a>

</form>

        @if($emprunts->isEmpty())

            <p>Aucun emprunt enregistré.</p>

        @else

            <div class="table-container">

                <table>

                    <thead>
                        <tr>
                            <th>Utilisateur</th>
                            <th>Manga</th>
                            <th>Date d'emprunt</th>
                            <th>Date de retour</th>
                            <th>Statut</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($emprunts as $emprunt)

                            <tr>

                                <td>
                                    {{ $emprunt->user->name }}
                                </td>

                                <td>
                                    {{ $emprunt->manga->titre }}
                                </td>

                                <td>
                                    {{ $emprunt->date_emprunt }}
                                </td>

                                <td>
                                    {{ $emprunt->date_retour ?? '-' }}
                                </td>

                                <td>

                                    @if($emprunt->date_retour)

                                        <span class="termine">
                                            Terminé
                                        </span>

                                    @else

                                        <span class="en-cours">
                                            En cours
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @endif

        <a href="{{ route('admin') }}" class="retour">
            ← Retour à l'administration
        </a>

    </div>

</body>

</html>