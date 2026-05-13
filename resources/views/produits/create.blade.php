<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Créer produit</title>
</head>

<body>

<h1>Créer un produit</h1>

<form method="POST" action="{{ route('produits.store') }}" enctype="multipart/form-data">
@csrf

<input type="text" name="nom" placeholder="Nom"><br><br>

<textarea name="description" placeholder="Description"></textarea><br><br>

<select name="categorie_id">
@foreach($categories as $cat)
<option value="{{ $cat->id }}">{{ $cat->nom }}</option>
@endforeach
</select><br><br>

<input type="number" name="prix_achat" placeholder="Prix achat"><br><br>
<input type="number" name="prix_vente" placeholder="Prix vente"><br><br>
<input type="number" name="stock" placeholder="Stock"><br><br>

<input type="file" name="photo"><br><br>

<button>Créer</button>

</form>

</body>
</html>