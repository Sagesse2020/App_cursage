<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Catégories</title>

<style>

body{
margin:0;
font-family:Segoe UI;
background:#020617;
color:white;
}

.header{
padding:60px 20px;
text-align:center;
}

.header h1{
font-size:45px;
color:#00e6ff;
}

.container{
max-width:1200px;
margin:auto;
padding:20px;
}

.grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
gap:25px;
}

.card{
background:#111827;
padding:25px;
border-radius:20px;
transition:.3s;
border:1px solid rgba(255,255,255,.05);
}

.card:hover{
transform:translateY(-8px);
box-shadow:0 10px 30px rgba(0,230,255,.15);
}

.card h3{
margin-bottom:12px;
color:#00e6ff;
}

.card p{
color:#94a3b8;
line-height:1.7;
}

.btn{
display:inline-block;
margin-top:15px;
padding:10px 16px;
background:#00e6ff;
color:black;
text-decoration:none;
border-radius:12px;
font-weight:bold;
}

.top{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:25px;
}

</style>

</head>

<body>

<div class="header">

<h1>Gestion des catégories</h1>

</div>

<div class="container">

<div class="top">

<h2>Liste des catégories</h2>

</div>

<div class="grid">

@foreach($categories as $categorie)

<div class="card">

<h3>{{ $categorie->nom }}</h3>

<p>
{{ $categorie->description }}
</p>

<p>
Créée par :
{{ $categorie->user->name ?? 'CURSAGE' }}
</p>

<a href="{{ route('categories.show',$categorie->id) }}" class="btn"> Voir </a>

@if(auth()->id() === $categorie->user_id || auth()->user()->niveau == 3)

<a href="{{ route('categories.edit',$categorie->id) }}" class="btn">
Modifier
</a>

<a href="{{ route('categories.destroy',$categorie->id) }}" class="btn">
supprimer
</a>

<a href="{{ route('categories.create') }}" class="btn">
+ Nouvelle catégorie
</a>

@endif


</div>

@endforeach

</div>

</div>

</body>
</html>