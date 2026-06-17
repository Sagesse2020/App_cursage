<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Ventes CURSAGE</title>

<link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:"Segoe UI",sans-serif
}

body{
background:#0b1020;
color:#f5f6fa;
min-height:100vh;
display:flex;
flex-direction:column
}

.container{
padding:40px;
max-width:1400px;
margin:auto;
width:100%
}

.header{
margin-bottom:30px
}

.header h1{
font-size:32px;
color:#00e6ff
}

.btn{
display:inline-flex;
align-items:center;
gap:8px;
background:#00e6ff;
color:#000;
padding:10px 16px;
border-radius:8px;
font-weight:600;
text-decoration:none;
transition:.2s
}

.btn:hover{
transform:scale(1.05)
}

.table-box{
background:#111827;
border-radius:10px;
overflow:hidden;
box-shadow:0 10px 25px rgba(0,0,0,.5)
}

table{
width:100%;
border-collapse:collapse
}

thead{
background:#020617
}

th{
padding:14px;
text-align:left;
color:#00e6ff;
font-size:14px
}

td{
padding:14px;
border-bottom:1px solid #1f2937;
font-size:14px
}

tr:hover{
background:#1f2937
}

.amount{
font-weight:600;
color:#22c55e
}

.actions{
display:flex;
gap:10px
}

.icon-btn{
padding:6px 6px;
border-radius:6px;
font-size:14px;
cursor:pointer;
border:none
}

.btn-view{
background:#22c55e;
color:white
}

.btn-edit{
background:#facc15;
color:black
}

.btn-delete{
background:#ef4444;
color:white
}

footer{
margin-top:auto;
text-align:center;
padding:20px;
background:#020617;
color:#94a3b8
}

@media(max-width:900px){

table{
font-size:12px
}

}

</style>

</head>

<body>

<div class="container">

<div class="header">

<h1>Gestion des ventes</h1>

<br>

<a href="{{ route('ventes.create') }}" class="btn">
<i class="fas fa-plus"></i> Nouvelle vente
</a>

</div>


<div class="table-box">

<table>

<thead>

<tr>
<th>Chien</th>
<th>Client</th>
<th>Prix</th>
<th>Date</th>
<th>Actions</th>
</tr>

</thead>

<tbody>

@foreach($ventes as $vente)

<tr>

<td>{{ $vente->chien->nom }}</td>

<td>{{ $vente->client->nom }}</td>

<td class="amount">
{{ number_format($vente->prix_vente,0,',',' ') }} FCFA
</td>

<td>
{{ \Carbon\Carbon::parse($vente->date_vente)->format('d/m/Y') }}
</td>

<td>

<div class="actions">
@if(auth()->user()->niveau_admin == 2 || auth()->user()->niveau_admin == 3)

<a href="{{ route('ventes.edit',$vente->id) }}">

<button class="icon-btn btn-edit">

</button>

</a>

<form method="POST" action="{{ route('ventes.destroy',$vente->id) }}" style="display:inline;" "
      onsubmit="return confirm('Voulez-vous vraiment supprimer cette vente ?');">

@csrf
@method('DELETE')

<button class="icon-btn btn-delete">

<i class="fas fa-trash"></i>

</button>

</form>

@endif

<a href="{{ route('ventes.show',$vente->id) }}">
<button class="icon-btn btn-view">
<i class="fas fa-eye"></i>
</button>

</a>

</div>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

<footer>

© {{ date('Y') }} CURSAGE

</footer>

</body>
</html>
