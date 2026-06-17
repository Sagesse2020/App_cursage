<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Ajouter fournisseur</title>

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
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
}

input{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    border:1px solid #ddd;
    border-radius:8px;
}

button{
    padding:12px;
    width:100%;
    background:#2563eb;
    color:white;
    border:none;
    border-radius:10px;
    cursor:pointer;
}

button:hover{
    background:#1d4ed8;
}

</style>
</head>

<body>

<div class="form-box">

<h2>➕ Ajouter un fournisseur</h2>

<form method="POST" action="{{ route('fournisseurs.store') }}">
@csrf

<input type="text" name="nom" placeholder="Nom" required>

<input type="email" name="email" placeholder="Email" required>

<input type="text" name="telephone" placeholder="Téléphone" required>

<input type="text" name="adresse" placeholder="Adresse" required>

<button>Enregistrer</button>

</form>

</div>

</body>
</html>