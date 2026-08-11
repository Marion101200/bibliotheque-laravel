<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un manga</title>
</head>

<body>

    <h1>Modifier {{ $manga->titre }}</h1>

    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('admin.mangas.update', $manga) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')

        <div>
            <label for="titre">Titre :</label>
            <input
                type="text"
                id="titre"
                name="titre"
                value="{{ old('titre', $manga->titre) }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="auteur">Auteur :</label>
            <input
                type="text"
                id="auteur"
                name="auteur"
                value="{{ old('auteur', $manga->auteur) }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="genre">Genre :</label>
            <input
                type="text"
                id="genre"
                name="genre"
                value="{{ old('genre', $manga->genre) }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="description">Description :</label>
            <textarea
                id="description"
                name="description"
            >{{ old('description', $manga->description) }}</textarea>
        </div>

        <br>

        <div>
            <label for="nombre_tomes">Nombre de tomes :</label>
            <input
                type="number"
                id="nombre_tomes"
                name="nombre_tomes"
                min="1"
                value="{{ old('nombre_tomes', $manga->nombre_tomes) }}"
                required
            >
        </div>

        <br>

        @if($manga->image)
            <div>
                <p>Image actuelle :</p>

                <img
                    src="{{ asset('storage/' . $manga->image) }}"
                    alt="{{ $manga->titre }}"
                    width="150"
                >
            </div>

            <br>
        @endif

        <div>
            <label for="image">Nouvelle image :</label>
            <input
                type="file"
                id="image"
                name="image"
                accept="image/jpeg,image/png,image/jpg,image/webp"
            >
        </div>

        <br>

        <div>
            <label for="disponible">Disponibilité :</label>

            <select name="disponible" id="disponible">
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

        <br>

        <button type="submit">
            Enregistrer les modifications
        </button>

    </form>

    <br>

    <a href="{{ route('admin.mangas.index') }}">
        Retour au catalogue
    </a>

</body>
</html>