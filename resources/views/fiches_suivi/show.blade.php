<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Détail fiche</title>

<style>
body{
    font-family: Arial;
    background:#0f172a;
    color:white;
    padding:20px;
}

.container{
    max-width:600px;
    margin:auto;
    background:#111827;
    padding:20px;
    border-radius:12px;
}

img{
    width:100%;
    max-height:300px;
    object-fit:contain;
    border-radius:12px;
}

.back{
    display:inline-block;
    margin-top:15px;
    color:#00e6ff;
    text-decoration:none;
}
</style>
</head>

<body>

<div class="container">

<h1>🔎 Détail fiche de suivi</h1>

<p><strong>Chien :</strong> {{ $fiche->chien->nom }}</p>
<p><strong>Poids :</strong> {{ $fiche->poids }}</p>
<p><strong>Température :</strong> {{ $fiche->temperature }}</p>
<p><strong>État général :</strong> {{ $fiche->etat_general }}</p>
<p><strong>Alimentation :</strong> {{ $fiche->alimentation }}</p>
<p><strong>Observation :</strong> {{ $fiche->observation }}</p>
<p><strong>Date :</strong> {{ $fiche->date_suivi }}</p>

<a href="{{ route('fiches_suivi.index') }}">Retour</a>

</div>

</body>
</html>