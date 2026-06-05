<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier produit</title>

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

<h1>✏️ Modifier reproduction</h1>

<form method="POST" action="{{ route('reproductions.update',$reproduction) }}">
@csrf
@method('PUT')

<div class="grid">

<select name="male_id">
@foreach($chiens as $chien)
@if($chien->sexe == 'male')
<option value="{{ $chien->id }}"
{{ $reproduction->male_id == $chien->id ? 'selected' : '' }}>
{{ $chien->nom }}
</option>
@endif
@endforeach
</select>

<select name="femelle_id">
@foreach($chiens as $chien)
@if($chien->sexe == 'femelle')
<option value="{{ $chien->id }}"
{{ $reproduction->femelle_id == $chien->id ? 'selected' : '' }}>
{{ $chien->nom }}
</option>
@endif
@endforeach
</select>

<input type="date" name="date_reproduction"
value="{{ old('date_reproduction',$reproduction->date_reproduction) }}">

<input type="text" name="resultat"
value="{{ old('resultat',$reproduction->resultat) }}">

<textarea name="observations">{{ old('observations',$reproduction->observations) }}</textarea>

</div>

<br>

<button class="btn">Modifier</button>

</form>

</div>

</body>
</html>