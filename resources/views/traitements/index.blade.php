<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Mouvements de stock</title>

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

<h1>📋 Liste des traitements</h1>

<a href="{{ route('traitements.create') }}" class="btn">+ Ajouter</a>

@if(session('success'))
<p style="color:green">{{ session('success') }}</p>
@endif

<table width="100%" border="1" cellspacing="0" cellpadding="10">

<tr>
<th>Chien</th>
<th>Traitement</th>
<th>Début</th>
<th>Fin</th>
<th>Coût</th>
<th>Actions</th>
</tr>

@foreach($traitements as $t)

<tr>
<td>{{ $t->chien->nom ?? '-' }}</td>
<td>{{ $t->nom_traitement }}</td>
<td>{{ $t->date_debut }}</td>
<td>{{ $t->date_fin }}</td>
<td>{{ $t->cout }}</td>

<td>

<a href="{{ route('traitements.show',$t) }}">Voir</a>
<a href="{{ route('traitements.edit',$t) }}">Modifier</a>

<form action="{{ route('traitements.destroy',$t) }}" method="POST" style="display:inline;">
@csrf @method('DELETE')
<button onclick="return confirm('Supprimer ?')">X</button>
</form>

</td>
</tr>

@endforeach

</table>

{{ $traitements->links() }}

</div>

</body>
</html>