<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Liste des paiements</title>

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

/* BUTTON */
.btn{
display:inline-flex;
align-items:center;
gap:8px;
padding:12px 18px;
border:none;
border-radius:12px;
text-decoration:none;
cursor:pointer;
font-weight:600;
transition:.3s;
}

.btn-primary{
background:#2563eb;
color:white;
}

.btn-primary:hover{
background:#1d4ed8;
}

.btn-dark{
background:#0f172a;
color:white;
}

.btn-dark:hover{
background:#020617;
}

.btn-danger{
background:#dc2626;
color:white;
}

.btn-danger:hover{
background:#b91c1c;
}

/* STATS */
.stats{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
gap:20px;
margin-bottom:25px;
}

.stat-card{
background:white;
padding:25px;
border-radius:18px;
box-shadow:0 8px 20px rgba(0,0,0,.05);
}

.stat-label{
font-size:14px;
color:#64748b;
margin-bottom:10px;
}

.stat-value{
font-size:28px;
font-weight:700;
}

/* FILTERS */
.filters{
background:white;
padding:20px;
border-radius:18px;
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
border-radius:12px;
outline:none;
}

.filters input:focus,
.filters select:focus{
border-color:#2563eb;
}

/* GRID */
.grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(370px,1fr));
gap:25px;
}

/* CARD */
.card{
background:white;
border-radius:20px;
padding:25px;
box-shadow:0 10px 30px rgba(0,0,0,.06);
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
font-size:20px;
font-weight:700;
}

.amount{
font-size:30px;
font-weight:700;
color:#2563eb;
margin:15px 0;
}

/* INFO */
.info{
display:flex;
justify-content:space-between;
padding:10px 0;
border-bottom:1px solid #f1f5f9;
font-size:14px;
}

.info:last-child{
border-bottom:none;
}

/* BADGES */
.badge{
padding:8px 14px;
border-radius:30px;
font-size:12px;
font-weight:700;
text-transform:uppercase;
}

.entree{
background:#dcfce7;
color:#166534;
}

.sortie{
background:#fee2e2;
color:#991b1b;
}

.payé{
background:#dbeafe;
color:#1e40af;
}

.attente{
background:#fef3c7;
color:#92400e;
}

/* ACTIONS */
.actions{
margin-top:20px;
display:flex;
gap:10px;
flex-wrap:wrap;
}

/* PAGINATION */
.pagination{
margin-top:35px;
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
<h1 class="page-title">💰 Liste des paiements</h1>
<p class="page-subtitle">Gestion complète des entrées et sorties financières</p>
</div>

<a href="{{ route('paiements.create') }}" class="btn btn-primary">
➕ Nouveau paiement
</a>

</div>

<!-- STATS -->
<div class="stats">

<div class="stat-card">
<div class="stat-label">Total paiements</div>
<div class="stat-value">{{ $paiements->total() }}</div>
</div>

<div class="stat-card">
<div class="stat-label">Montant total</div>
<div class="stat-value">
{{ number_format($paiements->sum('montant'),0,',',' ') }} FCFA
</div>
</div>

</div>

<!-- FILTERS -->
<form method="GET" class="filters">

<input type="text" name="search" placeholder="🔍 Référence / ID" value="{{ request('search') }}">

<select name="type">
<option value="">Type</option>
<option value="entree">Entrée</option>
<option value="sortie">Sortie</option>
</select>

<select name="statut">
<option value="">Statut</option>
<option value="payé">Payé</option>
<option value="attente">En attente</option>
</select>

<input type="date" name="date_debut">
<input type="date" name="date_fin">

<button class="btn btn-primary">Filtrer</button>

</form>

<!-- LISTE -->
<div class="grid">

@forelse($paiements as $p)

<div class="card">

<div class="card-header">

<div class="title">
Paiement #{{ $p->id }}
</div>

<span class="badge {{ $p->type }}">
{{ $p->type }}
</span>

</div>

<div class="amount">
{{ number_format($p->montant,0,',',' ') }} FCFA
</div>

<div class="info">
<span>Mode</span>
<strong>{{ $p->mode_paiement }}</strong>
</div>

<div class="info">
<span>Statut</span>
<strong>{{ $p->statut }}</strong>
</div>

<div class="info">
<span>Date</span>
<strong>{{ $p->date_paiement }}</strong>
</div>

<div class="info">
<span>Réservation</span>
<strong>{{ $p->reservation?->id ?? '---' }}</strong>
</div>

<div class="info">
<span>Vente</span>
<strong>{{ $p->vente?->id ?? '---' }}</strong>
</div>

<div class="info">
<span>Facture</span>
<strong>{{ $p->facture?->id ?? '---' }}</strong>
</div>

<div class="actions">

<a href="{{ route('paiements.show',$p) }}" class="btn btn-primary">
👁 Voir
</a>

@if(auth()->id() === $p->user_id || auth()->user()->niveau_admin == 3)

<a href="{{ route('paiements.edit',$p) }}" class="btn btn-dark">
✏ Modifier
</a>

<form action="{{ route('paiements.destroy',$p) }}" method="POST"
onsubmit="return confirm('Supprimer ce paiement ?')">

@csrf
@method('DELETE')

<button class="btn btn-danger">
🗑 Supprimer
</button>

</form>

@endif

</div>

</div>

@empty

<div class="card">
<h3>Aucun paiement trouvé.</h3>
</div>

@endforelse

</div>

<!-- PAGINATION -->
<div class="pagination">
{{ $paiements->links() }}
</div>

</body>
</html>