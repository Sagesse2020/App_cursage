<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Réservations</title>

<style>

body{
    font-family:"Segoe UI",sans-serif;
    background:#0b1020;
    color:#f5f6fa;
    margin:0;
    padding:25px;
}

.container{
    max-width:1200px;
    margin:auto;
}

h1{
    margin-bottom:25px;
    color:#00e6ff;
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
    padding:12px;
    border-radius:10px;
    border:none;
    outline:none;
    background:#111827;
    color:white;
}

.filters button{
    padding:12px 18px;
    background:#00e6ff;
    color:black;
    border:none;
    border-radius:10px;
    font-weight:bold;
    cursor:pointer;
}

.filters button:hover{
    transform:scale(1.05);
}

/* TABLE */
.table-box{
    background:#111827;
    border-radius:12px;
    overflow:auto;
    box-shadow:0 10px 25px rgba(0,0,0,.5);
}

table{
    width:100%;
    border-collapse:collapse;
    min-width:900px;
}

th{
    background:#020617;
    color:#00e6ff;
    padding:14px;
    text-align:left;
}

td{
    padding:14px;
    border-bottom:1px solid #1f2937;
}

tr:hover{
    background:#1f2937;
}

/* BADGES */
.badge{
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
    display:inline-block;
}

.attente{background:#f59e0b;}
.confirmee{background:#16a34a;}
.annulee{background:#dc2626;}

/* BUTTONS */
.btn{
    padding:6px 10px;
    border-radius:6px;
    text-decoration:none;
    font-size:12px;
    margin-right:5px;
    display:inline-block;
}

.view{background:#2563eb;color:white;}
.edit{background:#f59e0b;color:black;}
.delete{background:#dc2626;color:white;border:none;cursor:pointer;}

@media(max-width:768px){
    table{font-size:12px;}
    .filters{flex-direction:column;}
}

</style>

</head>

<body>

<div class="container">

<h1>📅 Réservations</h1>

<!-- FILTRES -->
<form method="GET" class="filters">

<input type="text" name="client" placeholder="🔍 Client...">

<select name="statut">
    <option value="">Tous statuts</option>
    <option value="attente">Attente</option>
    <option value="confirmee">Confirmée</option>
    <option value="annulee">Annulée</option>
</select>

<button>Filtrer</button>

</form>

@if(session('success'))
<p style="color:#22c55e">{{ session('success') }}</p>
@endif

<!-- TABLE -->
<div class="table-box">

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

<td>{{ $r->chien->nom ?? '-' }}</td>

<td>{{ $r->client->nom ?? '-' }}</td>

<td>{{ $r->client->contact ?? '-' }}</td>

<td>{{ $r->date_reservation }}</td>

<td>
<span class="badge {{ $r->statut }}">
{{ $r->statut }}
</span>
</td>

<td>{{ number_format($r->montant_verse ?? 0,0,',',' ') }} FCFA</td>

<td>

<a href="{{ route('reservations.show',$r) }}" class="btn view">Voir</a>

@if(auth()->id() === $r->user_id || auth()->user()->niveau == 3)
<a href="{{ route('reservations.edit',$r) }}" class="btn edit">Modifier</a>

<form action="{{ route('reservations.destroy',$r) }}" method="POST" style="display:inline;">
@csrf @method('DELETE')
<button class="btn delete" onclick="return confirm('Supprimer ?')">Supprimer</button>
</form>
 
@endif

</td>

</tr>

@endforeach

</table>

</div>

{{ $reservations->links() }}

</div>

</body>
</html>