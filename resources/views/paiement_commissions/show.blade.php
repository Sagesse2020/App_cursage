<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Détails paiement commission</title>

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

.container{
max-width:800px;
margin:auto;
background:white;
padding:35px;
border-radius:20px;
box-shadow:0 10px 30px rgba(0,0,0,.08);
}

h1{
text-align:center;
margin-bottom:25px;
font-size:28px;
}

.card{
padding:20px;
border-radius:15px;
background:#f8fafc;
margin-bottom:15px;
border:1px solid #e2e8f0;
}

.label{
font-weight:bold;
color:#475569;
}

.value{
font-size:16px;
margin-top:5px;
}

.badge{
display:inline-block;
padding:8px 15px;
border-radius:30px;
font-size:13px;
font-weight:bold;
margin-top:10px;
}

.paye{
background:#dcfce7;
color:#166534;
}

.attente{
background:#fef9c3;
color:#854d0e;
}

.annule{
background:#fee2e2;
color:#991b1b;
}

.btn{
display:inline-block;
margin-top:20px;
background:#2563eb;
color:white;
padding:12px 18px;
border-radius:12px;
text-decoration:none;
font-weight:bold;
}

.btn:hover{
background:#1d4ed8;
}

</style>
</head>

<body>

<div class="container">

<h1>💰 Détails paiement commission</h1>

<!-- Commission -->
<div class="card">
<div class="label">Commission partenaire</div>
<div class="value">
{{ $paiementCommission->commission->partenaire->nom }}

@if($paiementCommission->commission->produit)
- 📦 {{ $paiementCommission->commission->produit->nom }}
@elseif($paiementCommission->commission->chien)
- 🐶 {{ $paiementCommission->commission->chien->nom }}
@endif
</div>
</div>

<!-- Montant -->
<div class="card">
<div class="label">Montant</div>
<div class="value">
{{ number_format($paiementCommission->montant,0,',',' ') }} FCFA
</div>
</div>

<!-- Date -->
<div class="card">
<div class="label">Date de paiement</div>
<div class="value">
{{ $paiementCommission->date_paiement }}
</div>
</div>

<!-- Mode paiement -->
<div class="card">
<div class="label">Mode de paiement</div>
<div class="value">
{{ $paiementCommission->mode_paiement }}
</div>
</div>

<!-- Référence -->
<div class="card">
<div class="label">Référence</div>
<div class="value">
{{ $paiementCommission->reference ?? 'Aucune' }}
</div>
</div>

<!-- Statut -->
<div class="card">
<div class="label">Statut</div>
<div class="value">

@if($paiementCommission->statut == 'paye')
<span class="badge paye">Payé</span>

@elseif($paiementCommission->statut == 'en_attente')
<span class="badge attente">En attente</span>

@else
<span class="badge annule">Annulé</span>
@endif

</div>
</div>

<!-- Utilisateur -->
<div class="card">
<div class="label">Enregistré par</div>
<div class="value">
{{ $paiementCommission->user->name ?? 'N/A' }}
</div>
</div>

<a href="{{ route('paiement_commissions.index') }}" class="btn">
⬅ Retour
</a>

</div>

</body>
</html>