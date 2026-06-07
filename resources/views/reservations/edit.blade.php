<!DOCTYPE html>

<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier Réservation</title>

<style>

body{
    font-family:"Segoe UI";
    background:#0f172a;
    color:white;
    padding:30px;
}

.container{
    max-width:900px;
    margin:auto;
    background:#111827;
    padding:30px;
    border-radius:20px;
}

h1{
    color:#00e6ff;
    margin-bottom:25px;
}

.grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:15px;
}

label{
    display:block;
    margin-bottom:5px;
    color:#94a3b8;
}

input,
select{
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    background:#0f172a;
    color:white;
}

.btn{
    margin-top:20px;
    background:#00e6ff;
    color:black;
    border:none;
    padding:12px 20px;
    border-radius:10px;
    cursor:pointer;
    font-weight:bold;
}

.btn:hover{
    opacity:.9;
}

</style>

</head>
<body>

<div class="container">

<h1>✏ Modifier Réservation</h1>

<form method="POST" action="{{ route('reservations.update',$reservation->id) }}">
@csrf
@method('PUT')

<div class="grid">

<div>
<label>Client</label>
<select name="client_id">
@foreach($clients as $client)
<option value="{{ $client->id }}"
{{ $reservation->client_id == $client->id ? 'selected' : '' }}>
{{ $client->nom }}
</option>
@endforeach
</select>
</div>

<div>
<label>Chien</label>
<select name="chien_id">
@foreach($chiens as $chien)
<option value="{{ $chien->id }}"
{{ $reservation->chien_id == $chien->id ? 'selected' : '' }}>
{{ $chien->nom }}
</option>
@endforeach
</select>
</div>

<div>
<label>Date réservation</label>
<input
type="date"
name="date_reservation"
value="{{ $reservation->date_reservation }}">
</div>

<div>
<label>Statut</label>
<select name="statut">

<option value="en_attente"
{{ $reservation->statut == 'en_attente' ? 'selected' : '' }}>
En attente
</option>

<option value="confirmee"
{{ $reservation->statut == 'confirmee' ? 'selected' : '' }}>
Confirmée
</option>

<option value="annulee"
{{ $reservation->statut == 'annulee' ? 'selected' : '' }}>
Annulée
</option>

<option value="transformee_en_vente"
{{ $reservation->statut == 'transformee_en_vente' ? 'selected' : '' }}>
Transformée en vente
</option>

</select>
</div>

<div>
<label>Montant avancé</label>
<input
type="number"
step="0.01"
name="montant_avance"
value="{{ $reservation->montant_avance }}">
</div>

<div>
<label>Reste à payer</label>
<input
type="number"
step="0.01"
name="reste_a_payer"
value="{{ $reservation->reste_a_payer }}">
</div>

</div>

<button class="btn">
💾 Enregistrer
</button>

</form>

</div>

</body>
</html>
