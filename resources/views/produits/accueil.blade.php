<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Produits - CURSAGE</title>

<style>

body{
margin:0;
font-family:Segoe UI;
background:linear-gradient(135deg,#0f172a,#020617);
color:white;
}

.header{
padding:80px 20px;
text-align:center;
}

.header h1{
font-size:42px;
color:#00e6ff;
}

.container{
max-width:1100px;
margin:auto;
padding:20px;
}

.grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
gap:20px;
}

.card{
background:#111827;
padding:20px;
border-radius:18px;
transition:.3s;
}

.card:hover{
transform:translateY(-8px);
box-shadow:0 10px 30px rgba(0,230,255,.15);
}

img{
width:100%;
height:180px;
object-fit:cover;
border-radius:12px;
}

.btn{
display:inline-block;
padding:8px 12px;
margin-top:10px;
border-radius:10px;
text-decoration:none;
background:#00e6ff;
color:black;
font-weight:bold;
}

.small{
color:#94a3b8;
font-size:13px;
}

</style>
</head>

<body>

<div class="header">
<h1>Gestion des Produits</h1>
</div>

<div class="container">

<a href="{{ route('produits.create') }}" class="btn">+ Ajouter produit</a>

<br><br>

<div class="grid">

@foreach($produits as $produit)

<div class="card">

<img src="{{ asset('storage/'.$produit->photo) }}" alt="">

<h3>{{ $produit->nom }}</h3>

<p class="small">
Catégorie : {{ $produit->categorie->nom ?? '' }}
</p>

<p class="small">
Créé par : {{ $produit->user->name ?? 'Cursage' }}
</p>

<p>{{ $produit->prix_vente }} FCFA</p>

<a href="{{ route('produits.show',$produit->id) }}" class="btn">
Voir
</a>

</div>

@endforeach

</div>

</div>

</body>
</html>