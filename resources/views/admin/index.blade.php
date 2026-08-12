<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Administration - MangaLib</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="min-h-screen bg-slate-100 text-slate-900">

    @include('components.navbar')


    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">


        {{-- En-tête --}}
        <div class="mb-10">

            <p class="text-sm font-semibold uppercase tracking-wider text-indigo-600">
                Administration
            </p>

            <h1 class="mt-2 text-4xl font-extrabold tracking-tight text-slate-900">
                Tableau de bord
            </h1>

            <p class="mt-3 text-slate-600">
                Bienvenue dans l'espace d'administration de MangaLib.
            </p>

        </div>


        {{-- Cartes --}}
        <div class="grid gap-6 md:grid-cols-2">


            {{-- Gestion des mangas --}}
            <a
                href="{{ route('admin.mangas.index') }}"
                class="group rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 transition duration-300 hover:-translate-y-1 hover:shadow-lg"
            >

                <div class="flex items-start justify-between">

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-100 text-2xl">
                        📚
                    </div>

                    <span class="text-slate-400 transition group-hover:translate-x-1 group-hover:text-indigo-600">
                        →
                    </span>

                </div>


                <h2 class="mt-5 text-xl font-bold text-slate-900">
                    Gestion des mangas
                </h2>

                <p class="mt-2 text-sm leading-6 text-slate-500">
                    Ajouter, modifier et supprimer les mangas du catalogue.
                </p>

            </a>


            {{-- Gestion des emprunts --}}
            <a
                href="{{ route('admin.emprunts.index') }}"
                class="group rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 transition duration-300 hover:-translate-y-1 hover:shadow-lg"
            >

                <div class="flex items-start justify-between">

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-100 text-2xl">
                        📖
                    </div>

                    <span class="text-slate-400 transition group-hover:translate-x-1 group-hover:text-purple-600">
                        →
                    </span>

                </div>


                <h2 class="mt-5 text-xl font-bold text-slate-900">
                    Gestion des emprunts
                </h2>

                <p class="mt-2 text-sm leading-6 text-slate-500">
                    Consulter les emprunts effectués par les utilisateurs.
                </p>

            </a>


        </div>


        {{-- Retour catalogue --}}
        <div class="mt-10">

            <a
                href="{{ route('mangas.index') }}"
                class="inline-flex items-center gap-2 rounded-xl bg-slate-800 px-5 py-3 font-semibold text-white transition hover:bg-slate-700"
            >
                ← Retour au catalogue
            </a>

        </div>


    </main>

</body>

</html>