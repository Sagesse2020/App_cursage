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

<h1>📦 Mouvements de stock</h1>

<!-- ================= FILTRES RÉUTILISABLES ================= -->
<form method="GET" class="filters">

<input type="text" name="produit" placeholder="Produit...">

<select name="type">
    <option value="">Tous types</option>
    <option value="entree">Entrée</option>
    <option value="sortie">Sortie</option>
</select>

<input type="date" name="date_debut">
<input type="date" name="date_fin">

<button>Filtrer</button>

</form>

<!-- ================= TABLE ================= -->
<table>

<tr>
<th>Produit</th>
<th>Type</th>
<th>Quantité</th>
<th>Motif</th>
<th>Utilisateur</th>
<th>Date</th>
</tr>

@foreach($mouvements as $mouvement)

<tr>

<td>{{ $mouvement->produit->nom ?? '' }}</td>

<td>
<span class="{{ $mouvement->type }}">
{{ $mouvement->type }}
</span>
</td>

<td>{{ $mouvement->quantite }}</td>

<td>{{ $mouvement->motif }}</td>

<td>{{ $mouvement->user->name ?? '' }}</td>

<td>{{ $mouvement->created_at }}</td>

</tr>

@endforeach

</table>

<div class="pagination">
{{ $mouvements->links() }}
</div>

</div>

@if(auth()->id() === $mouvement->user_id || auth()->user()->niveau_admin >= 2)

<a href="{{ route('mouvements.edit',$mouvement->id) }}" class="btn">
Modifier
</a>

<form method="POST" action="{{ route('mouvements.destroy',$mouvement->id) }}" style="display:inline;" "
      onsubmit="return confirm('Voulez-vous vraiment supprimer ce mouvement de stock ?');">
@csrf
@method('DELETE')
<button class="btn delete">Supprimer</button>
</form>

<a href="{{ route('mouvements.create') }}" class="btn">
+ Nouveau mouvement 
</a>

@endif
</body>
</html>