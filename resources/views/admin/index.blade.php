<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Administration</title>

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
            max-width: 1200px;
            margin: auto;
            padding: 30px;
        }

        h1 {
            margin-bottom: 10px;
        }

        .intro {
            color: #666;
            margin-bottom: 30px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 35px;
        }

        .stat {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .stat-icon {
            font-size: 35px;
        }

        .stat-number {
            font-size: 30px;
            font-weight: bold;
            margin: 10px 0;
        }

        .stat-name {
            color: #666;
        }

        .actions {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .action {
            display: inline-block;
            padding: 12px 20px;
            background-color: #222;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .action:hover {
            background-color: #444;
        }

        @media (max-width: 800px) {
            .stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 500px) {
            .stats {
                grid-template-columns: 1fr;
            }
        }

    </style>

</head>

<body>

    @include('components.navbar')

    <div class="container">

        <h1>👑 Administration</h1>

        <p class="intro">
            Bienvenue dans votre espace d'administration.
        </p>

        <div class="stats">

            <div class="stat">

                <div class="stat-icon">
                    📚
                </div>

                <div class="stat-number">
                    {{ $nombreMangas }}
                </div>

                <div class="stat-name">
                    Mangas
                </div>

            </div>

            <div class="stat">

                <div class="stat-icon">
                    👤
                </div>

                <div class="stat-number">
                    {{ $nombreUtilisateurs }}
                </div>

                <div class="stat-name">
                    Utilisateurs
                </div>

            </div>

            <div class="stat">

                <div class="stat-icon">
                    📖
                </div>

                <div class="stat-number">
                    {{ $empruntsEnCours }}
                </div>

                <div class="stat-name">
                    Emprunts en cours
                </div>

            </div>

            <div class="stat">

                <div class="stat-icon">
                    ↩️
                </div>

                <div class="stat-number">
                    {{ $empruntsTermines }}
                </div>

                <div class="stat-name">
                    Emprunts terminés
                </div>

            </div>

        </div>

        <div class="actions">

            <a
                href="{{ route('admin.mangas.index') }}"
                class="action"
            >
                📚 Gérer les mangas
            </a>

            <a
    href="{{ route('admin.emprunts.index') }}"
    class="action"
>
    📖 Gérer les emprunts
</a>

            <a
                href="{{ route('mangas.index') }}"
                class="action"
            >
                👀 Voir le catalogue
            </a>

        </div>

    </div>

</body>

</html>