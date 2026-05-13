<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier {{ $evenement->titre }}</title>
<style>
body{font-family:'Segoe UI',sans-serif;background:#eef2f5;padding:40px;}
form{max-width:600px;margin:auto;background:#fff;padding:30px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,.1);}
img{width:100%;height:220px;object-fit:cover;border-radius:10px;margin-bottom:15px;}
label{display:block;margin-top:15px;font-weight:600;}
input,textarea{width:100%;padding:10px;margin-top:6px;border-radius:6px;border:1px solid #ccc;}
button{margin-top:20px;background:#333;color:#fff;border:none;padding:12px;width:100%;border-radius:6px;}
</style>
</head>
<body>
<form method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

@if($evenement->image)
<img src="{{ asset('storage/'.$evenement->image) }}">
@endif

<label>Titre</label>
<input type="text" name="titre" value="{{ $evenement->titre }}" required>

<label>Description</label>
<textarea name="description" rows="4">{{ $evenement->description }}</textarea>

<label>Date</label>
<input type="date" name="date" value="{{ $evenement->date }}" required>

<label>Nouvelle image</label>
<input type="file" name="image">

<button>Mettre à jour</button>
</form>
</body>
</html>
