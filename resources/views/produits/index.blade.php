<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Liste produits</title>

<style>
table{
    width:100%;
    border-collapse: collapse;
}

th, td{
    border:1px solid #ccc;
    padding:10px;
    text-align:center;
}

th{
    background:#f2f2f2;
}

a{
    text-decoration:none;
    margin:0 5px;
}

.btn{
    padding:6px 10px;
    border-radius:5px;
}

.show{background:green;color:white;}
.edit{background:orange;color:white;}
.delete{background:red;color:white;}
.add{background:blue;color:white;padding:8px 12px;}
</style>

</head>

<body>

<h1>Liste des produits</h1>

<a href="{{ route('produits.create') }}" class="add">+ Ajouter produit</a>

<br><br>

<table>

<tr>
<th>Nom</th>
<th>Catégorie</th>
<th>Prix vente</th>
<th>Stock</th>
<th>Actions</th>
</tr>

@foreach($produits as $produit)

<tr>

<td>{{ $produit->nom }}</td>

<td>{{ $produit->categorie->nom ?? '' }}</td>

<td>{{ $produit->prix_vente }}</td>

<td>{{ $produit->stock }}</td>

<td>

<a href="{{ route('produits.show',$produit->id) }}" class="btn show">Voir</a>

<a href="{{ route('produits.edit',$produit->id) }}" class="btn edit">Modifier</a>

<form method="POST" action="{{ route('produits.destroy',$produit->id) }}" style="display:inline;">
@csrf
@method('DELETE')
<button class="btn delete">Supprimer</button>
</form>

</td>

</tr>

@endforeach

</table>

</body>
</html>