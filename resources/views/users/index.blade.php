<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Gestion des utilisateurs | CURSAGE</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{

background:#182433;
color:white;
padding:40px;

}

.container{

max-width:1500px;
margin:auto;

}






/**************************
HEADER
**************************/

.page-header{

display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:30px;
flex-wrap:wrap;
gap:20px;

}

.page-title h1{

font-size:32px;
font-weight:700;

}

.page-title p{

color:#aeb8c4;
margin-top:8px;

}






/**************************
BOUTONS
**************************/

.btn{

padding:11px 22px;
border:none;
border-radius:8px;
cursor:pointer;
font-weight:600;
transition:.25s;

}

.btn:hover{

transform:translateY(-2px);

}

.btn-primary{

background:#00d4ff;
color:#182433;

}

.btn-primary:hover{

background:#00bfe6;

}

.btn-success{

background:#2ecc71;
color:white;

}

.btn-danger{

background:#e74c3c;
color:white;

}

.btn-warning{

background:#f39c12;
color:white;

}






/**************************
CARDS
**************************/

.card{

background:#243447;
border-radius:15px;
padding:25px;
box-shadow:0 10px 30px rgba(0,0,0,.25);

}






/**************************
STATISTIQUES
**************************/

.stats{

display:grid;
grid-template-columns:repeat(4,1fr);
gap:20px;
margin-bottom:30px;

}

.stat-card{

background:#243447;
padding:25px;
border-radius:15px;

}

.stat-card h3{

font-size:14px;
color:#b5bec9;
margin-bottom:10px;

}

.stat-card span{

font-size:28px;
font-weight:bold;

}






/**************************
RECHERCHE
**************************/

.search-bar{

display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:20px;
gap:15px;
flex-wrap:wrap;

}

.search-bar input{

width:320px;
padding:12px;
border:none;
border-radius:8px;
background:#182433;
color:white;

}

.search-bar input:focus{

outline:2px solid #00d4ff;

}






/**************************
TABLEAU
**************************/

.table-responsive{

overflow-x:auto;

}

table{

width:100%;
border-collapse:collapse;

}

thead{

background:#00d4ff;
color:#182433;

}

th{

padding:16px;
text-align:left;
font-size:14px;

}

td{

padding:15px;
border-bottom:1px solid rgba(255,255,255,.06);

}

tbody tr{

transition:.25s;

}

tbody tr:hover{

background:#2b3d53;

}






/**************************
BADGES
**************************/

.badge{

padding:5px 12px;
border-radius:50px;
font-size:12px;
font-weight:600;

}

.badge-user{

background:#7f8c8d;

}

.badge-admin{

background:#3498db;

}

.badge-super{

background:#8e44ad;

}

.badge-level1{

background:#2ecc71;

}

.badge-level2{

background:#f39c12;

}

.badge-level3{

background:#e74c3c;

}






/**************************
PARTENAIRE
**************************/

.partner{

display:flex;
flex-direction:column;

}

.partner strong{

font-size:14px;

}

.partner small{

color:#b8c1ca;

}






/**************************
ACTIONS
**************************/

.actions{

display:flex;
gap:8px;

}

.actions a,
.actions button{

padding:8px 14px;
border:none;
border-radius:6px;
cursor:pointer;
font-weight:600;
transition:.2s;

}

.btn-edit{

background:#00d4ff;
color:#182433;

}

.btn-delete{

background:#e74c3c;
color:white;

}

.actions a:hover,
.actions button:hover{

transform:scale(1.05);

}






/**************************
ALERTES
**************************/

.alert{

padding:15px;
margin-bottom:20px;
border-radius:10px;

}

.success{

background:#2ecc71;

}

.error{

background:#e74c3c;

}






/**************************
RESPONSIVE
**************************/

@media(max-width:1000px){

.stats{

grid-template-columns:repeat(2,1fr);

}

}

@media(max-width:650px){

.stats{

grid-template-columns:1fr;

}

.page-header{

flex-direction:column;
align-items:flex-start;

}

.search-bar{

flex-direction:column;
align-items:flex-start;

}

.search-bar input{

width:100%;

}

}

</style>

</head>

<body>

<div class="container">

<div class="page-header">

<div class="page-title">

<h1>
👥 Gestion des utilisateurs
</h1>

<p>

Administration des comptes utilisateurs de CURSAGE

</p>

</div>

<div>

<a href="{{ route('users.create') }}" class="btn btn-primary">

➕ Nouvel utilisateur

</a>

</div>

</div>

@if(session('success'))

<div class="alert success">

{{ session('success') }}

</div>

@endif

@if(session('error'))

<div class="alert error">

{{ session('error') }}

</div>

@endif

<!-- Cartes statistiques -->

<div class="stats">

<div class="stat-card">

<h3>Total utilisateurs</h3>

<span>{{ $users->count() }}</span>

</div>

<div class="stat-card">

<h3>Administrateurs</h3>

<span>{{ $users->where('role','admin')->count() }}</span>

</div>

<div class="stat-card">

<h3>Utilisateurs</h3>

<span>{{ $users->where('role','user')->count() }}</span>

</div>

<div class="stat-card">

<h3>Partenaires</h3>

<span>{{ $users->whereNotNull('partenaire_id')->count() }}</span>

</div>

</div>

<div class="card">

<div class="search-bar">

<input

type="text"

id="search"

placeholder="🔍 Rechercher un utilisateur..."

>

</div>

<div class="table-responsive">

<table>

<thead>

<tr>

<th>ID</th>

<th>Utilisateur</th>

<th>Email</th>

<th>Rôle</th>

<th>Niveau</th>

<th>Partenaire</th>

<th>Actions</th>

</tr>

</thead>

<tbody>

@forelse($users as $user)

<tr>

    <td>{{ $user->id }}</td>

    <td>{{ $user->name }}</td>

    <td>{{ $user->email }}</td>

    <td>{{ $user->role }}</td>

    <td>{{ $user->niveau_admin }}</td>

    <td>

        @if($user->partenaire)

            {{ $user->partenaire->nom }}

        @else

            Aucun partenaire

        @endif

    </td>
<td>

<div class="actions">

<a
href="{{ route('users.edit',$user->id) }}"
class="btn-edit">

✏ Modifier

</a>

@if(Auth::id() != $user->id)

<form
action="{{ route('users.destroy',$user->id) }}"
method="POST"
onsubmit="return confirm('Supprimer cet utilisateur ?')">

@csrf

@method('DELETE')

<button
class="btn-delete">

🗑 Supprimer

</button>

</form>

@endif

</div>

</td>

</tr>

@empty

<tr>

    <td colspan="7">

        Aucun utilisateur trouvé

    </td>

</tr>

@endforelse

</tbody>
</table>

</div>

</div>

</div>
<script>

const search=document.getElementById('search');

search.addEventListener('keyup',function(){

let value=this.value.toLowerCase();

let rows=document.querySelectorAll("tbody tr");

rows.forEach(function(row){

row.style.display=row.innerText.toLowerCase().includes(value)

? ""

: "none";

});

});

</script>
</body>

</html>