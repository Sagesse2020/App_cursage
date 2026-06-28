<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Salaires</title>

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
color:#2563eb;
}

/* GRID */
.grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
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

.employee{
font-size:20px;
font-weight:700;
}

.amount{
font-size:28px;
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

/* BADGE */
.badge{
padding:8px 14px;
border-radius:30px;
font-size:12px;
font-weight:700;
text-transform:uppercase;
background:#dbeafe;
color:#1e40af;
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
<h1 class="page-title">💼 Salaires</h1>
<p class="page-subtitle">Gestion des salaires des employés</p>
</div>

<a href="{{ route('salaires.create') }}" class="btn btn-primary">
➕ Ajouter salaire
</a>

</div>

<!-- STATISTIQUES -->
<div class="stats">

<div class="stat-card">
<div class="stat-label">Nombre de salaires</div>
<div class="stat-value">{{ $salaires->total() }}</div>
</div>

<div class="stat-card">
<div class="stat-label">Total versé</div>
<div class="stat-value">
{{ number_format($salaires->sum('montant_net'),0,',',' ') }} FCFA
</div>
</div>

</div>

<!-- LISTE -->
<div class="grid">

@forelse($salaires as $salaire)

<div class="card">

<div class="card-header">

<div class="employee">
{{ $salaire->employee->nom ?? 'Employé inconnu' }}
</div>

<span class="badge">
Salaire
</span>

</div>

<div class="amount">
{{ number_format($salaire->montant_net,0,',',' ') }} FCFA
</div>

<div class="info">
<span>Mois</span>
<strong>{{ $salaire->mois }}</strong>
</div>

<div class="info">
<span>Date paiement</span>
<strong>{{ $salaire->date_paiement ?? '---' }}</strong>
</div>

<div class="info">
<span>Statut</span>
<strong>{{ $salaire->statut ?? 'Payé' }}</strong>
</div>

<div class="info">
<span>Utilisateur</span>
<strong>{{ $salaire->user->name ?? 'N/A' }}</strong>
</div>

<div class="actions">

<a href="{{ route('salaires.show',$salaire) }}"
class="btn btn-primary">

👁 Voir

</a>

@if(auth()->user()->niveau_admin >= 2)

<a href="{{ route('salaires.edit',$salaire) }}"
class="btn btn-dark">

✏ Modifier

</a>

<form action="{{ route('salaires.destroy',$salaire) }}"
method="POST"
onsubmit="return confirm('Supprimer ce salaire ?')">

@csrf
@method('DELETE')

<button type="submit" class="btn btn-danger">
🗑 Supprimer
</button>

</form>

@endif

</div>

</div>

@empty

<div class="card">
<h3>Aucun salaire trouvé.</h3>
</div>

@endforelse

</div>

<!-- PAGINATION -->
<div class="pagination">
{{ $salaires->links() }}
</div>

</body>
</html>