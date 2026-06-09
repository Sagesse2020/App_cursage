<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Liste produits</title>

<style>
body{
    font-family: Arial;
    background:#0f172a;
    color:white;
    padding:20px;
}

h1{
    color:#00e6ff;
}

.add{
    display:inline-block;
    padding:10px 15px;
    background:#00e6ff;
    color:black;
    border-radius:8px;
    text-decoration:none;
    font-weight:bold;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
    background:#111827;
    border-radius:10px;
    overflow:hidden;
}

th{
    background:#1f2937;
    padding:12px;
}

td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #1f2937;
}

img{
    width:60px;
    height:60px;
    object-fit:cover;
    border-radius:8px;
}

.btn{
    padding:6px 10px;
    border-radius:6px;
    text-decoration:none;
    font-size:13px;
}

.show{background:green;color:white;}
.edit{background:orange;color:white;}
.delete{background:red;color:white;}
</style>
</head>

<body>

<h1>📦 Liste des produits</h1>

<a href="{{ route('produits.create') }}" class="add">+ Ajouter produit</a>

<table>

<tr>
<th>Image</th>
<th>Nom</th>
<th>Catégorie</th>
<th>Prix</th>
<th>Stock</th>
<th>Actions</th>
</tr>

@foreach($produits as $produit)

<tr>

<td>
@if($produit->photo)
<img src="{{ asset('storage/'.$produit->photo) }}">
@else
<img src="https://via.placeholder.com/60">
@endif
</td>

<td>{{ $produit->nom }}</td>

<td>{{ $produit->categorie->nom ?? '' }}</td>

<td>{{ number_format($produit->prix_vente,0,',',' ') }} FCFA</td>

<td>{{ $produit->stock }}</td>

<td>
<a href="{{ route('produits.show',$produit->id) }}" class="btn show">Voir</a>

@if(auth()->id() === $produit->user_id || auth()->user()->niveau == 3)
<a href="{{ route('produits.edit',$produit->id) }}" class="btn edit">Modifier</a>

<form method="POST" action="{{ route('produits.destroy',$produit->id) }}" style="display:inline;">
@csrf
@method('DELETE')
<button class="btn delete">Supprimer</button>
</form>
@endif

</td>

</tr>

@endforeach

</table>

</body>
</html>