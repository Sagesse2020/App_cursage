<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier dépense</title>

<style>

body{
font-family:Segoe UI;
background:#f1f5f9;
padding:30px;
}

.form{
max-width:700px;
margin:auto;
background:white;
padding:30px;
border-radius:15px;
}

input,
textarea,
select{
width:100%;
padding:12px;
margin-bottom:15px;
border:1px solid #ddd;
border-radius:10px;
}

button{
background:#2563eb;
color:white;
border:none;
padding:12px 20px;
border-radius:10px;
cursor:pointer;
}

img{
width:250px;
margin-top:10px;
border-radius:10px;
}

</style>

</head>
<body>

<div class="form">

<h2>Modifier dépense</h2>

<form
method="POST"
action="{{ route('depenses.update',$depense) }}"
enctype="multipart/form-data"
>

@csrf
@method('PUT')

<input
type="text"
name="libelle"
value="{{ old('libelle',$depense->libelle) }}"
required
>

<textarea
name="description"
>{{ old('description',$depense->description) }}</textarea>

<input
type="number"
step="0.01"
name="montant"
value="{{ old('montant',$depense->montant) }}"
required
>

<input
type="date"
name="date_depense"
value="{{ old('date_depense',$depense->date_depense) }}"
required
>

<select name="categorie">

<option
value="Salaire"
{{ $depense->categorie=='Salaire' ? 'selected':'' }}
>
Salaire
</option>

<option
value="Electricite"
{{ $depense->categorie=='Electricite' ? 'selected':'' }}
>
Electricité
</option>

<option
value="Internet"
{{ $depense->categorie=='Internet' ? 'selected':'' }}
>
Internet
</option>

<option
value="Carburant"
{{ $depense->categorie=='Carburant' ? 'selected':'' }}
>
Carburant
</option>

<option
value="Autre"
{{ $depense->categorie=='Autre' ? 'selected':'' }}
>
Autre
</option>

</select>

<input
type="file"
name="justificatif"
>

@if($depense->justificatif)

<img
src="{{ asset('storage/'.$depense->justificatif) }}"
>

@endif

<br><br>

<button>

Mettre à jour

</button>

</form>

</div>

</body>
</html>