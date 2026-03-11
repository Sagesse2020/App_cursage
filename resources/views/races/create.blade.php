<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Ajouter une race</title>

<style>
body{
    font-family:'Segoe UI',sans-serif;
    background:#f4f6f8;
    padding:40px;
}
form{
    max-width:600px;
    margin:auto;
    background:#fff;
    padding:30px;
    border-radius:14px;
    box-shadow:0 10px 30px rgba(0,0,0,.1);
}
label{display:block;margin-top:15px;font-weight:600;}
input,textarea{
    width:100%;
    padding:10px;
    margin-top:6px;
    border-radius:6px;
    border:1px solid #ccc;
}
button{
    margin-top:20px;
    background:#0a7;
    color:#fff;
    border:none;
    padding:12px;
    width:100%;
    border-radius:6px;
    cursor:pointer;
}
</style>
</head>

<body>

<form method="POST" enctype="multipart/form-data">
@csrf

<h2>Nouvelle race</h2>

<label>Nom</label>
<input type="text" name="nom" required>

<label>Origine</label>
<input type="text" name="origine">

<label>Description</label>
<textarea name="description" rows="4"></textarea>

<label>Image</label>
<input type="file" name="image">

<button>Enregistrer</button>
</form>
</body>
</html>
