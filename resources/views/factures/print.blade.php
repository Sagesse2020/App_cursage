<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<title>Facture {{ $facture->numero }}</title>

<style>

body{
font-family:Arial;
margin:40px;
color:#333;
}

/* zone facture */

.facture{
max-width:800px;
margin:auto;
}

/* header */

.header{
display:flex;
justify-content:space-between;
margin-bottom:40px;
}

.logo{
font-size:26px;
font-weight:bold;
color:#00aaff;
}

.entreprise{
text-align:right;
}

/* infos */

.infos{
margin-bottom:30px;
}

.infos strong{
display:block;
}

/* table */

table{
width:100%;
border-collapse:collapse;
margin-top:20px;
}

th,td{
border:1px solid #ddd;
padding:10px;
text-align:left;
}

th{
background:#f4f4f4;
}

/* total */

.total{
margin-top:20px;
width:300px;
float:right;
}

.total td{
border:none;
padding:6px;
}

.total .grand{
font-size:18px;
font-weight:bold;
}

/* bouton print */

.print-btn{
margin-bottom:20px;
padding:10px 20px;
background:#00aaff;
color:white;
border:none;
cursor:pointer;
border-radius:6px;
}

/* cacher bouton à l'impression */

@media print{

.print-btn{
display:none;
}

body{
margin:0;
}

}

/* LOGO */

.logo-container{display:flex;align-items:center;gap:12px;}

.logo-img{
width:60px;height:60px;object-fit:cover;border-radius:14px;
background:rgba(0,230,255,.25);
padding:4px;
box-shadow:0 5px 18px rgba(0,230,255,.25);
}

</style>

</head>

<body>

<div class="facture">

<button class="print-btn" onclick="window.print()">
Imprimer / Télécharger PDF
</button>

<div class="header">

<div class="logo-container">
<img src="{{ asset('images/logo.png') }}" class="logo-img">
<div class="logo-text">
<span class="title">CURSAGE</span>
<small>Plateforme intelligente</small>
</div>
</div>

<div class="entreprise">

Cursage Solutions
Gestion & Services numériques
Pointe-Noire - Congo

</div>

</div>

<h2>FACTURE N° {{ $facture->numero }}</h2>

<p>Date : {{ $facture->date->format('d/m/Y') }}</p>

<div class="infos">

<strong>Client</strong>

{{ $facture->client->nom ?? 'Client' }}

</div>

<table>

<thead>

<tr>

<th>Description</th>
<th>Montant</th>

</tr>

</thead>

<tbody>

<tr>

<td>
Vente #{{ $facture->vente_id ?? '-' }}
</td>

<td>
{{ number_format($facture->total,0,',',' ') }} FCFA
</td>

</tr>

</tbody>

</table>


<table class="total">

<tr>

<td>Total</td>

<td>
{{ number_format($facture->total,0,',',' ') }} FCFA
</td>

</tr>

<tr>

<td class="grand">
TOTAL À PAYER
</td>

<td class="grand">
{{ number_format($facture->total,0,',',' ') }} FCFA
</td>

</tr>

</table>

</div>

</body>

</html>
