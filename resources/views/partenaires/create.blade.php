<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Ajouter un partenaire</title>

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

<h1>🤝 Ajouter un partenaire</h1>

<form
action="{{ route('partenaires.store') }}"
method="POST"
enctype="multipart/form-data">

@csrf

<div class="form-grid">

<div class="form-group">
<label>Nom</label>
<input type="text" name="nom" value="{{ old('nom') }}">
@error('nom')
<div class="error">{{ $message }}</div>
@enderror
</div>

<div class="form-group">
<label>Prénom</label>
<input type="text" name="prenom" value="{{ old('prenom') }}">
</div>

<div class="form-group">
<label>Téléphone</label>
<input type="text" name="telephone" value="{{ old('telephone') }}">
</div>

<div class="form-group">
<label>Email</label>
<input type="email" name="email" value="{{ old('email') }}">
</div>

<div class="form-group">
<label>Entreprise</label>
<input type="text" name="entreprise" value="{{ old('entreprise') }}">
</div>

<div class="form-group">
<label>Commission (%)</label>
<input type="number"
step="0.01"
name="commission"
value="{{ old('commission') }}">
</div>

<div class="form-group">
<label>Type partenaire</label>

<select name="type_partenaire">

<option value="vendeur">
Partenaire vendeur
</option>

<option value="apporteur_affaires">
Apporteur d'affaires
</option>

</select>

</div>

<div class="form-group">
<label>Statut</label>

<select name="statut">

<option value="actif">Actif</option>
<option value="suspendu">Suspendu</option>
<option value="inactif">Inactif</option>

</select>

</div>

<div class="form-group full">
<label>Photo</label>
<input type="file" name="photo">
</div>

<div class="form-group full">
<label>Adresse</label>
<textarea name="adresse">{{ old('adresse') }}</textarea>
</div>

<div class="full">
<button class="btn">
Enregistrer le partenaire
</button>
</div>

</div>

</form>

</div>

</body>
</html>