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


        {{-- Carte principale --}}
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


                    {{-- Informations --}}
                    <div class="mt-6 space-y-4">

                        <div class="flex items-center gap-3">

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


                        <div class="flex items-center gap-3">

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


                    {{-- Disponibilité --}}
                    <div class="mt-8 border-t border-slate-200 pt-6">

                        @if($manga->disponible)

                            <div class="flex items-center gap-2">

                                <span class="h-3 w-3 rounded-full bg-green-500"></span>

                                <span class="font-bold text-green-700">
                                    Disponible
                                </span>

                            </div>


                            @auth

                                <form
                                    action="{{ route('emprunts.store', $manga) }}"
                                    method="POST"
                                    class="mt-4"
                                >
                                    @csrf

                                    <button
                                        type="submit"
                                        class="w-full rounded-xl bg-indigo-600 px-6 py-4 font-bold text-white shadow-md transition hover:bg-indigo-700 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                    >
                                        📖 Emprunter ce manga
                                    </button>

                                </form>

                            @else

                                <div class="mt-4 rounded-xl border border-amber-200 bg-amber-50 p-4">

                                    <p class="text-sm text-amber-800">
                                        Connectez-vous pour pouvoir emprunter ce manga.
                                    </p>

                                    <a
                                        href="{{ route('login') }}"
                                        class="mt-3 inline-block font-semibold text-amber-900 underline hover:no-underline"
                                    >
                                        Se connecter →
                                    </a>

                                </div>

                            @endauth


                        @else

                            <div class="flex items-center gap-2">

                                <span class="h-3 w-3 rounded-full bg-red-500"></span>

                                <span class="font-bold text-red-700">
                                    Indisponible
                                </span>

                            </div>

                            <p class="mt-3 text-sm text-slate-500">
                                Ce manga est actuellement emprunté.
                            </p>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </main>

</body>
</html>