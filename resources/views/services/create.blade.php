<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Créer un service</title>
<style>

.form-container{
max-width:600px;
margin:auto;
padding:30px;
}

input,select,textarea{
width:100%;
padding:10px;
margin:10px 0;
background:#111827;
border:none;
color:white;
border-radius:6px;
}

button{
background:#00e6ff;
padding:12px;
border:none;
border-radius:6px;
cursor:pointer;
}


.cards{

display:grid;

grid-template-columns:repeat(auto-fit,minmax(250px,1fr));

gap:20px;

margin-top:30px
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
</body>
</html>
