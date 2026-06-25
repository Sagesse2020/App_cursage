<!DOCTYPE html>

<html lang="fr">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Modifier commission partenaire</title>

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

.preview{
width:180px;
height:180px;
margin:auto;
margin-bottom:25px;
border-radius:50%;
overflow:hidden;
border:5px solid #e2e8f0;
}

.preview img{
width:100%;
height:100%;
object-fit:cover;
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
}

textarea{
height:120px;
resize:none;
}

.full{
grid-column:1/-1;
}

.btn{
width:100%;
padding:14px;
background:#2563eb;
border:none;
border-radius:12px;
color:white;
font-size:16px;
font-weight:bold;
cursor:pointer;
}

.btn:hover{
background:#1d4ed8;
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

<h1>

✏ Modifier commission

</h1>

<form
action="{{ route(
'partenaire-commissions.update',
$partenaireCommission
) }}"
method="POST">

@csrf
@method('PUT')

<select
name="partenaire_id">

@foreach($partenaires as $partenaire)

<option
value="{{ $partenaire->id }}"
{{ $partenaireCommission->partenaire_id==$partenaire->id ? 'selected':'' }}>

{{ $partenaire->nom }}

</option>

@endforeach

</select>

<select name="produit_id">

<option value="">

Aucun

</option>

@foreach($produits as $produit)

<option
value="{{ $produit->id }}"
{{ $partenaireCommission->produit_id==$produit->id ? 'selected':'' }}>

{{ $produit->nom }}

</option>

@endforeach

</select>

<select name="chien_id">

<option value="">

Aucun

</option>

@foreach($chiens as $chien)

<option
value="{{ $chien->id }}"
{{ $partenaireCommission->chien_id==$chien->id ? 'selected':'' }}>

{{ $chien->nom }}

</option>

@endforeach

</select>

<input
type="number"
step="0.01"
name="pourcentage"
value="{{ $partenaireCommission->pourcentage }}">

<input
type="number"
step="0.01"
name="montant_fixe"
value="{{ $partenaireCommission->montant_fixe }}">

<input
type="date"
name="date_debut"
value="{{ $partenaireCommission->date_debut }}">

<input
type="date"
name="date_fin"
value="{{ $partenaireCommission->date_fin }}">

<button class="btn">

Mettre à jour

</button>

</form>
</div>

</body>
</html>
