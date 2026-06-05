<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Réservations</title>

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
    padding:20px 25px;
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

/* STATUT */
.statut{
    padding:5px 10px;
    border-radius:20px;
    color:white;
    font-size:12px;
}

.attente{background:#f59e0b;}
.confirmee{background:#16a34a;}
.annulee{background:#dc2626;}

</style>
</head>

<body>

<div class="container">

<h1>📅 Réservations</h1>

<form method="GET" class="filters">

<input type="text" name="client" placeholder="Client...">

<select name="statut">
    <option value="">Tous statuts</option>
    <option value="attente">Attente</option>
    <option value="confirmee">Confirmée</option>
    <option value="annulee">Annulée</option>
</select>

<button>Filtrer</button>

</form>

@if(session('success'))
<p style="color:green">{{ session('success') }}</p>
@endif

<table>

<tr>
<th>Chien</th>
<th>Client</th>
<th>Contact</th>
<th>Date</th>
<th>Statut</th>
<th>Montant</th>
<th>Actions</th>
</tr>

@foreach($reservations as $r)

<tr>

<td>{{ $r->chien->nom ?? '' }}</td>
<td>{{ $r->client_nom }}</td>
<td>{{ $r->client_contact }}</td>
<td>{{ $r->date_reservation }}</td>

<td>
<span class="statut {{ $r->statut }}">
{{ $r->statut }}
</span>
</td>

<td>{{ $r->montant_verse }}</td>

<td>

<a href="{{ route('reservations.show',$r) }}" class="btn">Voir</a>
<a href="{{ route('reservations.edit',$r) }}" class="btn">Modifier</a>

<form action="{{ route('reservations.destroy',$r) }}" method="POST" style="display:inline;">
@csrf @method('DELETE')
<button onclick="return confirm('Supprimer ?')">SupprimerX</button>
</form>

</td>

</tr>

@endforeach

</table>

{{ $reservations->links() }}

</div>

</body>
</html>