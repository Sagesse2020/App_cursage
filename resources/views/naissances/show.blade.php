<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Détail naissance</title>

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

<h1>👶 Détail naissance</h1>

<p><strong>Parents :</strong>
{{ $naissance->reproduction->male->nom }}
×
{{ $naissance->reproduction->femelle->nom }}
</p>

<p><strong>Date :</strong> {{ $naissance->date_naissance }}</p>
<p><strong>Mâles :</strong> {{ $naissance->nombre_males }}</p>
<p><strong>Femelles :</strong> {{ $naissance->nombre_femelles }}</p>
<p><strong>Morts :</strong> {{ $naissance->nombre_morts }}</p>
<p><strong>Observation :</strong> {{ $naissance->observation }}</p>

<a href="{{ route('naissances.index') }}">Retour</a>
</div>

</body>
</html>