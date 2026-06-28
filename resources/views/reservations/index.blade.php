<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Réservations</title>

<style>

/* RESET */
*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
font-family:'Segoe UI',sans-serif;
background:#f8fafc;
padding:25px;
color:#1e293b;
}

/* HEADER */
.header{
display:flex;
justify-content:space-between;
align-items:center;
flex-wrap:wrap;
gap:15px;
margin-bottom:25px;
}

.page-title{
font-size:32px;
font-weight:700;
}

.page-subtitle{
color:#64748b;
margin-top:5px;
}

/* BUTTONS */
.btn{
display:inline-flex;
align-items:center;
gap:8px;
padding:10px 14px;
border:none;
border-radius:10px;
text-decoration:none;
cursor:pointer;
font-weight:600;
font-size:13px;
transition:.3s;
}

.btn-view{
background:#2563eb;
color:white;
}

.btn-edit{
background:#f59e0b;
color:#111827;
}

.btn-delete{
background:#dc2626;
color:white;
}

/* STATS */
.stats{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:20px;
margin-bottom:25px;
}

.stat-card{
background:white;
padding:20px;
border-radius:16px;
box-shadow:0 8px 20px rgba(0,0,0,.05);
}

.stat-label{
font-size:13px;
color:#64748b;
}

.stat-value{
font-size:26px;
font-weight:700;
margin-top:8px;
}

/* FILTERS */
.filters{
background:white;
padding:20px;
border-radius:16px;
box-shadow:0 8px 20px rgba(0,0,0,.05);
margin-bottom:25px;

display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:15px;
}

.filters input,
.filters select{
width:100%;
padding:12px;
border:1px solid #cbd5e1;
border-radius:10px;
outline:none;
}

.filters input:focus,
.filters select:focus{
border-color:#2563eb;
}

/* GRID CARDS */
.grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(370px,1fr));
gap:20px;
}

/* CARD */
.card{
background:white;
border-radius:18px;
padding:20px;
box-shadow:0 10px 25px rgba(0,0,0,.06);
transition:.3s;
}

.card:hover{
transform:translateY(-5px);
}

.card-header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:15px;
}

.title{
font-size:18px;
font-weight:700;
}

.info{
display:flex;
justify-content:space-between;
padding:8px 0;
border-bottom:1px solid #f1f5f9;
font-size:14px;
}

.info:last-child{
border-bottom:none;
}

/* BADGES */
.badge{
padding:6px 12px;
border-radius:20px;
font-size:12px;
font-weight:700;
text-transform:uppercase;
}

.attente{
background:#fef3c7;
color:#92400e;
}

.confirmee{
background:#dcfce7;
color:#166534;
}

.annulee{
background:#fee2e2;
color:#991b1b;
}

/* ACTIONS */
.actions{
margin-top:15px;
display:flex;
gap:10px;
flex-wrap:wrap;
}

/* PAGINATION */
.pagination{
margin-top:30px;
}

/* RESPONSIVE */
@media(max-width:768px){

body{
padding:15px;
}

.page-title{
font-size:24px;
}

}

</style>

</head>

<body>

<!-- HEADER -->
<div class="header">

<div>
<h1 class="page-title">📅 Réservations</h1>
<p class="page-subtitle">Gestion des réservations clients</p>
</div>

</div>

<!-- FILTRES -->
<form method="GET" class="filters">

<input type="text" name="client" placeholder="🔍 Client..." value="{{ request('client') }}">

<select name="statut">

<option value="">Tous statuts</option>

<option value="attente">Attente</option>
<option value="confirmee">Confirmée</option>
<option value="annulee">Annulée</option>

</select>

<button class="btn btn-view">Filtrer</button>

</form>

<!-- LISTE -->
<div class="grid">

@forelse($reservations as $r)

<div class="card">

<div class="card-header">

<div class="title">
{{ $r->chien->nom ?? 'Chien inconnu' }}
</div>

<span class="badge {{ $r->statut }}">
{{ ucfirst($r->statut) }}
</span>

</div>

<div class="info">
<span>Client</span>
<strong>{{ $r->client->nom ?? '-' }}</strong>
</div>

<div class="info">
<span>Date</span>
<strong>{{ $r->date_reservation }}</strong>
</div>

<div class="info">
<span>Montant versé</span>
<strong>{{ number_format($r->montant_verse ?? 0,0,',',' ') }} FCFA</strong>
</div>

<div class="info">
<span>Enregistré par</span>
<strong>{{ $r->user->name ?? 'N/A' }}</strong>
</div>

<div class="actions">

<a href="{{ route('reservations.show',$r) }}" class="btn btn-view">
👁 Voir
</a>

@if(auth()->id() === $r->user_id || auth()->user()->niveau_admin >= 2)

<a href="{{ route('reservations.edit',$r) }}" class="btn btn-edit">
✏ Modifier
</a>

<form action="{{ route('reservations.destroy',$r) }}" method="POST"
onsubmit="return confirm('Supprimer cette réservation ?')">

@csrf
@method('DELETE')

<button type="submit" class="btn btn-delete">
🗑 Supprimer
</button>

</form>

@endif

</div>

</div>

@empty

<div class="card">
<h3>Aucune réservation trouvée.</h3>
</div>

@endforelse

</div>

<!-- PAGINATION -->
<div class="pagination">
{{ $reservations->links() }}
</div>

</body>
</html>