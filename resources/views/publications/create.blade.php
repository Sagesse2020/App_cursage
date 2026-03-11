<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Créer publication</title>
<style>
body{font-family:Segoe UI;background:#f4f6f8;padding:40px}
form{
    max-width:700px;
    margin:auto;
    background:#fff;
    padding:30px;
    border-radius:18px;
}
input,textarea{
    width:100%;
    padding:12px;
    margin-top:10px;
}
button{
    margin-top:20px;
    background:#0a7;
    color:#fff;
    border:none;
    padding:14px;
    border-radius:8px;
    width:100%;
}
</style>
</head>
<body>

<form method="POST" action="{{ route('publications.store') }}" enctype="multipart/form-data">
@csrf
<h2>Nouvelle publication</h2>

<input type="text" name="titre" placeholder="Titre" required>
<textarea name="contenu" placeholder="Contenu"></textarea>
<input type="file" name="image">

<button>Publier</button>
</form>

</body>
</html>
