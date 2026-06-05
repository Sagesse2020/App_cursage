<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier achat</title>

<style>

body{
font-family:Segoe UI;
background:#f1f5f9;
padding:30px;
}

.form{
max-width:800px;
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

img{
width:250px;
margin-top:15px;
border-radius:12px;
}

</style>

</head>
<body>

<div class="form">

<h2>Modifier achat</h2>

<form
method="POST"
action="{{ route('achats.update',$achat) }}"
enctype="multipart/form-data"
>

@csrf
@method('PUT')

<input
type="text"
name="libelle"
value="{{ old('libelle',$achat->libelle) }}"
required
>

<textarea
name="description"
>{{ old('description',$achat->description) }}</textarea>

<input
type="number"
step="0.01"
name="montant"
value="{{ old('montant',$achat->montant) }}"
required
>

<input
type="date"
name="date_achat"
value="{{ old('date_achat',$achat->date_achat) }}"
required
>

<input
type="text"
name="fournisseur"
value="{{ old('fournisseur',$achat->fournisseur) }}"
>

<input
type="file"
name="facture"
>

@if($achat->facture)

<img
src="{{ asset('storage/'.$achat->facture) }}"
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