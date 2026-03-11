<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier publication</title>
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
    background:#333;
    color:#fff;
    border:none;
    padding:14px;
    border-radius:8px;
    width:100%;
}
</style>
</head>
<body>

<form method="POST" action="{{ route('publications.update',$publication) }}" enctype="multipart/form-data">
@csrf
@method('PUT')

<h2>Modifier publication</h2>

<input type="text" name="titre" value="{{ $publication->titre }}" required>
<textarea name="contenu">{{ $publication->contenu }}</textarea>
<input type="file" name="image">

<button>Enregistrer</button>
</form>
</body>
</html>
