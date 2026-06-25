<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Ajouter un chien</title>

<style>

body{
font-family:Segoe UI;
background:#f1f5f9;
padding:20px;
}

.container{
max-width:1100px;
margin:auto;
background:white;
padding:30px;
border-radius:15px;
box-shadow:0 10px 30px rgba(0,0,0,.08);
}

h1{
margin-bottom:20px;
color:#0f172a;
}

.grid{
display:grid;
grid-template-columns:
repeat(auto-fit,minmax(250px,1fr));
gap:15px;
}

input,
select,
textarea,label{
width:100%;
padding:12px;
border:1px solid #ddd;
border-radius:10px;
font-size:15px;
}

textarea{
min-height:120px;
}

.btn{
background:#2563eb;
color:white;
padding:12px 20px;
border:none;
border-radius:10px;
cursor:pointer;
font-weight:bold;
}

.check{
display:flex;
align-items:center;
gap:10px;
}

.check input{
width:auto;
}

</style>

</head>

<body>

<div class="container">

<h1>🐕 Ajouter un chien</h1>

<form
action="{{ route('chiens.store') }}"
method="POST"
enctype="multipart/form-data">

@csrf

<div class="grid">

<input type="text"
name="nom"
placeholder="Nom du chien"
value="{{ old('nom') }}">

<select name="race_id">

<option value="">
Choisir une race
</option>

@foreach($races as $race)

<option value="{{ $race->id }}">
{{ $race->nom }}
</option>

@endforeach

</select>

<select name="partenaire_id">

<option value="">
Aucun partenaire
</option>

@foreach($partenaires as $partenaire)

<option value="{{ $partenaire->id }}">
{{ $partenaire->nom }}
</option>

@endforeach

</select>

<input type="text"
name="age"
placeholder="Age">

<select name="sexe">

<option value="">
Sexe
</option>

<option value="male">
Mâle
</option>

<option value="femelle">
Femelle
</option>

</select>

<label> Date de naissance : </label>
<input type="date" name="date_naissance" required>
<label> Date d'arriver :</label>
<input type="date" name="date_arrive" required>

<input type="number"
step="0.01"
name="poids"
placeholder="Poids">

<input type="text"
name="couleur"
placeholder="Couleur">

<input type="text"
name="numero_puce"
placeholder="Numéro puce">

<input type="text"
name="numero_pedigree"
placeholder="Numéro pedigree">

<input type="number"
step="0.01"
name="prix_base"
placeholder="Prix base">

<input type="number"
step="0.01"
name="prix_vaccine"
placeholder="Prix vacciné">

<input type="number"
step="0.01"
name="prix_dressage"
placeholder="Prix dressage">

<select name="statut">

<option value="disponible">
Disponible
</option>

<option value="reserve">
Réservé
</option>

<option value="vendu">
Vendu
</option>

<option value="en_soins">
En soins
</option>

</select>

<select name="provenance">

<option value="cursage">
Cursage
</option>

<option value="partenaire">
Partenaire
</option>

</select>

<input type="file"
name="photo">

</div>

<br>

<div class="check">

<input type="checkbox"
name="vacciné">

<label>Vacciné</label>

</div>

<br>

<div class="check">

<input type="checkbox"
name="dresse">

<label>Dressé</label>

</div>

<br>

<textarea
name="notes"
placeholder="Notes"></textarea>

<br><br>

<button class="btn">
Enregistrer
</button>

</form>

</div>

</body>
</html>