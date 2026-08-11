<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un manga</title>
</head>

<body>

    <h1>Ajouter un manga</h1>

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
        action="{{ route('admin.mangas.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        <div>
            <label for="titre">Titre :</label>
            <input
                type="text"
                id="titre"
                name="titre"
                value="{{ old('titre') }}"
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
                value="{{ old('auteur') }}"
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
                value="{{ old('genre') }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="description">Description :</label>
            <textarea
                id="description"
                name="description"
            >{{ old('description') }}</textarea>
        </div>

        <br>

        <div>
            <label for="nombre_tomes">Nombre de tomes :</label>
            <input
                type="number"
                id="nombre_tomes"
                name="nombre_tomes"
                min="1"
                value="{{ old('nombre_tomes', 1) }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="image">Image :</label>
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
                <option value="1">Disponible</option>
                <option value="0">Indisponible</option>
            </select>
        </div>

        <br>

        <button type="submit">
            Ajouter le manga
        </button>

    </form>

    <br>

    <a href="{{ route('admin.mangas.index') }}">
        Retour au catalogue
    </a>

</body>
</html>