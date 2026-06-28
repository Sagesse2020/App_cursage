<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Paiements fournisseurs</title>

<style>

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

/* BOUTONS */

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

/* FILTRES */

.filters{
background:white;
padding:20px;
border-radius:18px;
box-shadow:0 8px 20px rgba(0,0,0,.05);
margin-bottom:25px;

display:grid;
grid-template-columns:
repeat(auto-fit,minmax(220px,1fr));

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
grid-template-columns:
repeat(auto-fit,minmax(370px,1fr));
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

.partner{
font-size:22px;
font-weight:700;
}

.amount{
font-size:30px;
font-weight:700;
color:#2563eb;
margin:20px 0;
}

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

.badge.paye{
background:#dcfce7;
color:#166534;
}

.badge.attente{
background:#fef3c7;
color:#92400e;
}

.badge.annule{
background:#fee2e2;
color:#991b1b;
}

/* ACTIONS */

.actions{
margin-top:20px;
display:flex;
gap:10px;
flex-wrap:wrap;
}

.actions form{
display:inline;
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

.grid{
grid-template-columns:1fr;
}

}

</style>

</head>

<body>

<!-- HEADER -->

<div class="header">

<div>

<h1 class="page-title">
💰 Paiements fournisseurs
</h1>

<p class="page-subtitle">
Gestion des règlements effectués aux fournisseurs
</p>

</div>

<a href="{{ route('paiement_fournisseurs.create') }}"
class="btn btn-primary">

➕ Nouveau paiement

</a>

</div>

<!-- STATISTIQUES -->

<div class="stats">

<div class="stat-card">
<div class="stat-label">Nombre de paiements</div>
<div class="stat-value">
{{ $paiements->total() }}
</div>
</div>

<div class="stat-card">
<div class="stat-label">Montant total payé</div>
<div class="stat-value">
{{ number_format($paiements->sum('montant'),0,',',' ') }}
FCFA
</div>
</div>

</div>

<!-- FILTRES -->

<form method="GET" class="filters">

<input
type="text"
name="search"
placeholder="🔍 Fournisseur..."
value="{{ request('search') }}"
>

<select name="statut">

<option value="">Tous les statuts</option>

<option value="paye"
{{ request('statut')=='paye' ? 'selected':'' }}>
Payé
</option>

<option value="attente"
{{ request('statut')=='attente' ? 'selected':'' }}>
En attente
</option>

<option value="annule"
{{ request('statut')=='annule' ? 'selected':'' }}>
Annulé
</option>

</select>

<select name="mode_paiement">

<option value="">Tous les modes</option>

<option value="especes">Espèces</option>
<option value="mobile_money">Mobile Money</option>
<option value="virement">Virement</option>
<option value="cheque">Chèque</option>

</select>

<button class="btn btn-primary">
🔎 Filtrer
</button>

</form>

<!-- LISTE -->

<div class="grid">

@forelse($paiements as $paiement)

<div class="card">

<div class="card-header">

<div class="partner">
{{ $paiement->fournisseur->nom ?? 'Fournisseur inconnu' }}
</div>

<span class="badge {{ $paiement->statut }}">
{{ ucfirst($paiement->statut) }}
</span>

</div>

<div class="amount">
{{ number_format($paiement->montant,0,',',' ') }}
FCFA
</div>

<div class="info">
<span>Date paiement</span>
<strong>{{ $paiement->date_paiement }}</strong>
</div>

<div class="info">
<span>Mode paiement</span>
<strong>{{ ucfirst(str_replace('_',' ',$paiement->mode_paiement)) }}</strong>
</div>

<div class="info">
<span>Référence</span>
<strong>{{ $paiement->reference ?? '---' }}</strong>
</div>

<div class="info">
<span>Utilisateur</span>
<strong>{{ $paiement->user->name ?? 'N/A' }}</strong>
</div>

<div class="actions">

<a href="{{ route('paiement_fournisseurs.show',$paiement) }}"
class="btn btn-primary">

👁 Voir

</a>

<a href="{{ route('paiement_fournisseurs.edit',$paiement) }}"
class="btn btn-dark">

✏ Modifier

</a>

<form
action="{{ route('paiement_fournisseurs.destroy',$paiement) }}"
method="POST"
onsubmit="return confirm('Supprimer ce paiement ?')">

@csrf
@method('DELETE')

<button
type="submit"
class="btn btn-danger">

🗑 Supprimer

</button>

</form>

</div>

</div>

@empty

<div class="card">
<h3>Aucun paiement trouvé.</h3>
</div>

@endforelse

</div>

<div class="pagination">
{{ $paiements->links() }}
</div>

</body>
</html>