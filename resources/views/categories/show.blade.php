<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>{{ $categorie->nom }}</title>

<style>

body{
font-family:Segoe UI;
background:#020617;
color:white;
padding:40px;
}

.box{
max-width:700px;
margin:auto;
background:#111827;
padding:35px;
border-radius:20px;
}

h1{
color:#00e6ff;
}

p{
line-height:1.8;
color:#cbd5e1;
}

</style>

</head>

<body>

<div class="box">

<h1>
    Nom
    {{ $categorie->nom }}
</h1>

<p>
Description
{{ $categorie->description }}
</p>

<p>
Créée par :
{{ $categorie->user->name ?? 'CURSAGE' }}
</p>

</div>

</body>
</html>