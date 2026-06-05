<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier fiche</title>

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
}

img{
    width:100%;
    border-radius:10px;
    margin-bottom:10px;
}
</style>
</head>

<body>

<div class="form">

<h1>✏️ Modifier fiche de suivi</h1>

<form method="POST" action="{{ route('fiches_suivi.update',$fiche) }}">
@csrf
@method('PUT')

<div class="grid">

<select name="chien_id">
@foreach($chiens as $chien)
<option value="{{ $chien->id }}"
{{ $fiche->chien_id == $chien->id ? 'selected' : '' }}>
{{ $chien->nom }}
</option>
@endforeach
</select>

<input type="number" step="0.01" name="poids"
value="{{ old('poids',$fiche->poids) }}">

<input type="number" step="0.01" name="temperature"
value="{{ old('temperature',$fiche->temperature) }}">

<input type="text" name="etat_general"
value="{{ old('etat_general',$fiche->etat_general) }}">

<textarea name="alimentation">{{ old('alimentation',$fiche->alimentation) }}</textarea>

<textarea name="observation">{{ old('observation',$fiche->observation) }}</textarea>

<input type="date" name="date_suivi"
value="{{ old('date_suivi',$fiche->date_suivi) }}">

</div>

<br>

<button class="btn">Modifier</button>

</form>
</div>

</body>
</html>