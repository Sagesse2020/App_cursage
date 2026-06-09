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

<form method="POST" action="{{ route('vaccinations.store') }}">
@csrf

<label>Chien</label>

<select name="chien_id">

@foreach($chiens as $chien)

<option value="{{ $chien->id }}">
{{ $chien->nom }}
</option>

@endforeach

</select>

<br><br>

<label>Nom vaccin</label>

<input type="text"
name="nom_vaccin">

<br><br>

<label>Date vaccination</label>

<input type="date"
name="date_vaccination">

<br><br>

<label>Date rappel</label>

<input type="date"
name="date_rappel">

<br><br>

<label>Coût</label>

<input type="number"
step="0.01"
name="cout">

<br><br>

<label>Observation</label>

<textarea
name="observation"></textarea>

<br><br>

<button>
Enregistrer
</button>

</form>

</div>

</body>
</html>