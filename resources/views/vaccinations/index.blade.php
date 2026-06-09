<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Liste des reproductions</title>

<style>
body{
    font-family:Arial;
    background:#f1f5f9;
    padding:25px;
}

.container{
    max-width:1200px;
    margin:auto;
}

h1{
    margin-bottom:20px;
}

/* FILTRES */
.filters{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
    margin-bottom:20px;
}

.filters input,
.filters select{
    padding:10px;
    border-radius:8px;
    border:1px solid #ccc;
}

.filters button{
    padding:10px 15px;
    background:#2563eb;
    color:white;
    border:none;
    border-radius:8px;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:10px;
    overflow:hidden;
}

th{
    background:#0f172a;
    color:white;
    padding:12px;
}

td{
    padding:12px;
    border-bottom:1px solid #eee;
}

/* BADGES */
.entree{background:#16a34a;color:white;padding:5px 10px;border-radius:20px;}
.sortie{background:#dc2626;color:white;padding:5px 10px;border-radius:20px;}

.pagination{
    margin-top:15px;
}

.btn{
    padding:6px 10px;
    border-radius:6px;
    text-decoration:none;
    font-size:13px;
}
</style>
</head>

<body>

<div class="container">
<h1>Liste des vaccinations</h1>

<a href="{{ route('vaccinations.create') }}">
Nouvelle vaccination
</a>

<form method="GET">

<input
type="text"
name="chien"
placeholder="Nom chien">

<button>
Filtrer
</button>

</form>

<table border="1">

<tr>

<th>Chien</th>
<th>Vaccin</th>
<th>Date</th>
<th>Rappel</th>
<th>Coût</th>
<th>Action</th>

</tr>

@foreach($vaccinations as $v)

<tr>

<td>{{ $v->chien->nom }}</td>

<td>{{ $v->nom_vaccin }}</td>

<td>{{ $v->date_vaccination }}</td>

<td>{{ $v->date_rappel }}</td>

<td>{{ $v->cout }}</td>

<td>

<a href="{{ route('vaccinations.show',$v) }}">
Voir
</a>
@if(auth()->id() === $v>user_id || auth()->user()->niveau == 3
    <a href="{{ route('vaccinations.edit',$v) }}">
Modifier
</a>

<form
action="{{ route('vaccinations.destroy',$v) }}"
method="POST">

@csrf
@method('DELETE')

<button>
Supprimer
</button>

</form>
@endif

</td>

</tr>

@endforeach

</table>

{{ $vaccinations->links() }}

</body>
</html>