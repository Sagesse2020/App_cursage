<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Créer naissance</title>

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

<h1>🐶 Enregistrer une naissance</h1>

<form method="POST" action="{{ route('naissances.store') }}">
@csrf

<div class="grid">

<select name="reproduction_id">
<option value="">Choisir reproduction</option>
@foreach($reproductions as $r)
<option value="{{ $r->id }}">
{{ $r->male->nom }} × {{ $r->femelle->nom }} ({{ $r->date_reproduction }})
</option>
@endforeach
</select>

<input type="date" name="date_naissance">

<input type="number" name="nombre_males" placeholder="Nombre mâles">

<input type="number" name="nombre_femelles" placeholder="Nombre femelles">

<input type="number" name="nombre_morts" placeholder="Nombre morts">

<textarea name="observation" placeholder="Observation"></textarea>

</div>

<br>

<button class="btn">Enregistrer</button>

</form>
</div>

</body>
</html>