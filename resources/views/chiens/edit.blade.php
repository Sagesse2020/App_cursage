<!DOCTYPE html>

<html lang="fr">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Modifier chien</title>

<style>

body{
font-family:Segoe UI;
background:#f1f5f9;
padding:20px;
}

.card{
max-width:1100px;
margin:auto;
background:white;
padding:25px;
border-radius:20px;
box-shadow:0 10px 30px rgba(0,0,0,.08);
}

h1{
margin-bottom:20px;
}

.grid{
display:grid;
grid-template-columns:
repeat(auto-fit,minmax(250px,1fr));
gap:15px;
}

input,
select,
textarea{
width:100%;
padding:12px;
border:1px solid #ddd;
border-radius:10px;
}

textarea{
min-height:120px;
}

.photo{
width:250px;
height:250px;
object-fit:cover;
border-radius:15px;
margin-bottom:15px;
}

.btn{
background:#2563eb;
color:white;
padding:12px 20px;
border:none;
border-radius:10px;
cursor:pointer;
margin-top:20px;
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

<div class="card">

<h1>Modifier le chien</h1>

<form
method="POST"
action="{{ route('chiens.update',$chien) }}"
enctype="multipart/form-data"
>

@csrf
@method('PUT')

@if($chien->photo)

<img
src="{{ asset('storage/'.$chien->photo) }}"
class="photo"

>

@endif

<div class="grid">

<input
type="text"
name="nom"
value="{{ old('nom',$chien->nom) }}"
placeholder="Nom"

>

<select name="race_id">

@foreach($races as $race)

<option
value="{{ $race->id }}"
{{ $chien->race_id==$race->id ? 'selected' : '' }}
>
{{ $race->nom }}
</option>

@endforeach

</select>

<select name="partenaire_id">

<option value="">
Aucun partenaire
</option>

@foreach($partenaires as $partenaire)

<option
value="{{ $partenaire->id }}"
{{ $chien->partenaire_id==$partenaire->id ? 'selected':'' }}
>
{{ $partenaire->nom }}
</option>

@endforeach

</select>

<input
type="date"
name="date_naissance"
value="{{ $chien->date_naissance }}"

>

<input
type="date"
name="date_arrive"
value="{{ $chien->date_arrive }}"

>

<input
type="number"
step="0.01"
name="poids"
value="{{ $chien->poids }}"
placeholder="Poids"

>

<input
type="text"
name="couleur"
value="{{ $chien->couleur }}"
placeholder="Couleur"

>

<input
type="text"
name="numero_puce"
value="{{ $chien->numero_puce }}"
placeholder="Numéro puce"

>

<input
type="text"
name="numero_pedigree"
value="{{ $chien->numero_pedigree }}"
placeholder="Numéro pedigree"

>

<input
type="number"
step="0.01"
name="prix_base"
value="{{ $chien->prix_base }}"
placeholder="Prix base"

>

<input
type="number"
step="0.01"
name="prix_vaccine"
value="{{ $chien->prix_vaccine }}"
placeholder="Prix vacciné"

>

<input
type="number"
step="0.01"
name="prix_dressage"
value="{{ $chien->prix_dressage }}"
placeholder="Prix dressage"

>

<select name="sexe">

<option value="male"
{{ $chien->sexe=='male' ? 'selected':'' }}>
Mâle
</option>

<option value="femelle"
{{ $chien->sexe=='femelle' ? 'selected':'' }}>
Femelle
</option>

</select>

<select name="statut">

<option value="disponible">Disponible</option>
<option value="reserve">Réservé</option>
<option value="vendu">Vendu</option>
<option value="en_soins">En soins</option>

</select>

<select name="provenance">

<option value="cursage">Cursage</option>
<option value="partenaire">Partenaire</option>

</select>

<input
type="file"
name="photo"

>

</div>

<br>

<div class="check">

<input
type="checkbox"
name="vacciné"
{{ $chien->vacciné ? 'checked' : '' }}

>

<label>Vacciné</label>

</div>

<br>

<div class="check">

<input
type="checkbox"
name="dresse"
{{ $chien->dresse ? 'checked' : '' }}

>

<label>Dressé</label>

</div>

<br>

<textarea
name="notes"
placeholder="Notes"
>{{ old('notes',$chien->notes) }}</textarea>

<button class="btn">
Mettre à jour
</button>

</form>

</div>

</body>
</html>
