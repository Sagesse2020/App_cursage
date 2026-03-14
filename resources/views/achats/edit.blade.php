<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Nouvelle vente</title>

<link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

<style>

body{
background:#0b1020;
color:white;
font-family:Segoe UI;
padding:40px
}

.form-container{
max-width:600px;
margin:auto;
background:#111827;
padding:30px;
border-radius:10px
}

input,select{
width:100%;
padding:10px;
margin-top:10px;
margin-bottom:20px;
border-radius:6px;
border:none
}

button{
background:#00e6ff;
padding:12px;
border:none;
border-radius:6px;
font-weight:bold;
cursor:pointer
}

</style>

</head>

<body>

<div class="form-container">

<h2>Nouvelle vente</h2>

<form method="POST" action="{{ route('ventes.store') }}">

@csrf

<label>Chien</label>

<select name="chien_id" required>

@foreach($chiens as $chien)

<option value="{{ $chien->id }}">

{{ $chien->nom }}

</option>

@endforeach

</select>


<label>Client</label>

<select name="client_id" required>

@foreach($clients as $client)

<option value="{{ $client->id }}">

{{ $client->nom }}

</option>

@endforeach

</select>


<label>Prix de vente (FCFA)</label>

<input type="number" name="prix_vente" required>


<label>Date de vente</label>

<input type="date" name="date_vente" required>


<label>Commission partenaire</label>

<input type="number" name="commission_partenaire">


<label>Commission CURSAGE</label>

<input type="number" name="commission_cursage">


<button>

<i class="fas fa-save"></i>

Enregistrer

</button>

</form>

</div>

</body>
</html>
