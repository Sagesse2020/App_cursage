<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Transactions financières</title>

<link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:"Segoe UI",Tahoma,sans-serif
}

body{
background:#0b1020;
color:#f5f6fa;
min-height:100vh;
}

.container{
max-width:1400px;
margin:auto;
padding:40px;
}

h1{
font-size:32px;
margin-bottom:25px;
color:#00e6ff
}

/* statistiques */

.stats{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(230px,1fr));
gap:20px;
margin-bottom:35px;
}

.box{
background:#111827;
padding:25px;
border-radius:10px;
box-shadow:0 8px 20px rgba(0,0,0,.5);
transition:.2s
}

.box:hover{
transform:translateY(-3px)
}

.box h3{
font-size:16px;
margin-bottom:8px;
color:#94a3b8
}

.box p{
font-size:24px;
font-weight:bold
}

.entrees{
border-left:5px solid #22c55e
}

.sorties{
border-left:5px solid #ef4444
}

.solde{
background:#00e6ff;
color:#000
}

/* bouton */

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
margin-bottom:25px;
transition:.2s
}

.btn:hover{
transform:scale(1.05)
}

/* tableau */

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
padding:15px;
text-align:left;
font-size:14px;
color:#00e6ff
}

td{
padding:15px;
border-bottom:1px solid #1f2937;
font-size:14px
}

tr:hover{
background:#1f2937
}

/* montant */

.amount{
font-weight:bold
}

.entree{
color:#22c55e
}

.sortie{
color:#ef4444
}

/* actions */

.actions{
display:flex;
gap:10px
}

.icon-btn{
border:none;
padding:8px 10px;
border-radius:6px;
cursor:pointer;
font-size:14px
}

.btn-edit{
background:#facc15;
color:#000
}

.btn-delete{
background:#ef4444;
color:#fff
}

.btn-edit:hover{
background:#eab308
}

.btn-delete:hover{
background:#dc2626
}

/* responsive */

@media(max-width:768px){

table{
font-size:12px
}

.stats{
grid-template-columns:1fr
}

}

</style>

</head>

<body>

<div class="container">

<h1><i class="fas fa-wallet"></i> Transactions financières</h1>

<!-- statistiques -->

<div class="stats">

<div class="box entrees">
<h3>Entrées</h3>
<p>{{ number_format($entrees,0,',',' ') }} FCFA</p>
</div>

<div class="box sorties">
<h3>Sorties</h3>
<p>{{ number_format($sorties,0,',',' ') }} FCFA</p>
</div>

<div class="box solde">
<h3>Solde actuel</h3>
<p>{{ number_format($solde,0,',',' ') }} FCFA</p>
</div>

</div>

<a href="{{ route('transactions.create') }}" class="btn">
<i class="fas fa-plus"></i> Nouvelle transaction
</a>

<div class="table-box">

<table>

<thead>

<tr>
<th>Date</th>
<th>Type</th>
<th>Montant</th>
<th>Destinataire</th>
<th>Utilisateur</th>
<th>Actions</th>
</tr>

</thead>

<tbody>

@foreach($transactions as $transaction)

<tr>

<td>
{{ \Carbon\Carbon::parse($transaction->date_transaction)->format('d/m/Y') }}
</td>

<td>

@if($transaction->type == 'entree')

<span style="color:#22c55e">
<i class="fas fa-arrow-down"></i> Entrée
</span>

@else

<span style="color:#ef4444">
<i class="fas fa-arrow-up"></i> Sortie
</span>

@endif

</td>

<td class="amount {{ $transaction->type == 'entree' ? 'entree' : 'sortie' }}">

{{ number_format($transaction->montant,0,',',' ') }} FCFA

</td>

<td>{{ $transaction->destinataire }}</td>

<td>{{ $transaction->user->name ?? '' }}</td>

<td>

<div class="actions">
@if(auth()->id() === $transaction->user_id || auth()->user()->niveau_admin == 3)
    <a href="{{ route('transactions.edit',$transaction) }}">

<button class="icon-btn btn-edit">

<i class="fas fa-edit"></i>

</button>

</a>

<form action="{{ route('transactions.destroy',$transaction) }}" method="POST" style="display:inline;" "
      onsubmit="return confirm('Voulez-vous vraiment supprimer cet transaction ?');">

@csrf
@method('DELETE')

<button class="icon-btn btn-delete">

<i class="fas fa-trash"></i>

</button>

</form>
@endif

</div>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

</body>
</html>
