<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier produit</title>

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
}

img{
    width:100%;
    border-radius:10px;
    margin-bottom:10px;
}
</style>
</head>

<body>

<div class="form">

<h1>Modifier produit</h1>

@if($produit->photo)
<img src="{{ asset('storage/'.$produit->photo) }}">
@endif

<form method="POST" enctype="multipart/form-data" action="{{ route('produits.update',$produit->id) }}">
@csrf
@method('PUT')

<select name="partenaire_id">
@foreach($partenaires as $partenaire)
<option value="{{ $partenaire->id }}" @selected($partenaire->id==$produit->partenaire_id)>
{{ $partenaire->nom }} {{ $partenaire->type_partenaire }}
</option>
@endforeach
</select>

<input type="text" name="nom" value="{{ $produit->nom }}">

<textarea name="description">{{ $produit->description }}</textarea>

<select name="categorie_id">
@foreach($categories as $cat)
<option value="{{ $cat->id }}" @selected($cat->id==$produit->categorie_id)>
{{ $cat->nom }}
</option>
@endforeach
</select>

<input type="number" name="prix_achat" value="{{ $produit->prix_achat }}">
<input type="number" name="prix_vente" value="{{ $produit->prix_vente }}">
<input type="number" name="stock" value="{{ $produit->stock }}">

<input type="file" name="photo">

<button>Modifier</button>

</form>

</div>

</body>
</html>