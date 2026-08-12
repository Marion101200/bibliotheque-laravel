<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Modifier {{ $manga->titre }} - MangaLib</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="min-h-screen bg-slate-100 text-slate-900">

    @include('components.navbar')


    <main class="mx-auto max-w-4xl px-4 py-10 sm:px-6 lg:px-8">

        {{-- En-tête --}}
        <div class="mb-8">

            <a
                href="{{ route('admin.mangas.index') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 transition hover:text-indigo-600"
            >
                ← Retour à la gestion des mangas
            </a>

            <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-indigo-600">
                Administration
            </p>

            <h1 class="mt-1 text-3xl font-extrabold text-slate-900">
                Modifier le manga
            </h1>

            <p class="mt-2 text-slate-500">
                Modifiez les informations de
                <span class="font-semibold text-slate-700">
                    {{ $manga->titre }}
                </span>.
            </p>

        </div>


        {{-- Erreurs --}}
        @if($errors->any())

            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5">

                <div class="flex items-center gap-2 font-bold text-red-800">
                    ⚠️ Une erreur est survenue
                </div>

                <ul class="mt-3 list-inside list-disc space-y-1 text-sm text-red-700">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Formulaire --}}
        <form
            action="{{ route('admin.mangas.update', $manga) }}"
            method="POST"
            enctype="multipart/form-data"
            class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200 sm:p-8"
        >

            @csrf
            @method('PUT')


            <div class="space-y-6">


                {{-- Titre --}}
                <div>

                    <label
                        for="titre"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Titre
                    </label>

                    <input
                        type="text"
                        id="titre"
                        name="titre"
                        value="{{ old('titre', $manga->titre) }}"
                        required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                    >

                </div>


                {{-- Auteur --}}
                <div>

                    <label
                        for="auteur"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Auteur
                    </label>

                    <input
                        type="text"
                        id="auteur"
                        name="auteur"
                        value="{{ old('auteur', $manga->auteur) }}"
                        required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
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

                    <input
                        type="text"
                        id="genre"
                        name="genre"
                        value="{{ old('genre', $manga->genre) }}"
                        required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                    >

                </div>


                {{-- Description --}}
                <div>

                    <label
                        for="description"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="6"
                        class="w-full resize-y rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                    >{{ old('description', $manga->description) }}</textarea>

                </div>


                {{-- Tomes + disponibilité --}}
                <div class="grid gap-6 sm:grid-cols-2">


                    <div>

                        <label
                            for="nombre_tomes"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Nombre de tomes
                        </label>

                        <input
                            type="number"
                            id="nombre_tomes"
                            name="nombre_tomes"
                            min="1"
                            value="{{ old('nombre_tomes', $manga->nombre_tomes) }}"
                            required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                        >

                    </div>


                    <div>

                        <label
                            for="disponible"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Disponibilité
                        </label>

                        <select
                            name="disponible"
                            id="disponible"
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                        >

                            <option
                                value="1"
                                {{ $manga->disponible ? 'selected' : '' }}
                            >
                                Disponible
                            </option>

                            <option
                                value="0"
                                {{ !$manga->disponible ? 'selected' : '' }}
                            >
                                Indisponible
                            </option>

                        </select>

                    </div>

                </div>


                {{-- Image actuelle --}}
                @if($manga->image)

                    <div class="border-t border-slate-200 pt-6">

                        <p class="mb-3 text-sm font-semibold text-slate-700">
                            Image actuelle
                        </p>

                        <div class="flex items-center gap-5">

                            <img
                                src="{{ asset('storage/' . $manga->image) }}"
                                alt="{{ $manga->titre }}"
                                class="h-40 w-28 rounded-xl object-cover shadow-sm ring-1 ring-slate-200"
                            >

                            <div>

                                <p class="text-sm text-slate-500">
                                    Cette image sera conservée si vous n'en sélectionnez pas une nouvelle.
                                </p>

                            </div>

                        </div>

                    </div>

                @endif


                {{-- Nouvelle image --}}
                <div>

                    <label
                        for="image"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Nouvelle image
                    </label>

                    <div class="rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50 p-6 text-center transition hover:border-indigo-400">

                        <div class="mb-3 text-4xl">
                            🖼️
                        </div>

                        <p class="mb-3 text-sm text-slate-500">
                            Laissez vide pour conserver l'image actuelle.
                        </p>

                        <input
                            type="file"
                            id="image"
                            name="image"
                            accept="image/jpeg,image/png,image/jpg,image/webp"
                            class="mx-auto block w-full max-w-md text-sm text-slate-500 file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100"
                        >

                    </div>

                </div>


                {{-- Boutons --}}
                <div class="flex flex-col-reverse gap-3 border-t border-slate-200 pt-6 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('admin.mangas.index') }}"
                        class="rounded-xl border border-slate-300 px-5 py-3 text-center font-semibold text-slate-700 transition hover:bg-slate-50"
                    >
                        Annuler
                    </a>

                    <button
                        type="submit"
                        class="rounded-xl bg-indigo-600 px-6 py-3 font-bold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        ✓ Enregistrer les modifications
                    </button>

                </div>

            </div>

        </form>

    </main>

</body>

</html>