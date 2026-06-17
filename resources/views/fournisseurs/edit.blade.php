<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier fournisseur</title>

<style>

body{
    font-family:Segoe UI;
    background:#f1f5f9;
    padding:25px;
}

.form-box{
    max-width:600px;
    margin:auto;
    background:white;
    padding:20px;
    border-radius:12px;
}

input{
    width:100%;
    padding:12px;
    margin-bottom:15px;
}

button{
    padding:12px;
    width:100%;
    background:#16a34a;
    color:white;
    border:none;
    border-radius:10px;
}

</style>
</head>

<body>

<div class="form-box">

<h2>✏️ Modifier fournisseur</h2>

<form method="POST" action="{{ route('fournisseurs.update',$fournisseur) }}">
@csrf
@method('PUT')

<input type="text" name="nom" value="{{ $fournisseur->nom }}">
<input type="email" name="email" value="{{ $fournisseur->email }}">
<input type="text" name="telephone" value="{{ $fournisseur->telephone }}">
<input type="text" name="adresse" value="{{ $fournisseur->adresse }}">

<button>Mettre à jour</button>

</form>

</div>

</body>
</html>