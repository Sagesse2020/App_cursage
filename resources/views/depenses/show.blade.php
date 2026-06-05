<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Détail dépense</title>

<style>

body{
font-family:Segoe UI;
background:#f1f5f9;
padding:30px;
}

.card{
max-width:800px;
margin:auto;
background:white;
padding:30px;
border-radius:15px;
}

img{
width:300px;
margin-top:20px;
border-radius:12px;
}

</style>

</head>
<body>

<div class="card">

<h1>{{ $depense->libelle }}</h1>

<p>

<strong>Description :</strong>

{{ $depense->description }}

</p>

<p>

<strong>Montant :</strong>

{{ number_format($depense->montant,0,',',' ') }}
FCFA

</p>

<p>

<strong>Catégorie :</strong>

{{ $depense->categorie }}

</p>

<p>

<strong>Date :</strong>

{{ $depense->date_depense }}

</p>

<p>

<strong>Créé par :</strong>

{{ $depense->user->name ?? '' }}

</p>

@if($depense->justificatif)

<img
src="{{ asset('storage/'.$depense->justificatif) }}"
>

@endif

<br><br>

<a href="{{ route('depenses.index') }}">

Retour

</a>

</div>

</body>
</html>