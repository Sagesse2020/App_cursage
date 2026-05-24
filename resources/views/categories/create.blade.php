<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Créer catégorie</title>

<style>

body{
font-family:Segoe UI;
background:#020617;
color:white;
padding:40px;
}

form{
max-width:600px;
margin:auto;
background:#111827;
padding:30px;
border-radius:20px;
}

input,textarea{
width:100%;
padding:14px;
margin-bottom:18px;
border:none;
border-radius:12px;
background:#1e293b;
color:white;
}

button{
padding:14px 20px;
border:none;
border-radius:12px;
background:#00e6ff;
font-weight:bold;
cursor:pointer;
}

</style>

</head>

<body>

<form method="POST" action="{{ route('categories.store') }}">

@csrf

<h1>Créer catégorie</h1>

<input type="text" name="nom" placeholder="Nom catégorie">

<textarea name="description" placeholder="Description"></textarea>

<button type="submit">
Créer catégorie
</button>

</form>

</body>
</html>
