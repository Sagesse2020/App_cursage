<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Services CURSAGE</title>

<link rel="stylesheet"
href="{{ asset('fontawesome/css/all.min.css') }}">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}

body{
background:#0f172a;
color:white;
padding:25px;
}

.header{
display:flex;
justify-content:space-between;
align-items:center;
flex-wrap:wrap;
margin-bottom:25px;
gap:15px;
}

.header h1{
color:#00e6ff;
font-size:32px;
}

.add-btn{
background:#00e6ff;
color:#0f172a;
padding:12px 18px;
border-radius:10px;
text-decoration:none;
font-weight:bold;
}

.stats{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
gap:20px;
margin-bottom:30px;
}

.stat-card{
background:#111827;
padding:25px;
border-radius:20px;
text-align:center;
box-shadow:0 10px 25px rgba(0,0,0,.25);
}

.stat-card i{
font-size:35px;
color:#00e6ff;
margin-bottom:10px;
}

.stat-card h2{
font-size:30px;
}

.filters{
background:#111827;
padding:20px;
border-radius:20px;
display:flex;
gap:15px;
flex-wrap:wrap;
margin-bottom:25px;
}

.filters input,
.filters select{
padding:12px;
border:none;
border-radius:10px;
background:#1e293b;
color:white;
flex:1;
min-width:200px;
}

.filters button{
padding:12px 18px;
background:#00e6ff;
border:none;
border-radius:10px;
font-weight:bold;
cursor:pointer;
}

.table-container{
overflow-x:auto;
background:#111827;
border-radius:20px;
padding:15px;
}

table{
width:100%;
border-collapse:collapse;
}

th{
background:#1e293b;
padding:15px;
text-align:left;
}

td{
padding:15px;
border-bottom:1px solid #1e293b;
}

tr:hover{
background:#172036;
}

.badge{
padding:6px 12px;
border-radius:20px;
font-size:13px;
font-weight:bold;
}

.active{
background:#14532d;
color:#4ade80;
}

.inactive{
background:#7f1d1d;
color:#f87171;
}

.actions{
display:flex;
gap:8px;
flex-wrap:wrap;
}

.btn{
padding:8px 12px;
border:none;
border-radius:8px;
cursor:pointer;
text-decoration:none;
font-size:13px;
font-weight:bold;
color:white;
}

.show{
background:#2563eb;
}

.edit{
background:#f59e0b;
}

.delete{
background:#dc2626;
}

.create{
background:#10b981;
}

.pagination-container{
margin-top:25px;
}

.alert-success{
background:#14532d;
color:#4ade80;
padding:15px;
border-radius:10px;
margin-bottom:20px;
}

@media(max-width:768px){

.header{
flex-direction:column;
align-items:flex-start;
}

.filters{
flex-direction:column;
}

.actions{
flex-direction:column;
}

table{
font-size:13px;
}

}

</style>

</head>

<body>

@if(session('success'))
<div class="alert-success">
    {{ session('success') }}
</div>
@endif

<div class="header">

<h1>
<i class="fas fa-tools"></i>
Gestion des Services
</h1>

@if(auth()->user()->niveau_admin == 3)

<a href="{{ route('services.create') }}"
class="add-btn">
<i class="fas fa-plus"></i>
Nouveau service
</a>

@endif

</div>

<div class="stats">

<div class="stat-card">
<i class="fas fa-tools"></i>
<h2>{{ $total }}</h2>
<p>Services disponibles</p>
</div>

<div class="stat-card">
<i class="fas fa-check-circle"></i>
<h2>{{ $actifs }}</h2>
<p>Services actifs</p>
</div>

<div class="stat-card">
<i class="fas fa-times-circle"></i>
<h2>{{ $inactifs }}</h2>
<p>Services inactifs</p>
</div>

</div>

<form method="GET" class="filters">

<input
type="text"
name="search"
placeholder="🔍 Rechercher un service..."
value="{{ request('search') }}">

<select name="statut">

<option value="">
Tous les statuts
</option>

<option value="en_cours"
{{ request('statut') == 'en_cours' ? 'selected' : '' }}>
Actif
</option>

<option value="termine"
{{ request('statut') == 'termine' ? 'selected' : '' }}>
Inactif
</option>

</select>

<button type="submit">
<i class="fas fa-search"></i>
Filtrer
</button>

</form>

<div class="table-container">

<table>

<thead>

<tr>
<th>Nom</th>
<th>Description</th>
<th>Tarif</th>
<th>Statut</th>
<th>Actions</th>
</tr>

</thead>

<tbody>

@forelse($services as $service)

<tr>

<td>
<strong>{{ $service->nom }}</strong>
</td>

<td>
{{ \Illuminate\Support\Str::limit($service->description,80) }}
</td>

<td>
{{ number_format($service->prix_vente,0,',',' ') }}
FCFA
</td>

<td>

@if($service->statut == 'en_cours')

<span class="badge active">
Actif
</span>

@else

<span class="badge inactive">
Inactif
</span>

@endif

</td>

<td>

<div class="actions">

<a href="{{ route('services.show',$service->id) }}"
class="btn show">
<i class="fas fa-eye"></i>
Voir
</a>

@if(auth()->user()->niveau_admin >= 2)

<a href="{{ route('services.edit',$service->id) }}"
class="btn edit">
<i class="fas fa-edit"></i>
Modifier
</a>

<form method="POST"
action="{{ route('services.destroy',$service->id) }}"
style="display:inline;"
onsubmit="return confirm('Voulez-vous vraiment supprimer ce service ?');">

@csrf
@method('DELETE')

<button type="submit" class="btn delete">
<i class="fas fa-trash"></i>
Supprimer
</button>

</form>

@endif

</div>

</td>

</tr>

@empty

<tr>

<td colspan="5"
style="text-align:center;padding:30px;">
Aucun service trouvé.
</td>

</tr>

@endforelse

</tbody>

</table>

</div>

@if($services->hasPages())

<div class="pagination-container">
{{ $services->links() }}
</div>

@endif

</body>
</html>