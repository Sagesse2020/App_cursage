<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">
<title>Chiens disponibles</title>

<style>

body{
font-family:Segoe UI;
background:#f4f6f8;
margin:0;
padding:40px;
}

.container{
max-width:1300px;
margin:auto;
}

header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:30px;
flex-wrap:wrap;
gap:15px;
}


.btn-edit{
background:#0a7;
padding:8px 14px;
color:white;
border-radius:5px;
text-decoration:none;
}

.btn-delete{
background:#d33;
padding:8px 14px;
color:white;
border-radius:5px;
border:none;
cursor:pointer;
}

.card{
    background:#fff;
    border-radius:14px;
    box-shadow:0 12px 30px rgba(0,0,0,.08);
    overflow:hidden;
}

.btn{
    background:#111;
    color:#fff;
    padding:12px 20px;
    border-radius:6px;
    text-decoration:none;
}
.grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(260px,1fr));
    gap:25px;
}
.card{
    background:#fff;
    border-radius:14px;
    box-shadow:0 12px 30px rgba(0,0,0,.08);
    overflow:hidden;
}
.card img{
    width:100%;
    height:180px;
    object-fit:cover;
}
.card-content{padding:18px;}
.card-content h3{margin-bottom:6px;}
.actions{
    margin-top:12px;
    display:flex;
    gap:10px;
}
.actions a, .actions button{
    flex:1;
    padding:8px;
    border-radius:6px;
    border:none;
    cursor:pointer;
    text-align:center;
    text-decoration:none;
    color:#fff;
}
.details{background:#333;}
.edit{background:#0a7;}
.delete{background:#c0392b;}
</style>

</head>

<body>

<div class="container">

<header>

<h1>Chiens disponibles</h1>

@if(auth()->user()->niveau_admin >= 2)

<a href="{{ route('chiens.create') }}" class="btn">
Ajouter un chien
</a>

@endif

</header>

<div class="grid">

@foreach($chiens as $chien)

<div class="card">

<div class="image-container">

@if($chien->photo)

<img src="{{ asset('storage/'.$chien->photo) }}" alt="{{ $chien->nom }}">

@else

<img src="https://via.placeholder.com/400x200?text=Chien">

@endif

</div>

<div class="card-content">

<h3>{{ $chien->nom }}</h3>

<p>{{ $chien->race->nom ?? 'Race inconnue' }}</p>

<div class="price">
{{ number_format($chien->prix_base,0,',',' ') }} FCFA
</div>

<p>Statut : {{ $chien->statut }}</p>

@if(auth()->user()->niveau_admin >= 2)

<div class="actions">

<a href="{{ route('chiens.edit',$chien) }}" class="btn-edit">
Modifier
</a>

<form action="{{ route('chiens.destroy',$chien) }}" method="POST">

@csrf
@method('DELETE')

<button class="btn-delete">
Supprimer
</button>

</form>

</div>

@endif

</div>

</div>

@endforeach

</div>

</div>

</body>
</html>
