<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Nouvelle dépense</title>

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
padding:12px 20px;
border:none;
border-radius:10px;
cursor:pointer;
}

</style>

</head>
<body>

<div class="form">

<h2>Nouvelle dépense</h2>

<form
method="POST"
action="{{ route('depenses.store') }}"
enctype="multipart/form-data"
>

@csrf

<input
type="text"
name="libelle"
placeholder="Libellé"
required
>

<textarea
name="description"
placeholder="Description"
></textarea>

<input
type="number"
step="0.01"
name="montant"
placeholder="Montant"
required
>

<input
type="date"
name="date_depense"
required
>

<select name="categorie">

<option value="">Choisir</option>

<option>Salaire</option>
<option>Electricite</option>
<option>Internet</option>
<option>Carburant</option>
<option>Autre</option>

</select>

<input
type="file"
name="justificatif"
>

<button>

Enregistrer

</button>

</form>

</div>

</body>
</html>