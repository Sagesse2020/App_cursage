<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<title>Modifier employé</title>

<style>

body{
font-family:Segoe UI;
background:#f1f5f9;
padding:30px;
}

.container{
max-width:900px;
margin:auto;
background:white;
padding:30px;
border-radius:20px;
box-shadow:0 10px 25px rgba(0,0,0,.08);
}

h1{
margin-bottom:25px;
}

.form-group{
margin-bottom:20px;
}

label{
display:block;
margin-bottom:8px;
font-weight:bold;
}

input,
select,
textarea{
width:100%;
padding:12px;
border:1px solid #ddd;
border-radius:10px;
}

img{
width:200px;
height:200px;
object-fit:cover;
border-radius:15px;
margin-bottom:20px;
}

.btn{
background:#2563eb;
color:white;
padding:12px 20px;
border:none;
border-radius:10px;
cursor:pointer;
}

.btn:hover{
background:#1d4ed8;
}

.error{
color:red;
font-size:13px;
}

</style>

</head>

<body>

<div class="container">

<h1>Modifier employé</h1>

<form
action="{{ route('employees.update',$employee) }}"
method="POST"
enctype="multipart/form-data"
>

@csrf
@method('PUT')

@if($employee->photo)

<img
src="{{ asset('storage/'.$employee->photo) }}"
alt=""
>

@endif

<div class="form-group">

<label>Nom</label>

<input
type="text"
name="nom"
value="{{ old('nom',$employee->nom) }}"
>

</div>

<div class="form-group">

<label>Prénom</label>

<input
type="text"
name="prenom"
value="{{ old('prenom',$employee->prenom) }}"
>

</div>

<div class="form-group">

<label>Téléphone</label>

<input
type="text"
name="telephone"
value="{{ old('telephone',$employee->telephone) }}"
>

</div>

<div class="form-group">

<label>Email</label>

<input
type="email"
name="email"
value="{{ old('email',$employee->email) }}"
>

</div>

<div class="form-group">

<label>Poste</label>

<input
type="text"
name="poste"
value="{{ old('poste',$employee->poste) }}"
>

</div>

<div class="form-group">

<label>Salaire</label>

<input
type="number"
name="salaire"
value="{{ old('salaire',$employee->salaire) }}"
>

</div>

<div class="form-group">

<label>Date embauche</label>

<input
type="date"
name="date_embauche"
value="{{ old('date_embauche',$employee->date_embauche) }}"
>

</div>

<div class="form-group">

<label>Statut</label>

<select name="statut">

<option value="actif"
{{ $employee->statut=='actif'?'selected':'' }}>
Actif
</option>

<option value="suspendu"
{{ $employee->statut=='suspendu'?'selected':'' }}>
Suspendu
</option>

<option value="demission"
{{ $employee->statut=='demission'?'selected':'' }}>
Démission
</option>

</select>

</div>

<div class="form-group">

<label>Adresse</label>

<textarea name="adresse">

{{ old('adresse',$employee->adresse) }}

</textarea>

</div>

<div class="form-group">

<label>Nouvelle photo</label>

<input
type="file"
name="photo"
>

</div>

<button class="btn">

Mettre à jour

</button>

</form>

</div>

</body>

</html>