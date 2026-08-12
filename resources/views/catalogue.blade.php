<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Catalogue des mangas</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-900">

    @include('components.navbar')

    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">

        {{-- En-tête --}}
        <div class="mb-10 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl">
                📚 Catalogue des mangas
            </h1>

            <p class="mt-3 text-lg text-slate-600">
                Trouve ton prochain manga à lire
            </p>
        </div>


        {{-- Filtres --}}
        <form
            method="GET"
            action="{{ route('mangas.index') }}"
            class="mb-10 rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200"
        >

            <div class="grid gap-4 md:grid-cols-4">

                {{-- Recherche --}}
                <div class="md:col-span-2">
                    <label
                        for="recherche"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Rechercher
                    </label>

                    <input
                        id="recherche"
                        type="text"
                        name="recherche"
                        placeholder="Titre ou auteur..."
                        value="{{ request('recherche') }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                    >
                </div>


                {{-- Genre --}}
                <div>
                    <label
                        for="genre"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Genre
                    </label>

                    <select
                        id="genre"
                        name="genre"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                    >
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
                </div>


                {{-- Disponibilité --}}
                <div>
                    <label
                        for="disponibilite"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Disponibilité
                    </label>

                    <select
                        id="disponibilite"
                        name="disponibilite"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                    >
                        <option value="">Toutes</option>

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
                </div>

            </div>


            {{-- Boutons --}}
            <div class="mt-5 flex flex-wrap gap-3">

                <button
                    type="submit"
                    class="rounded-xl bg-indigo-600 px-6 py-3 font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    🔎 Rechercher
                </button>

                <a
                    href="{{ route('mangas.index') }}"
                    class="rounded-xl bg-slate-200 px-6 py-3 font-semibold text-slate-700 transition hover:bg-slate-300"
                >
                    Réinitialiser
                </a>

            </div>

        </form>


        {{-- Message succès --}}
        @if(session('success'))

            <div class="mb-8 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-green-800 shadow-sm">
                <span class="font-semibold">✓</span>
                {{ session('success') }}
            </div>

        @endif


        {{-- Message erreur --}}
        @if(session('error'))

            <div class="mb-8 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-red-800 shadow-sm">
                <span class="font-semibold">⚠</span>
                {{ session('error') }}
            </div>

        @endif


        {{-- Aucun manga --}}
        @if($mangas->isEmpty())

            <div class="rounded-2xl bg-white px-6 py-16 text-center shadow-sm ring-1 ring-slate-200">

                <div class="mb-4 text-5xl">
                    📚
                </div>

                <h2 class="text-2xl font-bold text-slate-900">
                    Aucun manga disponible
                </h2>

                <p class="mt-2 text-slate-500">
                    Le catalogue est actuellement vide.
                </p>

            </div>

        @else

            {{-- Nombre de résultats --}}
            <div class="mb-5 flex items-center justify-between">

                <p class="text-sm text-slate-500">
                    {{ $mangas->count() }}
                    {{ $mangas->count() > 1 ? 'mangas trouvés' : 'manga trouvé' }}
                </p>

            </div>


            {{-- Catalogue --}}
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

                @foreach($mangas as $manga)

                    <article
                        class="group overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 transition duration-300 hover:-translate-y-1 hover:shadow-xl"
                    >

                        {{-- Image --}}
                        <a href="{{ route('mangas.show', $manga) }}">

                            @if($manga->image)

                                <div class="relative overflow-hidden">

                                    <img
                                        src="{{ asset('storage/' . $manga->image) }}"
                                        alt="{{ $manga->titre }}"
                                        class="h-80 w-full object-cover transition duration-500 group-hover:scale-105"
                                    >

                                </div>

                            @else

                                <div class="flex h-80 items-center justify-center bg-slate-200 text-slate-500">
                                    <div class="text-center">
                                        <div class="mb-2 text-4xl">
                                            📖
                                        </div>

                                        <p>
                                            Aucune image
                                        </p>
                                    </div>
                                </div>

                            @endif

                        </a>


                        {{-- Informations --}}
                        <div class="p-5">

                            <a href="{{ route('mangas.show', $manga) }}">

                                <h2 class="line-clamp-2 text-xl font-bold text-slate-900 transition group-hover:text-indigo-600">
                                    {{ $manga->titre }}
                                </h2>

                            </a>


                            <div class="mt-4 space-y-2 text-sm text-slate-600">

                                <p>
                                    <span class="font-semibold text-slate-800">
                                        Auteur :
                                    </span>

                                    {{ $manga->auteur }}
                                </p>

                                <p>
                                    <span class="font-semibold text-slate-800">
                                        Genre :
                                    </span>

                                    {{ $manga->genre }}
                                </p>

                                <p>
                                    <span class="font-semibold text-slate-800">
                                        Tomes :
                                    </span>

                                    {{ $manga->nombre_tomes }}
                                </p>

                            </div>


                            {{-- Disponibilité --}}
                            <div class="mt-4">

                                @if($manga->disponible)

                                    <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-sm font-semibold text-green-700">
                                        <span class="mr-2 h-2 w-2 rounded-full bg-green-500"></span>
                                        Disponible
                                    </span>

                                @else

                                    <span class="inline-flex items-center rounded-full bg-red-100 px-3 py-1 text-sm font-semibold text-red-700">
                                        <span class="mr-2 h-2 w-2 rounded-full bg-red-500"></span>
                                        Indisponible
                                    </span>

                                @endif

                            </div>


                            {{-- Actions --}}
                            <div class="mt-5">

                                <a
                                    href="{{ route('mangas.show', $manga) }}"
                                    class="block w-full rounded-xl border border-slate-300 px-4 py-3 text-center font-semibold text-slate-700 transition hover:bg-slate-100"
                                >
                                    Voir le manga
                                </a>


                                @if($manga->disponible)

                                    <form
                                        action="{{ route('emprunts.store', $manga) }}"
                                        method="POST"
                                        class="mt-2"
                                    >
                                        @csrf

                                        <button
                                            type="submit"
                                            class="w-full rounded-xl bg-indigo-600 px-4 py-3 font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                        >
                                            📖 Emprunter
                                        </button>

                                    </form>

                                @endif

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>

        @endif

    </main>

</body>
</html>