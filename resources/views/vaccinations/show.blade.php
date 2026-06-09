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

<h1>Détail vaccination</h1>

<p>
Chien :
{{ $vaccination->chien->nom }}
</p>

<p>
Vaccin :
{{ $vaccination->nom_vaccin }}
</p>

<p>
Date vaccination :
{{ $vaccination->date_vaccination }}
</p>

<p>
Date rappel :
{{ $vaccination->date_rappel }}
</p>

<p>
Coût :
{{ $vaccination->cout }}
FCFA
</p>

<p>
Observation :
{{ $vaccination->observation }}
</p>

</div>

</body>
</html>