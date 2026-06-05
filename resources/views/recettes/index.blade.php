<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Recettes</title>

<style>
body{font-family:Arial;background:#f8fafc;padding:20px;}

.card{
display:inline-block;
background:white;
padding:20px;
margin:10px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,.1);
}

table{width:100%;background:white;border-collapse:collapse;margin-top:20px;}

th{background:#0f172a;color:white;padding:10px;}
td{padding:10px;border-bottom:1px solid #eee;}

.total{font-size:20px;font-weight:bold;color:#16a34a;}
</style>
</head>

<body>

<h1>💰 Recettes financières</h1>

<div class="card">Jour : <div class="total">{{ $totalJour }}</div></div>
<div class="card">Mois : <div class="total">{{ $totalMois }}</div></div>
<div class="card">Année : <div class="total">{{ $totalAnnee }}</div></div>

<table>
<tr>
<th>ID</th>
<th>Utilisateur</th>
<th>Montant</th>
<th>Type</th>
<th>Date</th>
</tr>

@foreach($recettes as $r)
<tr>
<td>{{ $r->id }}</td>
<td>{{ $r->user->name ?? '' }}</td>
<td>{{ $r->montant }}</td>
<td>{{ $r->type }}</td>
<td>{{ $r->created_at }}</td>
</tr>
@endforeach

</table>

{{ $recettes->links() }}

</body>
</html>