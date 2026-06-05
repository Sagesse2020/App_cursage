<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Détail produit</title>

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

<h1>{{ $produit->nom }}</h1>

<h1>🔎 Détail traitement</h1>

<p><strong>Chien :</strong> {{ $traitement->chien->nom }}</p>
<p><strong>Nom :</strong> {{ $traitement->nom_traitement }}</p>
<p><strong>Date début :</strong> {{ $traitement->date_debut }}</p>
<p><strong>Date fin :</strong> {{ $traitement->date_fin }}</p>
<p><strong>Coût :</strong> {{ $traitement->cout }}</p>
<p><strong>Description :</strong> {{ $traitement->description }}</p>

<a href="{{ route('traitements.index') }}">Retour</a>

</div>

</body>
</html>