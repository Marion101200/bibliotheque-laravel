<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $manga->titre }} - MangaLib</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-900">

    @include('components.navbar')

    <main class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">

        {{-- Retour au catalogue --}}
        <a
            href="{{ route('mangas.index') }}"
            class="mb-6 inline-flex items-center gap-2 text-sm font-semibold text-slate-600 transition hover:text-indigo-600"
        >
            ← Retour au catalogue
        </a>


        {{-- Informations du manga --}}
        <div class="overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-slate-200">

            <div class="grid md:grid-cols-2">

                {{-- Image --}}
                <div class="bg-slate-200 p-6 sm:p-10">

                    @if($manga->image)

                        <div class="flex h-full items-center justify-center">

                            <img
                                src="{{ asset('storage/' . $manga->image) }}"
                                alt="{{ $manga->titre }}"
                                class="max-h-[600px] w-full rounded-2xl object-cover shadow-md"
                            >

                        </div>

                    @else

                        <div class="flex min-h-[450px] items-center justify-center rounded-2xl bg-slate-300 text-slate-500">

                            <div class="text-center">

                                <div class="mb-3 text-6xl">
                                    📖
                                </div>

                                <p class="font-medium">
                                    Aucune image disponible
                                </p>

                            </div>

                        </div>

                    @endif

                </div>


                {{-- Informations --}}
                <div class="flex flex-col p-6 sm:p-10">

                    {{-- Genre --}}
                    @if($manga->genre)

                        <div class="mb-4">

                            <span class="inline-flex rounded-full bg-indigo-100 px-3 py-1 text-sm font-semibold text-indigo-700">
                                {{ $manga->genre }}
                            </span>

                        </div>

                    @endif


                    {{-- Titre --}}
                    <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl">
                        {{ $manga->titre }}
                    </h1>


                    {{-- Auteur --}}
                    <div class="mt-6 flex items-center gap-3">

                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100">
                            ✍️
                        </span>

                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                Auteur
                            </p>

                            <p class="font-semibold text-slate-800">
                                {{ $manga->auteur }}
                            </p>

                        </div>

                    </div>


                    {{-- Nombre de tomes --}}
                    <div class="mt-4 flex items-center gap-3">

                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100">
                            📚
                        </span>

                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                Nombre de tomes
                            </p>

                            <p class="font-semibold text-slate-800">
                                {{ $manga->nombre_tomes }}
                            </p>

                        </div>

                    </div>


                    {{-- Description --}}
                    @if($manga->description)

                        <div class="mt-8 border-t border-slate-200 pt-6">

                            <h2 class="text-xl font-bold text-slate-900">
                                Description
                            </h2>

                            <p class="mt-3 leading-7 text-slate-600">
                                {{ $manga->description }}
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- ============================= --}}
        {{-- TOMES --}}
        {{-- ============================= --}}

        <section class="mt-8">

            <div class="mb-5">

                <h2 class="text-2xl font-extrabold text-slate-900">
                    📚 Les tomes
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Choisissez le tome que vous souhaitez emprunter.
                </p>

            </div>


            @if($manga->tomes->isEmpty())

                <div class="rounded-2xl bg-white p-8 text-center shadow-sm ring-1 ring-slate-200">

                    <div class="text-4xl">
                        📖
                    </div>

                    <p class="mt-3 font-semibold text-slate-700">
                        Aucun tome disponible pour ce manga.
                    </p>

                </div>

            @else

                {{-- Grille des tomes --}}
                <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">

                    @foreach($manga->tomes as $tome)

                        <div
                            class="flex flex-col rounded-2xl bg-white p-4 shadow-sm ring-1 ring-slate-200 transition hover:-translate-y-1 hover:shadow-md"
                        >

                            {{-- Numéro --}}
                            <div class="flex items-center justify-between">

                                <span class="text-lg font-extrabold text-slate-900">
                                    Tome {{ $tome->numero }}
                                </span>

                            </div>


                            {{-- Titre du tome --}}
                            @if($tome->titre)

                                <p class="mt-2 line-clamp-2 min-h-[40px] text-sm text-slate-500">
                                    {{ $tome->titre }}
                                </p>

                            @else

                                <p class="mt-2 min-h-[40px] text-sm text-slate-400">
                                    Aucun titre
                                </p>

                            @endif


                            {{-- Statut --}}
                            <div class="mt-4">

                                @if($tome->disponible)

                                    <span
                                        class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700"
                                    >
                                        ● Disponible
                                    </span>

                                @else

                                    <span
                                        class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700"
                                    >
                                        ● Emprunté
                                    </span>

                                @endif

                            </div>


                            {{-- Bouton --}}
                            @if($tome->disponible)

                                @auth

                                    <form
                                        action="{{ route('emprunts.store', $tome) }}"
                                        method="POST"
                                        class="mt-4"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="w-full rounded-xl bg-indigo-600 px-3 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700"
                                        >
                                            Emprunter
                                        </button>

                                    </form>

                                @else

                                    <a
                                        href="{{ route('login') }}"
                                        class="mt-4 block rounded-xl bg-slate-100 px-3 py-2.5 text-center text-sm font-semibold text-slate-700 transition hover:bg-slate-200"
                                    >
                                        Se connecter
                                    </a>

                                @endauth

                            @else

                                <div
                                    class="mt-4 rounded-xl bg-slate-100 px-3 py-2.5 text-center text-sm font-semibold text-slate-400"
                                >
                                    Indisponible
                                </div>

                            @endif

                        </div>

                    @endforeach

                </div>

            @endif

        </section>

    </main>

</body>
</html>