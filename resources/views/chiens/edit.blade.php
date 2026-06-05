<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Modifier un chien</title>

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
grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
gap:15px;
}

input,
select,
textarea{
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

img{
width:250px;
height:250px;
object-fit:cover;
border-radius:15px;
margin-bottom:20px;
}

</style>

</head>

<body>

<div class="container">

<h1>✏️ Modifier un chien</h1>

@if($chien->photo)
<img src="{{ asset('storage/'.$chien->photo) }}">
@endif

@if ($errors->any())
<div style="background:red;color:white;padding:15px;border-radius:10px;margin-bottom:15px;">
<ul>
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<form action="{{ route('chiens.update',$chien) }}" method="POST" enctype="multipart/form-data">

@csrf
@method('PUT')

<div class="grid">

<input type="text" name="nom" value="{{ old('nom',$chien->nom) }}" placeholder="Nom du chien">

<select name="race_id">
<option value="">Choisir une race</option>
@foreach($races as $race)
<option value="{{ $race->id }}" {{ $chien->race_id == $race->id ? 'selected' : '' }}>
{{ $race->nom }}
</option>
@endforeach
</select>

<select name="partenaire_id">
<option value="">Aucun partenaire</option>
@foreach($partenaires as $partenaire)
<option value="{{ $partenaire->id }}" {{ $chien->partenaire_id == $partenaire->id ? 'selected' : '' }}>
{{ $partenaire->nom }}
</option>
@endforeach
</select>

<input type="text" name="age" value="{{ old('age',$chien->age) }}" placeholder="Age">

<select name="sexe">
<option value="male" {{ $chien->sexe == 'male' ? 'selected' : '' }}>Mâle</option>
<option value="femelle" {{ $chien->sexe == 'femelle' ? 'selected' : '' }}>Femelle</option>
</select>

<input type="date" name="date_naissance" value="{{ old('date_naissance',$chien->date_naissance) }}">

<input type="date" name="date_arrive" value="{{ old('date_arrive',$chien->date_arrive) }}">

<input type="number" step="0.01" name="poids" value="{{ old('poids',$chien->poids) }}" placeholder="Poids">

<input type="text" name="couleur" value="{{ old('couleur',$chien->couleur) }}" placeholder="Couleur">

<input type="text" name="numero_puce" value="{{ old('numero_puce',$chien->numero_puce) }}" placeholder="Numéro puce">

<input type="text" name="numero_pedigree" value="{{ old('numero_pedigree',$chien->numero_pedigree) }}" placeholder="Numéro pedigree">

<input type="number" step="0.01" name="prix_base" value="{{ old('prix_base',$chien->prix_base) }}" placeholder="Prix base">

<input type="number" step="0.01" name="prix_vaccine" value="{{ old('prix_vaccine',$chien->prix_vaccine) }}" placeholder="Prix vacciné">

<input type="number" step="0.01" name="prix_dressage" value="{{ old('prix_dressage',$chien->prix_dressage) }}" placeholder="Prix dressage">

<select name="statut">
<option value="disponible" {{ $chien->statut=='disponible'?'selected':'' }}>Disponible</option>
<option value="reserve" {{ $chien->statut=='reserve'?'selected':'' }}>Réservé</option>
<option value="vendu" {{ $chien->statut=='vendu'?'selected':'' }}>Vendu</option>
<option value="en_soins" {{ $chien->statut=='en_soins'?'selected':'' }}>En soins</option>
</select>

<select name="provenance">
<option value="cursage" {{ $chien->provenance=='cursage'?'selected':'' }}>Cursage</option>
<option value="partenaire" {{ $chien->provenance=='partenaire'?'selected':'' }}>Partenaire</option>
</select>

<input type="file" name="photo">

</div>

<br>

<div class="check">
<input type="checkbox" name="vacciné" {{ $chien->vacciné ? 'checked' : '' }}>
<label>Vacciné</label>
</div>

<br>

<div class="check">
<input type="checkbox" name="dresse" {{ $chien->dresse ? 'checked' : '' }}>
<label>Dressé</label>
</div>

<br>

<textarea name="notes" placeholder="Notes">{{ old('notes',$chien->notes) }}</textarea>

<br><br>

<button class="btn">Mettre à jour</button>

</form>

</div>

</body>
</html>