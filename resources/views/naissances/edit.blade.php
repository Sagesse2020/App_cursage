<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier naissance</title>

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

<h1>✏️ Modifier naissance</h1>

<form method="POST" action="{{ route('naissances.update',$naissance) }}">
@csrf
@method('PUT')

<div class="grid">

<select name="reproduction_id">
@foreach($reproductions as $r)
<option value="{{ $r->id }}"
{{ $naissance->reproduction_id == $r->id ? 'selected' : '' }}>
{{ $r->male->nom }} × {{ $r->femelle->nom }}
</option>
@endforeach
</select>

<input type="date" name="date_naissance"
value="{{ old('date_naissance',$naissance->date_naissance) }}">

<input type="number" name="nombre_males"
value="{{ old('nombre_males',$naissance->nombre_males) }}">

<input type="number" name="nombre_femelles"
value="{{ old('nombre_femelles',$naissance->nombre_femelles) }}">

<input type="number" name="nombre_morts"
value="{{ old('nombre_morts',$naissance->nombre_morts) }}">

<textarea name="observation">{{ old('observation',$naissance->observation) }}</textarea>

</div>

<br>

<button class="btn">Modifier</button>

</form>
</div>

</body>
</html>