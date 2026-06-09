<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Chiens</title>

<style>

body{
font-family:Segoe UI;
background:#f1f5f9;
padding:20px;
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
}

.filters{
background:white;
padding:15px;
border-radius:15px;
margin-bottom:20px;
display:grid;
grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
gap:10px;
}

input,select{
padding:10px;
border:1px solid #ddd;
border-radius:8px;
}

table{
width:100%;
background:white;
border-collapse:collapse;
border-radius:15px;
overflow:hidden;
}

th{
background:#0f172a;
color:white;
padding:12px;
}

td{
padding:12px;
border-bottom:1px solid #eee;
}

img{
width:90px;
height:90px;
object-fit:cover;
border-radius:10px;
}

.badge{
padding:6px 12px;
border-radius:20px;
color:white;
font-size:12px;
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

</style>
</head>
<body>

<div class="header">

<h1>🐕 Gestion des chiens</h1>

</div>

<form method="GET" class="filters">

<input
type="text"
name="search"
placeholder="Recherche..."
value="{{ request('search') }}"
>

<select name="race">

<option value="">
Toutes races
</option>

@foreach($races as $race)

<option
value="{{ $race->id }}"
{{ request('race')==$race->id ? 'selected':'' }}
>
{{ $race->nom }}
</option>

@endforeach

</select>

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

<select name="statut">

<option value="">
Statut
</option>

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

<option value="">
Provenance
</option>

<option value="cursage">
Cursage
</option>

<option value="partenaire">
Partenaire
</option>

</select>

<button class="btn">
Filtrer
</button>

</form>

<table>

<tr>

<th>Photo</th>
<th>Référence</th>
<th>Nom</th>
<th>Race</th>
<th>Sexe</th>
<th>Statut</th>
<th>Prix</th>
<th>Actions</th>

</tr>

@foreach($chiens as $chien)

<tr>

<td>

@if($chien->photo)

<img src="{{ asset('storage/'.$chien->photo) }}">

@endif

</td>

<td>
{{ $chien->reference }}
</td>

<td>
{{ $chien->nom }}
</td>

<td>
{{ $chien->race->nom ?? '' }}
</td>

<td>
{{ ucfirst($chien->sexe) }}
</td>

<td>

<span class="badge {{ $chien->statut }}">

{{ $chien->statut }}

</span>

</td>

<td>

{{ number_format($chien->prix_base,0,',',' ') }}

FCFA

</td>

<td>
 <a href="{{ route('chiens.show',$chien->id) }}" class="btn">
Voir
</a>

@if(auth()->id() === $chien->user_id || auth()->user()->niveau == 3)

<a href="{{ route('chiens.edit',$chien->id) }}" class="btn">
Modifier
</a>

<a href="{{ route('chiens.destroy',$chien->id) }}" class="btn">
supprimer
</a>

<a href="{{ route('chiens.create') }}" class="btn">
+ Nouveau chien
</a>

@endif

</td>

</tr>

@endforeach

</table>

<br>

{{ $chiens->links() }}

</body>
</html>