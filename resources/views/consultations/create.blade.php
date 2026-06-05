<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Créer consultation</title>

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

<h1>Nouvelle consultation</h1>

<form method="POST" action="{{ route('consultations.store') }}">

@csrf

<label>Chien</label>

<select name="chien_id">

@foreach($chiens as $chien)

<option value="{{ $chien->id }}">
    {{ $chien->nom }}
</option>

@endforeach

</select>

<label>Date consultation</label>

<input type="date" name="date_consultation">

<label>Vétérinaire</label>

<input type="text" name="veterinaire">

<label>Diagnostic</label>

<textarea name="diagnostic"></textarea>

<label>Prescription</label>

<textarea name="prescription"></textarea>

<label>Coût</label>

<input type="number" step="0.01" name="cout">

<button type="submit"> Enregistrer </button>

</form>
</div>

</body>
</html>