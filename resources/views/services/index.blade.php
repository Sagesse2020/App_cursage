<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Liste des services</title>
<style>
.container{
padding:40px;
}

.stats{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
gap:20px;
margin-bottom:30px;
}

.box{
background:#111827;
padding:20px;
border-radius:10px;
}

.solde{
background:#00e6ff;
color:#000;
}

table{
width:100%;
border-collapse:collapse;
}

th,td{
padding:12px;
border-bottom:1px solid #333;
}

.btn{
background:#00e6ff;
padding:10px 15px;
border-radius:6px;
}

@media(max-width:768px){
table{
font-size:12px;
}
}
</style>
</head>
<body>
     <h2>Services CURSAGE</h2>

<a href="{{ route('services.create') }}">Ajouter service</a>

<div class="cards">

@foreach($services as $service)

<div class="card">

<h3>{{ $service->nom }}</h3>

<p>{{ $service->description }}</p>

<p>{{ $service->prix_vente }} FCFA</p>

<p>Status : {{ $service->statut }}</p>

<a href="{{ route('services.edit',$service->id) }}">
Modifier
</a>

</div>

@endforeach

</div>
</body>
</html>
