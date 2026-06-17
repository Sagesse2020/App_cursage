<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Consultations</title>

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
<h2>Les consultations vétérinaires</h2>

<a href="{{ route('consultations.create') }}">
Ajouter
</a>

<table>

<thead>

<tr>
<th>Chien</th>
<th>Date</th>
<th>Vétérinaire</th>
<th>Coût</th>
</tr>

</thead>

<tbody>

@foreach($consultations as $consultation)

<tr>

<td>
{{ $consultation->chien->nom }}
</td>

<td>
{{ $consultation->date_consultation }}
</td>

<td>
{{ $consultation->veterinaire }}
</td>

<td>
{{ number_format($consultation->cout,2) }}
</td>

</tr>

@endforeach

<a href="{{ route('consultations.show',$consultation->id) }}" class="btn">
Voir
</a>

@if(auth()->id() === $consultation->user_id || auth()->user()->niveau_admin >= 2)

<a href="{{ route('consultations.edit',$consultation->id) }}" class="btn">
Modifier
</a>

<form method="POST" action="{{ route('consultations.destroy',$consultation->id) }}" style="display:inline;" "
      onsubmit="return confirm('Voulez-vous vraiment supprimer cette consultation ?');">
@csrf
@method('DELETE')
<button class="btn delete">Supprimer</button>
</form>

<a href="{{ route('consultations.create') }}" class="btn">
+ Nouvelle consultation
</a>

@endif
</tbody>

</table>

{{ $consultations->links() }}
</div>

</body>
</html>