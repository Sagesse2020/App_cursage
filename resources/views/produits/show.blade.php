<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Détail produit</title>

<style>
body{
    font-family: Arial;
    background:#0f172a;
    color:white;
    padding:20px;
}

.container{
    max-width:600px;
    margin:auto;
    background:#111827;
    padding:20px;
    border-radius:12px;
}

img{
    width:100%;
    max-height:300px;
    object-fit:contain;
    border-radius:12px;
}

.back{
    display:inline-block;
    margin-top:15px;
    color:#00e6ff;
    text-decoration:none;
}
</style>
</head>

<body>

<div class="container">

<h1>{{ $produit->nom }}</h1>
@if($produit->photo)
<img src="{{ asset('storage/'.$produit->photo) }}">
@endif
<p><strong>Partenaire :</strong> {{ $produit->partenaire->nom ?? '' }}</p>
<p><strong>Description :</strong> {{ $produit->description }}</p>

<p><strong>Catégorie :</strong> {{ $produit->categorie->nom ?? '' }}</p>

<p><strong>Prix achat :</strong> {{ $produit->prix_achat }}</p>

<p><strong>Prix vente :</strong> {{ $produit->prix_vente }}</p>

<p><strong>Stock :</strong> {{ $produit->stock }}</p>

<p><strong>Unité :</strong> {{ $produit->unite }}</p>

<p><strong>Créé par :</strong> {{ $produit->user->name ?? '' }}</p>

<a href="{{ route('produits.index') }}" class="back">← Retour</a>

</div>

</body>
</html>