<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Détail deces</title>

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

<h1>⚰️ Détail décès</h1>

<p><strong>Chien :</strong> {{ $deces->chien->nom }}</p>
<p><strong>Cause :</strong> {{ $deces->cause }}</p>
<p><strong>Date :</strong> {{ $deces->date_deces }}</p>
<p><strong>Observation :</strong> {{ $deces->observation }}</p>
<p><strong>Enregistré par :</strong> {{ $deces->user->name ?? '' }}</p>

<a href="{{ route('deces.index') }}">Retour</a>
</div>

</body>
</html>