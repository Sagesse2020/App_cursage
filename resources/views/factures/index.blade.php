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
 padding: 6px 12px;
    border-radius: 5px;
    text-decoration: none;
    color: white;
    background-color: #4CAF50; /* vert */
    font-size: 13px;
    transition: 0.3s;
}

@media(max-width:768px){
table{
font-size:12px;
}
}
</style>
</head>
<body>

<table class="table-pro">
   <h2>Gestion des factures</h2>
<thead>
<tr>
<th>N°</th>
<th>Date</th>
<th>Client</th>
<th>Total</th>
<th>Statut</th>
<th>Action</th>
</tr>
</thead>

<tbody>

@foreach($factures as $facture)

<tr>

<td>{{ $facture->numero }}</td>

<td>{{ $facture->date->format('d/m/Y') }}</td>

<td>{{ $facture->client->nom ?? '-' }}</td>

<td>{{ number_format($facture->total,0,',',' ') }} CFA</td>

<td>{{ $facture->statut }}</td>

<td>

<a href="{{ route('factures.show',$facture->id)}}" class="btn">
Voir
</a>

@if(auth()->id() === $facture->user_id || auth()->user()->niveau == 3)

<a href="{{ route('factures.edit',$facture->id) }}" class="btn">
Modifier
</a>

<a href="{{ route('factures.destroy',$facture->id) }}" class="btn">
supprimer
</a>

<a href="{{ route('factures.create') }}" class="btn">
+ Nouvelle facture
</a>

<a href="{{ route('factures.print',$facture->id)}}" class="btn">
Imprimer
</a>

@endif

</td>

</tr>

@endforeach

</tbody>

</table>
</table>
</body>
</html>
