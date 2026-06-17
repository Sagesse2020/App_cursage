<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Deces</title>

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

<h1>⚰️ Liste des décès</h1>

<!-- ================= FILTRES ================= -->
<form method="GET" class="filters">

<input type="text" name="chien" placeholder="Nom du chien...">

<input type="date" name="date_debut">

<input type="date" name="date_fin">

<button>Filtrer</button>

</form>

@if(session('success'))
<p style="color:green">{{ session('success') }}</p>
@endif

<!-- ================= TABLE ================= -->
<table>

<tr>
<th>Chien</th>
<th>Cause</th>
<th>Date décès</th>
<th>Utilisateur</th>
<th>Actions</th>
</tr>

@foreach($deces as $d)

<tr>

<td>{{ $d->chien->nom ?? '-' }}</td>

<td>
<span class="deces">
{{ $d->cause }}
</span>
</td>

<td>{{ $d->date_deces }}</td>

<td>{{ $d->user->name ?? '' }}</td>

<td>

<a href="{{ route('deces.show',$d) }}" class="btn">Voir</a>

@if(auth()->id() === $d->user_id || auth()->user()->niveau_admin >= 2)

<a href="{{ route('deces.edit',$d->id) }}" class="btn">
Modifier
</a>

<form method="POST" action="{{ route('deces.destroy',$deces->id) }}" style="display:inline;" "
      onsubmit="return confirm('Voulez-vous vraiment supprimer ce decès ?');">
@csrf
@method('DELETE')
<button class="btn delete">Supprimer</button>
</form>

<a href="{{ route('deces.create') }}" class="btn">
+ Nouveau deces
</a>

@endif

</td>

</tr>

@endforeach

</table>

<div class="pagination">
{{ $deces->links() }}
</div>
</div>

</body>
</html>