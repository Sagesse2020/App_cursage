<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Créer decès</title>

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

<h1>Nouveau decès</h1>

<form method="POST" action="{{ route('deces.store') }}">
@csrf

<select name="chien_id">
@foreach($chiens as $chien)
<option value="{{ $chien->id }}">{{ $chien->nom }}</option>
@endforeach
</select>

<input type="date" name="date_deces">

<input type="text" name="cause" placeholder="Cause">

<input type="text" name="description" placeholder="Description">

<select name="user_id">
@foreach($users as $user)
<option value="{{ $user->id }}">{{ $user->name }}</option>
@endforeach
</select>

<button>Enregistrer</button>
</form>
</div>

</body>
</html>