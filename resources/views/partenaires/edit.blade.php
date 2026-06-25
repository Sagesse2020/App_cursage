<!DOCTYPE html>

<html lang="fr">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Modifier partenaire</title>

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

<h1>✏️ Modifier partenaire</h1>

<div class="preview">

@if($partenaire->photo)

<img
src="{{ asset('storage/'.$partenaire->photo) }}">

@else

<img
src="{{ asset('default-user.png') }}">

@endif

</div>

<form
action="{{ route('partenaires.update',$partenaire) }}"
method="POST"
enctype="multipart/form-data">

@csrf
@method('PUT')

<div class="form-grid">

<div class="form-group">
<label>Nom</label>
<input
type="text"
name="nom"
value="{{ old('nom',$partenaire->nom) }}">
</div>

<div class="form-group">
<label>Prénom</label>
<input
type="text"
name="prenom"
value="{{ old('prenom',$partenaire->prenom) }}">
</div>

<div class="form-group">
<label>Téléphone</label>
<input
type="text"
name="telephone"
value="{{ old('telephone',$partenaire->telephone) }}">
</div>

<div class="form-group">
<label>Email</label>
<input
type="email"
name="email"
value="{{ old('email',$partenaire->email) }}">
</div>

<div class="form-group">
<label>Entreprise</label>
<input
type="text"
name="entreprise"
value="{{ old('entreprise',$partenaire->entreprise) }}">
</div>

<div class="form-group">
<label>Commission</label>
<input
type="number"
step="0.01"
name="commission"
value="{{ old('commission',$partenaire->commission) }}">
</div>

<div class="form-group">

<label>Type partenaire</label>

<select name="type_partenaire">

<option value="vendeur"
{{ $partenaire->type_partenaire=='vendeur' ? 'selected':'' }}>
Partenaire vendeur
</option>

<option value="apporteur_affaires"
{{ $partenaire->type_partenaire=='apporteur_affaires' ? 'selected':'' }}>
Apporteur d'affaires
</option>

</select>

</div>

<div class="form-group">

<label>Statut</label>

<select name="statut">

<option value="actif"
{{ $partenaire->statut=='actif' ? 'selected':'' }}>
Actif
</option>

<option value="suspendu"
{{ $partenaire->statut=='suspendu' ? 'selected':'' }}>
Suspendu
</option>

<option value="inactif"
{{ $partenaire->statut=='inactif' ? 'selected':'' }}>
Inactif
</option>

</select>

</div>

<div class="form-group full">

<label>Nouvelle photo</label>

<input
type="file"
name="photo">

</div>

<div class="form-group full">

<label>Adresse</label>

<textarea name="adresse">{{ old('adresse',$partenaire->adresse) }}</textarea>

</div>

<div class="full">

<button class="btn">

Mettre à jour le partenaire

</button>

</div>

</div>

</form>

</div>

</body>
</html>
