<!DOCTYPE html>

<html lang="fr">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Paiements commissions</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
font-family:'Segoe UI',sans-serif;
background:#f1f5f9;
padding:25px;
color:#1e293b;
}

.topbar{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:35px;
flex-wrap:wrap;
gap:15px;
}

.topbar h1{
font-size:32px;
}

.btn{
background:#2563eb;
color:white;
padding:12px 18px;
border-radius:12px;
text-decoration:none;
font-weight:600;
border:none;
cursor:pointer;
}

.btn:hover{
background:#1d4ed8;
}

.btn-dark{
background:#0f172a;
}

.btn-danger{
background:#dc2626;
}

.grid{
display:grid;
grid-template-columns:
repeat(auto-fit,minmax(350px,1fr));
gap:25px;
}

.card{
background:white;
border-radius:20px;
padding:25px;
box-shadow:0 10px 30px rgba(0,0,0,.08);
transition:.3s;
}

.card:hover{
transform:translateY(-5px);
}

.title{
font-size:24px;
font-weight:bold;
margin-bottom:15px;
}

.info{
margin-bottom:10px;
font-size:15px;
color:#475569;
}

.amount{
font-size:28px;
font-weight:bold;
color:#2563eb;
margin-top:15px;
}

.badge{
display:inline-block;
padding:8px 15px;
border-radius:30px;
font-size:13px;
font-weight:bold;
margin-top:10px;
}

.badge.paye{
background:#dcfce7;
color:#166534;
}

.badge.en_attente{
background:#fef3c7;
color:#92400e;
}

.badge.annule{
background:#fee2e2;
color:#991b1b;
}

.actions{
margin-top:20px;
display:flex;
gap:10px;
flex-wrap:wrap;
}

.pagination{
margin-top:30px;
}

@media(max-width:768px){

body{
padding:15px;
}

.topbar h1{
font-size:25px;
}

}

</style>

</head>

<body>

<div class="topbar">

<h1>💳 Paiements des commissions</h1>

<a
href="{{ route('paiement_commissions.create') }}"
class="btn">

* Nouveau paiement

</a>

</div>

<div class="grid">

@foreach($paiements as $paiement)

<div class="card">

<div class="title">

{{ $paiement->commission->partenaire->nom }}

</div>

<div class="info">
📅 {{ $paiement->date_paiement }}
</div>

<div class="info">
💳 {{ ucfirst($paiement->mode_paiement) }}
</div>

<div class="info">
🔖 {{ $paiement->reference }}
</div>

<div class="amount">
{{ number_format($paiement->montant,0,',',' ') }}
FCFA
</div>

<span class="badge {{ $paiement->statut }}">
{{ $paiement->statut }}
</span>

<div class="actions">

<a
href="{{ route('paiement_commissions.show',$paiement) }}"
class="btn">

Voir

</a>

@if(auth()->check() && auth()->user()->niveau_admin >= 2)

<a
href="{{ route('paiement_commissions.edit',$paiement) }}"
class="btn btn-dark">

Modifier

</a>

<form
action="{{ route('paiement_commissions.destroy',$paiement) }}"
method="POST">

@csrf
@method('DELETE')

<button class="btn btn-danger">
Supprimer
</button>

</form>

@endif

</div>

</div>

@endforeach

</div>

<div class="pagination">
{{ $paiements->links() }}
</div>

</body>

</html>
