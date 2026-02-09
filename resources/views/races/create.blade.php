<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Ajouter une race</title>

<style>
body{background:#f4f6f8;font-family:'Segoe UI';padding:40px;}
.form-box{
    max-width:600px;
    margin:auto;
    background:#fff;
    padding:30px;
    border-radius:14px;
    box-shadow:0 15px 40px rgba(0,0,0,.08);
}
input,textarea{
    width:100%;
    padding:14px;
    margin-bottom:15px;
    border-radius:8px;
    border:1px solid #ccc;
}
button{
    width:100%;
    padding:14px;
    background:#111;
    color:#fff;
    border:none;
    border-radius:8px;
}
</style>
</head>

<body>
<div class="form-box">
<h1>Ajouter une race</h1>

<form method="POST" action="{{ route('races.store') }}" enctype="multipart/form-data">
@csrf

<input type="text" name="nom" placeholder="Nom de la race" required>
<input type="text" name="origine" placeholder="Origine">
<input type="file" name="image">

<textarea name="description" placeholder="Description de la race"></textarea>

<button>Enregistrer</button>
</form>
</div>
</body>
</html>
