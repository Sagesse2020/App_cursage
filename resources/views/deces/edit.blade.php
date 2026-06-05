<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier deces</title>

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

<div class="container">

<h1>✏️ Modifier décès</h1>

<form method="POST" action="{{ route('deces.update',$deces) }}">
@csrf
@method('PUT')

<div class="filters">

<select name="chien_id">
@foreach($chiens as $chien)
<option value="{{ $chien->id }}"
{{ $deces->chien_id == $chien->id ? 'selected' : '' }}>
{{ $chien->nom }}
</option>
@endforeach
</select>

<input type="text" name="cause"
value="{{ old('cause',$deces->cause) }}"
placeholder="Cause">

<input type="date" name="date_deces"
value="{{ old('date_deces',$deces->date_deces) }}">

<textarea name="observation">{{ old('observation',$deces->observation) }}</textarea>

<button>Modifier</button>

</div>

</form>

</div>

</body>
</html>