<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Détail produit</title>
</head>

<body>

<h1>Détail produit</h1>

<p><strong>Nom :</strong> {{ $produit->nom }}</p>

<p><strong>Description :</strong> {{ $produit->description }}</p>

<p><strong>Catégorie :</strong> {{ $produit->categorie->nom }}</p>

<p><strong>Prix achat :</strong> {{ $produit->prix_achat }}</p>

<p><strong>Prix vente :</strong> {{ $produit->prix_vente }}</p>

<p><strong>Stock :</strong> {{ $produit->stock }}</p>

<p><strong>Unité :</strong> {{ $produit->unite }}</p>

@if($produit->photo)
<p>
<img src="{{ asset('storage/'.$produit->photo) }}" width="200">
</p>
@endif

<p><strong>Créé par :</strong> {{ $produit->user->name ?? 'Admin' }}</p>

<br>

<a href="{{ route('produits.index') }}">Retour</a>

</body>
</html>