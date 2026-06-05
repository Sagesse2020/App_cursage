<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Détails du chien</title>

<style>

body{
font-family:Segoe UI;
background:#f1f5f9;
padding:20px;
}

.container{
max-width:1200px;
margin:auto;
}

.card{
background:white;
border-radius:15px;
padding:25px;
box-shadow:0 3px 10px rgba(0,0,0,.08);
}

.header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:20px;
}

.btn{
background:#2563eb;
color:white;
padding:10px 15px;
border-radius:8px;
text-decoration:none;
border:none;
}

.photo{
width:300px;
height:300px;
object-fit:cover;
border-radius:15px;
margin-bottom:20px;
}

.grid{
display:grid;
grid-template-columns:
repeat(auto-fit,minmax(300px,1fr));
gap:15px;
}

.item{
background:#f8fafc;
padding:15px;
border-radius:10px;
}

.label{
font-weight:bold;
color:#0f172a;
margin-bottom:5px;
}

.value{
color:#475569;
}

.badge{
padding:6px 12px;
border-radius:20px;
color:white;
font-size:12px;
display:inline-block;
}

.disponible{
background:#16a34a;
}

.reserve{
background:#f59e0b;
}

.vendu{
background:#dc2626;
}

.en_soins{
background:#2563eb;
}

@media(max-width:768px){

.photo{
width:100%;
height:auto;
}

}

</style>
</head>

<body>

<div class="container">

<div class="header">

<h1>🐕 Détails du chien</h1>

<div>

<a
href="{{ route('chiens.index') }}"
class="btn">
Retour
</a>

<a
href="{{ route('chiens.edit',$chien) }}"
class="btn">
Modifier
</a>

</div>

</div>

<div class="card">

@if($chien->photo)

<img
src="{{ asset('storage/'.$chien->photo) }}"
class="photo">

@endif

<div class="grid">

<div class="item">
<div class="label">Référence</div>
<div class="value">{{ $chien->reference }}</div>
</div>

<div class="item">
<div class="label">Nom</div>
<div class="value">{{ $chien->nom }}</div>
</div>

<div class="item">
<div class="label">Race</div>
<div class="value">{{ $chien->race->nom ?? '-' }}</div>
</div>

<div class="item">
<div class="label">Sexe</div>
<div class="value">{{ ucfirst($chien->sexe) }}</div>
</div>

<div class="item">
<div class="label">Age</div>
<div class="value">{{ $chien->age }}</div>
</div>

<div class="item">
<div class="label">Date naissance</div>
<div class="value">{{ $chien->date_naissance }}</div>
</div>

<div class="item">
<div class="label">Poids</div>
<div class="value">{{ $chien->poids }} Kg</div>
</div>

<div class="item">
<div class="label">Couleur</div>
<div class="value">{{ $chien->couleur }}</div>
</div>

<div class="item">
<div class="label">Numéro puce</div>
<div class="value">{{ $chien->numero_puce }}</div>
</div>

<div class="item">
<div class="label">Numéro pedigree</div>
<div class="value">{{ $chien->numero_pedigree }}</div>
</div>

<div class="item">
<div class="label">Vacciné</div>
<div class="value">
{{ $chien->vacciné ? 'Oui' : 'Non' }}
</div>
</div>

<div class="item">
<div class="label">Dressé</div>
<div class="value">
{{ $chien->dresse ? 'Oui' : 'Non' }}
</div>
</div>

<div class="item">
<div class="label">Statut</div>

<span class="badge {{ $chien->statut }}">
{{ $chien->statut }}
</span>

</div>

<div class="item">
<div class="label">Provenance</div>
<div class="value">{{ $chien->provenance }}</div>
</div>

<div class="item">
<div class="label">Prix base</div>
<div class="value">

{{ number_format($chien->prix_base,0,',',' ') }}

FCFA

</div>
</div>

<div class="item">
<div class="label">Prix vacciné</div>
<div class="value">

{{ number_format($chien->prix_vaccine,0,',',' ') }}

FCFA

</div>
</div>

<div class="item">
<div class="label">Prix dressage</div>
<div class="value">

{{ number_format($chien->prix_dressage,0,',',' ') }}

FCFA

</div>
</div>

</div>

<br>

<div class="item">

<div class="label">Notes</div>

<div class="value">

{{ $chien->notes }}

</div>

</div>

</div>

</div>

</body>
</html>