<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestion des mangas - MangaLib</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-900">

    @include('components.navbar')

    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">

        {{-- En-tête --}}
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <p class="text-sm font-semibold uppercase tracking-wider text-indigo-600">
                    Administration
                </p>

                <h1 class="mt-1 text-3xl font-extrabold text-slate-900">
                    Gestion des mangas
                </h1>

                <p class="mt-2 text-slate-500">
                    Gérez le catalogue de MangaLib.
                </p>

            </div>


            <a
                href="{{ route('admin.mangas.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 font-semibold text-white shadow-sm transition hover:bg-indigo-700"
            >
                + Ajouter un manga
            </a>

        </div>


        {{-- Message succès --}}
        @if(session('success'))

            <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-green-800">
                <span class="font-bold">✓</span>
                {{ session('success') }}
            </div>

        @endif


        {{-- Liste --}}
        @if($mangas->isEmpty())

            <div class="rounded-2xl bg-white px-6 py-16 text-center shadow-sm ring-1 ring-slate-200">

                <div class="text-5xl">
                    📚
                </div>

                <h2 class="mt-4 text-xl font-bold">
                    Aucun manga
                </h2>

                <p class="mt-2 text-slate-500">
                    Commencez par ajouter un manga au catalogue.
                </p>

                <a
                    href="{{ route('admin.mangas.create') }}"
                    class="mt-6 inline-block rounded-xl bg-indigo-600 px-5 py-3 font-semibold text-white hover:bg-indigo-700"
                >
                    Ajouter un manga
                </a>

            </div>

        @else

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

                @foreach($mangas as $manga)

                    <article class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 transition hover:-translate-y-1 hover:shadow-lg">

                        {{-- Image --}}
                        @if($manga->image)

                            <img
                                src="{{ asset('storage/' . $manga->image) }}"
                                alt="{{ $manga->titre }}"
                                class="h-72 w-full object-cover"
                            >

                        @else

                            <div class="flex h-72 items-center justify-center bg-slate-200 text-slate-500">

                                <div class="text-center">

                                    <div class="text-5xl">
                                        📖
                                    </div>

                                    <p class="mt-2 text-sm">
                                        Aucune image
                                    </p>

                                </div>

                            </div>

                        @endif


                        {{-- Informations --}}
                        <div class="p-5">

                            <h2 class="line-clamp-2 text-xl font-bold text-slate-900">
                                {{ $manga->titre }}
                            </h2>

                            <div class="mt-4 space-y-2 text-sm text-slate-600">

                                <p>
                                    <strong class="text-slate-800">
                                        Auteur :
                                    </strong>

                                    {{ $manga->auteur }}
                                </p>

                                <p>
                                    <strong class="text-slate-800">
                                        Genre :
                                    </strong>

                                    {{ $manga->genre }}
                                </p>

                                <p>
                                    <strong class="text-slate-800">
                                        Tomes :
                                    </strong>

                                    {{ $manga->nombre_tomes }}
                                </p>

                            </div>


                            {{-- Disponibilité --}}
                            <div class="mt-4">

                                @if($manga->disponible)

                                    <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        <span class="mr-2 h-2 w-2 rounded-full bg-green-500"></span>
                                        Disponible
                                    </span>

                                @else

                                    <span class="inline-flex items-center rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        <span class="mr-2 h-2 w-2 rounded-full bg-red-500"></span>
                                        Indisponible
                                    </span>

                                @endif

                            </div>


                            {{-- Actions --}}
                            <div class="mt-5 grid grid-cols-2 gap-2">

                                <a
                                    href="{{ route('admin.mangas.edit', $manga) }}"
                                    class="rounded-xl bg-indigo-50 px-3 py-2.5 text-center text-sm font-semibold text-indigo-700 transition hover:bg-indigo-100"
                                >
                                    ✏️ Modifier
                                </a>


                                <form
                                    action="{{ route('admin.mangas.destroy', $manga) }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer le manga « {{ addslashes($manga->titre) }} » ?')"
                                        class="w-full rounded-xl bg-red-50 px-3 py-2.5 text-sm font-semibold text-red-700 transition hover:bg-red-100"
                                    >
                                        🗑️ Supprimer
                                    </button>

                                </form>

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>

        @endif


        {{-- Retour --}}
        <div class="mt-10">

            <a
                href="{{ route('admin') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 transition hover:text-indigo-600"
            >
                ← Retour à l'administration
            </a>

        </div>

    </main>

</body>

</html>