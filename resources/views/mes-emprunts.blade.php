<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mes emprunts</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100 text-gray-900">

    @include('components.navbar')

    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">

        {{-- Titre --}}
        <div class="mb-8">

            <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                📚 Mes emprunts
            </h1>

            <p class="mt-2 text-gray-500">
                Retrouvez ici les mangas et tomes que vous avez actuellement empruntés.
            </p>

        </div>


        {{-- Message de succès --}}
        @if(session('success'))

            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-700">
                {{ session('success') }}
            </div>

        @endif


        {{-- Message d'erreur --}}
        @if(session('error'))

            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-700">
                {{ session('error') }}
            </div>

        @endif


        {{-- Aucun emprunt --}}
        @if($emprunts->isEmpty())

            <div class="rounded-xl bg-white p-10 text-center shadow-sm">

                <div class="mb-4 text-5xl">
                    📚
                </div>

                <h2 class="text-xl font-semibold text-gray-900">
                    Aucun emprunt
                </h2>

                <p class="mt-2 text-gray-500">
                    Vous n'avez actuellement aucun tome emprunté.
                </p>

                <a
                    href="{{ route('mangas.index') }}"
                    class="mt-6 inline-block rounded-lg bg-gray-900 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-gray-700"
                >
                    Voir le catalogue
                </a>

            </div>

        @else

            {{-- Liste des emprunts --}}
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

                @foreach($emprunts as $emprunt)

                    <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-200 transition duration-200 hover:-translate-y-1 hover:shadow-lg">

                        {{-- Image --}}
                        @if($emprunt->manga->image)

                            <img
                                src="{{ asset('storage/' . $emprunt->manga->image) }}"
                                alt="{{ $emprunt->manga->titre }}"
                                class="h-72 w-full object-cover"
                            >

                        @else

                            <div class="flex h-72 items-center justify-center bg-gray-200 text-gray-500">
                                Aucune image
                            </div>

                        @endif


                        {{-- Informations --}}
                        <div class="p-5">

                            <h2 class="text-xl font-bold text-gray-900">
                                {{ $emprunt->manga->titre }}
                            </h2>


                            {{-- Tome --}}
                            @if($emprunt->tome)

                                <span class="mt-2 inline-block rounded-full bg-gray-100 px-3 py-1 text-sm font-semibold text-gray-700">
                                    Tome {{ $emprunt->tome->numero }}
                                </span>

                            @endif


                            <div class="mt-4 space-y-2 text-sm text-gray-600">

                                <p>
                                    <span class="font-semibold text-gray-900">
                                        Auteur :
                                    </span>

                                    {{ $emprunt->manga->auteur }}
                                </p>

                                <p>
                                    <span class="font-semibold text-gray-900">
                                        Emprunté le :
                                    </span>

                                    {{ $emprunt->date_emprunt }}
                                </p>

                            </div>


                            {{-- Bouton retour --}}
                            <form
                                action="{{ route('emprunts.destroy', $emprunt) }}"
                                method="POST"
                                class="mt-5"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="w-full rounded-lg bg-gray-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2"
                                >
                                    Rendre le tome
                                </button>

                            </form>

                        </div>

                    </div>

                @endforeach

            </div>

        @endif

    </main>

</body>

</html>