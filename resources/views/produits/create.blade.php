<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Créer produit</title>

<style>

body{
    margin:0;
    font-family:Arial;
    background:#0f172a;
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
}

.card{
    width:100%;
    max-width:650px;
    background:#fff;
    padding:25px;
    border-radius:12px;
}

h1{
    text-align:center;
    color:#0f172a;
}

label{
    display:block;
    margin-top:10px;
    font-weight:bold;
    color:#111;
}

input,textarea,select{
    width:100%;
    padding:10px;
    margin-top:5px;
    border-radius:8px;
    border:1px solid #ccc;
}

button{
    width:100%;
    margin-top:20px;
    padding:12px;
    background:#2563eb;
    color:#fff;
    border:none;
    border-radius:8px;
    cursor:pointer;
}

button:hover{
    background:#1d4ed8;
}

</style>

</head>

<body>

<div class="card">

<h1>Créer un produit</h1>

<form method="POST" action="{{ route('produits.store') }}" enctype="multipart/form-data">
@csrf

<label>Nom produit</label>
<input type="text" name="nom" placeholder="Ex: Berger Allemand">

<label>Description</label>
<textarea name="description" placeholder="Description du produit"></textarea>

<label>Catégorie</label>
<select name="categorie_id">
@foreach($categories as $cat)
<option value="{{ $cat->id }}">{{ $cat->nom }}</option>
@endforeach
</select>

<label>Prix achat</label>
<input type="number" name="prix_achat">

<label>Prix vente</label>
<input type="number" name="prix_vente">

<label>Stock</label>
<input type="number" name="stock">

<label>Photo</label>
<input type="file" name="photo">

<button>Créer produit</button>

</form>

</div>

</body>
</html>