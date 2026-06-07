<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Creer une reproduction</title>

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

.btn{
    padding:6px 10px;
    border-radius:6px;
    text-decoration:none;
    font-size:13px;
}
</style>
</head>

<body>

<div class="form">

<h1>🐶 Ajouter une reproduction</h1>

<form method="POST" action="{{ route('reproductions.store') }}">
@csrf

<div class="grid">

<select name="male_id">
<option value="">Chien mâle</option>
@foreach($chiens as $chien)
@if($chien->sexe == 'male')
<option value="{{ $chien->id }}">{{ $chien->nom }}</option>
@endif
@endforeach
</select>

<select name="femelle_id">
<option value="">Chien femelle</option>
@foreach($chiens as $chien)
@if($chien->sexe == 'femelle')
<option value="{{ $chien->id }}">{{ $chien->nom }}</option>
@endif
@endforeach
</select>

<input type="date" name="date_reproduction">

<input type="text" name="resultat" placeholder="Résultat">

<textarea name="observations" placeholder="Observations"></textarea>

<label for="">La lignée du chien</label>
<input type="text" name="lignee_chien">

</div>

<br>

<button class="btn">Enregistrer</button>

</form>
</div>

</body>
</html>