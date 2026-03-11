<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Liste des factures</title>
<style>
.container{
padding:40px;
}

.stats{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
gap:20px;
margin-bottom:30px;
}

.box{
background:#111827;
padding:20px;
border-radius:10px;
}

.solde{
background:#00e6ff;
color:#000;
}

table{
width:100%;
border-collapse:collapse;
}

th,td{
padding:12px;
border-bottom:1px solid #333;
}

.btn{
background:#00e6ff;
padding:10px 15px;
border-radius:6px;
}

@media(max-width:768px){
table{
font-size:12px;
}
}
</style>
</head>
<body>

<div class="container">

<h2>Gestion des factures</h2>

<a href="{{ route('factures.create') }}" class="btn">
Nouvelle facture
</a>

<table class="table">

<tr>
<th>ID</th>
<th>Vente</th>
<th>Type</th>
<th>Actions</th>
</tr>

@foreach($factures as $facture)

<tr>

<td>{{ $facture->id }}</td>

<td>{{ $facture->vente->id ?? '-' }}</td>

<td>{{ $facture->type }}</td>

<td>

<a href="{{ route('factures.edit',$facture->id) }}">Modifier</a>

<form method="POST" action="{{ route('factures.destroy',$facture->id) }}">
@csrf
@method('DELETE')
<button>Supprimer</button>
</form>

</td>

</tr>

@endforeach

</table>

</div>

</body>
</html>
