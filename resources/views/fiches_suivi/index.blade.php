<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Fiches de suivi</title>

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
</style>
</head>

<body>

<div class="container">

<h1>📊 Fiches de suivi</h1>

<a href="{{ route('fiches_suivi.create') }}" class="btn">+ Ajouter</a>

@if(session('success'))
<p style="color:green">{{ session('success') }}</p>
@endif

<table width="100%" border="1" cellspacing="0" cellpadding="10">

<tr>
<th>Chien</th>
<th>Poids</th>
<th>Température</th>
<th>État</th>
<th>Date</th>
<th>Actions</th>
</tr>

@foreach($fiches as $f)

<tr>
<td>{{ $f->chien->nom ?? '-' }}</td>
<td>{{ $f->poids }}</td>
<td>{{ $f->temperature }}</td>
<td>{{ $f->etat_general }}</td>
<td>{{ $f->date_suivi }}</td>

<td>

<a href="{{ route('fiches_suivi.show',$f) }}">Voir</a>
<a href="{{ route('fiches_suivi.edit',$f) }}">Modifier</a>

<form action="{{ route('fiches_suivi.destroy',$f) }}" method="POST" style="display:inline;">
@csrf @method('DELETE')
<button onclick="return confirm('Supprimer ?')">X</button>
</form>

</td>
</tr>

@endforeach

</table>

{{ $fiches->links() }}

</div>

</body>
</html>