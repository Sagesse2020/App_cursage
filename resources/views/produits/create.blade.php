<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Créer produit</title>

<style>
body{
    font-family: Arial;
    background:#0f172a;
    color:white;
    padding:20px;
}

.form{
    max-width:500px;
    margin:auto;
    background:#111827;
    padding:20px;
    border-radius:12px;
}

input, select, textarea{
    width:100%;
    padding:10px;
    margin-bottom:10px;
    border-radius:8px;
    border:none;
}

button{
    background:#00e6ff;
    border:none;
    padding:10px;
    width:100%;
    font-weight:bold;
    border-radius:8px;
}
</style>
</head>

<body>

<div class="form">

<h1>Créer produit</h1>

<form method="POST" enctype="multipart/form-data" action="{{ route('produits.store') }}">
@csrf
<label>Partenaire propriétaire</label>

<select name="partenaire_id">

    <option value="">
        Produit Cursage
    </option>

    @foreach($partenaires as $partenaire)

        <option value="{{ $partenaire->id }}">

            {{ $partenaire->nom }}

        </option>

    @endforeach

</select>
<input type="text" name="nom" placeholder="Nom">

<textarea name="description" placeholder="Description"></textarea>

<select name="categorie_id">
@foreach($categories as $cat)
<option value="{{ $cat->id }}">{{ $cat->nom }}</option>
@endforeach
</select>

<input type="number" name="prix_achat" placeholder="Prix achat">
<input type="number" name="prix_vente" placeholder="Prix vente">
<input type="number" name="stock" placeholder="Stock">

<input type="file" name="photo">

<button>Enregistrer</button>

</form>

</div>

</body>
</html>