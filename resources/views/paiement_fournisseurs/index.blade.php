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
background:#f1f5f9;
padding:25px;
color:#1e293b;
}

.topbar{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:30px;
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
}

.btn:hover{ background:#1d4ed8; }

.grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
gap:20px;
}

.card{
background:white;
padding:20px;
border-radius:18px;
box-shadow:0 10px 25px rgba(0,0,0,.08);
transition:.3s;
}

.card:hover{
transform:translateY(-5px);
}

.title{
font-size:20px;
font-weight:bold;
margin-bottom:10px;
}

.info{
color:#475569;
margin-bottom:6px;
}

.amount{
font-size:22px;
font-weight:bold;
color:#2563eb;
margin-top:10px;
}

.actions{
margin-top:15px;
display:flex;
gap:10px;
flex-wrap:wrap;
}

.btn-dark{
background:#0f172a;
}

.btn-danger{
background:#dc2626;
border:none;
color:white;
padding:10px 14px;
border-radius:10px;
cursor:pointer;
}

.badge{
display:inline-block;
padding:6px 12px;
border-radius:20px;
font-size:12px;
margin-top:8px;
}

.paye{ background:#dcfce7; color:#166534; }
.attente{ background:#fef9c3; color:#854d0e; }

</style>
</head>

<body>

<div class="topbar">
<h1>💰 Paiements fournisseurs</h1>

<a href="{{ route('paiement_fournisseurs.create') }}" class="btn">
+ Ajouter
</a>
</div>

<div class="grid">

@foreach($paiements as $paiement)

<div class="card">

<div class="title">
{{ $paiement->fournisseur->nom }}
</div>

<div class="info">
📅 {{ $paiement->date_paiement }}
</div>

<div class="info">
💳 {{ $paiement->mode_paiement }}
</div>

<div class="amount">
{{ number_format($paiement->montant,0,',',' ') }} FCFA
</div>

@if($paiement->statut == 'paye')
<span class="badge paye">Payé</span>
@else
<span class="badge attente">En attente</span>
@endif

<div class="actions">

<a href="{{ route('paiement_fournisseurs.show',$paiement) }}" class="btn">
Voir
</a>

<a href="{{ route('paiement_fournisseurs.edit',$paiement) }}" class="btn btn-dark">
Modifier
</a>

<form action="{{ route('paiement_fournisseurs.destroy',$paiement) }}" method="POST">
@csrf
@method('DELETE')

<button class="btn-danger">
Supprimer
</button>
</form>

</div>

</div>

@endforeach

</div>

{{ $paiements->links() }}

</body>
</html>