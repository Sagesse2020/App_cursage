<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Ajouter une commission partenaire</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
font-family:'Segoe UI',sans-serif;
background:#f1f5f9;
padding:25px;
color:#1e293b;
}

.container{
max-width:900px;
margin:auto;
background:white;
padding:35px;
border-radius:20px;
box-shadow:0 10px 30px rgba(0,0,0,.08);
}

h1{
text-align:center;
margin-bottom:30px;
color:#0f172a;
}

.form-grid{
display:grid;
grid-template-columns:1fr 1fr;
gap:20px;
}

.form-group{
display:flex;
flex-direction:column;
}

label{
font-weight:600;
margin-bottom:8px;
}

input,
select,
textarea{
padding:12px;
border:1px solid #cbd5e1;
border-radius:12px;
font-size:15px;
}

textarea{
resize:none;
height:120px;
}

.full{
grid-column:1/-1;
}

.btn{
background:#2563eb;
color:white;
border:none;
padding:14px;
border-radius:12px;
cursor:pointer;
font-weight:bold;
font-size:16px;
width:100%;
transition:.3s;
}

.btn:hover{
background:#1d4ed8;
}

.error{
color:red;
font-size:14px;
margin-top:5px;
}

@media(max-width:768px){

.form-grid{
grid-template-columns:1fr;
}

.container{
padding:20px;
}

}

</style>

</head>

<body>

<div class="container">
<h1>➕ Nouvelle commission</h1>

<form
action="{{ route('partenaire_commissions.store') }}"
method="POST">

@csrf

<label>Partenaire</label>

<select name="partenaire_id" required>

@foreach($partenaires as $partenaire)

<option value="{{ $partenaire->id }}">

{{ $partenaire->nom }}

</option>

@endforeach

</select>

<label>Produit</label>

<select name="produit_id">

<option value="">Aucun</option>

@foreach($produits as $produit)

<option value="{{ $produit->id }}">

{{ $produit->nom }}

</option>

@endforeach

</select>

<label>Chien</label>

<select name="chien_id">

<option value="">Aucun</option>

@foreach($chiens as $chien)

<option value="{{ $chien->id }}">

{{ $chien->nom }}

</option>

@endforeach

</select>

<label>Pourcentage</label>

<input
type="number"
step="0.01"
name="pourcentage"
required>

<label>Montant fixe</label>

<input
type="number"
step="0.01"
name="montant_fixe">

<label>Date début du partenariat avec ce pourcentage</label>

<input
type="date"
name="date_debut"
required>

<label>Date de fin du partenariat avec ce pourcentage</label>

<input
type="date"
name="date_fin">

<button class="btn">

Enregistrer

</button>

</form>

</div>

</body>
</html>