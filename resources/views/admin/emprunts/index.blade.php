<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestion des emprunts - MangaLib</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="min-h-screen bg-slate-100 text-slate-900">

    @include('components.navbar')


    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">


        {{-- En-tête --}}
        <div class="mb-8">

            <a
                href="{{ route('admin') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 transition hover:text-indigo-600"
            >
                ← Retour à l'administration
            </a>

            <div class="mt-6">

                <p class="text-sm font-semibold uppercase tracking-wider text-indigo-600">
                    Administration
                </p>

                <h1 class="mt-1 text-3xl font-extrabold text-slate-900">
                    📖 Gestion des emprunts
                </h1>

                <p class="mt-2 text-slate-500">
                    Consultez les emprunts effectués par les utilisateurs.
                </p>

            </div>

        </div>


        {{-- Filtres --}}
        <form
            method="GET"
            action="{{ route('admin.emprunts.index') }}"
            class="mb-6 rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200"
        >

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">

                <div class="flex-1 sm:max-w-xs">

                    <label
                        for="statut"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Filtrer par statut
                    </label>

                    <select
                        name="statut"
                        id="statut"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                    >

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

                </div>


                <div class="flex gap-2 sm:mt-6">

                    <button
                        type="submit"
                        class="rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700"
                    >
                        Filtrer
                    </button>

                    <a
                        href="{{ route('admin.emprunts.index') }}"
                        class="rounded-xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                    >
                        Réinitialiser
                    </a>

                </div>

            </div>

        </form>


        {{-- Liste vide --}}
        @if($emprunts->isEmpty())

            <div class="rounded-2xl bg-white px-6 py-16 text-center shadow-sm ring-1 ring-slate-200">

                <div class="text-5xl">
                    📖
                </div>

                <h2 class="mt-4 text-xl font-bold text-slate-900">
                    Aucun emprunt
                </h2>

                <p class="mt-2 text-slate-500">
                    Aucun emprunt ne correspond aux critères sélectionnés.
                </p>

            </div>


        @else


            {{-- Tableau --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">

                <div class="overflow-x-auto">

                    <table class="w-full min-w-[750px] text-left">

                        <thead class="bg-slate-800 text-sm text-white">

                            <tr>

                                <th class="px-6 py-4 font-semibold">
                                    Utilisateur
                                </th>

                                <th class="px-6 py-4 font-semibold">
                                    Manga
                                </th>

                                <th class="px-6 py-4 font-semibold">
                                    Date d'emprunt
                                </th>

                                <th class="px-6 py-4 font-semibold">
                                    Date de retour
                                </th>

                                <th class="px-6 py-4 font-semibold">
                                    Statut
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-200">

                            @foreach($emprunts as $emprunt)

                                <tr class="transition hover:bg-slate-50">


                                    {{-- Utilisateur --}}
                                    <td class="px-6 py-5">

                                        <div class="flex items-center gap-3">

                                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 font-bold text-indigo-700">
                                                {{ strtoupper(substr($emprunt->user->name, 0, 1)) }}
                                            </div>

                                            <div>

                                                <p class="font-semibold text-slate-900">
                                                    {{ $emprunt->user->name }}
                                                </p>

                                                <p class="text-xs text-slate-400">
                                                    Utilisateur
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Manga --}}
                                    <td class="px-6 py-5">

                                        <span class="font-semibold text-slate-800">
                                            {{ $emprunt->manga->titre }}
                                        </span>

                                    </td>


                                    {{-- Date emprunt --}}
                                    <td class="whitespace-nowrap px-6 py-5 text-sm text-slate-600">

                                        {{ $emprunt->date_emprunt }}

                                    </td>


                                    {{-- Date retour --}}
                                    <td class="whitespace-nowrap px-6 py-5 text-sm text-slate-600">

                                        {{ $emprunt->date_retour ?? '-' }}

                                    </td>


                                    {{-- Statut --}}
                                    <td class="px-6 py-5">

                                        @if($emprunt->date_retour)

                                            <span class="inline-flex items-center gap-2 rounded-full bg-green-100 px-3 py-1.5 text-xs font-bold text-green-700">

                                                <span class="h-2 w-2 rounded-full bg-green-500"></span>

                                                Terminé

                                            </span>

                                        @else

                                            <span class="inline-flex items-center gap-2 rounded-full bg-amber-100 px-3 py-1.5 text-xs font-bold text-amber-700">

                                                <span class="h-2 w-2 rounded-full bg-amber-500"></span>

                                                En cours

                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        @endif


        {{-- Retour --}}
        <div class="mt-8">

            <a
                href="{{ route('admin') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 transition hover:text-indigo-600"
            >
                ← Retour au tableau de bord
            </a>

        </div>


    </main>

</body>

</html>