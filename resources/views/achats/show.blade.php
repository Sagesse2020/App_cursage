<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">

<title>Détails vente</title>

<link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

<style>

body{
background:#0b1020;
color:white;
font-family:Segoe UI;
padding:40px
}

.card{
max-width:600px;
margin:auto;
background:#111827;
padding:30px;
border-radius:10px
}

.item{
margin-bottom:15px
}

</style>

</head>

<body>

<div class="card">

<h2>Détails de la vente</h2>

<div class="item">
<strong>Chien :</strong>
{{ $vente->chien->nom }}
</div>

<div class="item">
<strong>Client :</strong>
{{ $vente->client->nom }}
</div>

<div class="item">
<strong>Prix :</strong>
{{ number_format($vente->prix_vente,0,',',' ') }} FCFA
</div>

<div class="item">
<strong>Commission partenaire :</strong>
{{ number_format($vente->commission_partenaire,0,',',' ') }} FCFA
</div>

<div class="item">
<strong>Commission CURSAGE :</strong>
{{ number_format($vente->commission_cursage,0,',',' ') }} FCFA
</div>

<div class="item">
<strong>Date :</strong>
{{ $vente->date_vente }}
</div>

</div>

</body>
</html>
