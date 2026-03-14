<!DOCTYPE html>
<html>
<head>
<title>Créer facture</title>

<style>

body{
font-family:Arial;
background:#f5f6fa;
}

.container{
width:600px;
margin:auto;
margin-top:40px;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

input,select{
width:100%;
padding:10px;
margin-top:8px;
margin-bottom:20px;
border:1px solid #ccc;
border-radius:6px;
}

button{
background:#00e6ff;
border:none;
padding:12px;
width:100%;
border-radius:6px;
font-weight:bold;
}

</style>
</head>

<body>

<div class="container">

<h2>Nouvelle facture</h2>

<form method="POST" action="{{ route('factures.store') }}">

@csrf

<label>Client</label>
<select name="client_id">

@foreach($clients as $client)
<option value="{{ $client->id }}">
{{ $client->nom }}
</option>
@endforeach

</select>


<label>Vente</label>
<select name="vente_id">

<option value="">Aucune</option>

@foreach($ventes as $vente)
<option value="{{ $vente->id }}">
Vente #{{ $vente->id }}
</option>
@endforeach

</select>


<label>Date facture</label>
<input type="date" name="date">


<label>Total (CFA)</label>
<input type="number" name="total">


<label>Statut</label>
<select name="statut">

<option value="brouillon">Brouillon</option>
<option value="envoyee">Envoyée</option>
<option value="payee">Payée</option>

</select>

<button type="submit">
Enregistrer une facture
</button>

</form>

</div>

</body>
</html>
