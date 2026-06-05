<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Créer un traitement</title>

<style>
body{
    font-family: Arial;
    background:#0f172a;
    color:white;
    padding:20px;
}

.form{
    max-width:500px;
    margin:auto;
    background:#111827;
    padding:20px;
    border-radius:12px;
}

input, select, textarea{
    width:100%;
    padding:10px;
    margin-bottom:10px;
    border-radius:8px;
    border:none;
}

button{
    background:#00e6ff;
    border:none;
    padding:10px;
    width:100%;
    font-weight:bold;
    border-radius:8px;
}
</style>
</head>

<body>

<div class="form">

<h1>💊 Ajouter un traitement</h1>

<form method="POST" action="{{ route('traitements.store') }}">
@csrf

<div class="grid">

<select name="chien_id">
<option value="">Choisir un chien</option>
@foreach($chiens as $chien)
<option value="{{ $chien->id }}">{{ $chien->nom }}</option>
@endforeach
</select>

<input type="text" name="nom_traitement" placeholder="Nom traitement">

<input type="date" name="date_debut">

<input type="date" name="date_fin">

<input type="number" step="0.01" name="cout" placeholder="Coût">

<textarea name="description" placeholder="Description"></textarea>

</div>

<br>

<button class="btn">Enregistrer</button>

</form>
</div>

</body>
</html>