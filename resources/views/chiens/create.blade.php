<!DOCTYPE html>
<html>
<head>

<title>Ajouter chien</title>

<style>

body{
font-family:Segoe UI;
background:#f4f6f8;
}

.form{

max-width:600px;
margin:auto;
background:white;
padding:30px;
border-radius:10px;

}

input,select,textarea{

width:100%;
padding:10px;
margin:10px 0;
border:1px solid #ddd;
border-radius:6px;

}

button{

background:#111;
color:white;
padding:12px;
border:none;
border-radius:6px;

}

</style>

</head>

<body>

<div class="form">

<h2>Ajouter un chien</h2>

<form method="POST" enctype="multipart/form-data" action="{{ route('chiens.store') }}">

@csrf

<label>Nom</label>
<input type="text" name="nom">

<label>Race</label>
<select name="race_id">

@foreach($races as $race)

<option value="{{ $race->id }}">
{{ $race->nom }}
</option>

@endforeach

</select>

<label>Partenaire</label>

<select name="partenaire_id">

<option value="">Aucun</option>

@foreach($partenaires as $p)

<option value="{{ $p->id }}">
{{ $p->nom }}
</option>

@endforeach

</select>

<label>Prix base</label>
<input type="number" name="prix_base">

<label>Photo</label>
<input type="file" name="photo">

<label>Date arrivée</label>
<input type="date" name="date_arrive">

<label>Notes</label>
<textarea name="notes"></textarea>

<button>Enregistrer</button>

</form>

</div>

</body>
</html>
