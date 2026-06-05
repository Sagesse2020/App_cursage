<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier reservation</title>

<style>
body{
    font-family: Arial;
    background:#0f172a;
    color:white;
    padding:20px;
}

.form{
    max-width:500px;
    margin:auto;
    background:#111827;
    padding:20px;
    border-radius:12px;
}

input, select, textarea{
    width:100%;
    padding:10px;
    margin-bottom:10px;
    border-radius:8px;
}

img{
    width:100%;
    border-radius:10px;
    margin-bottom:10px;
}
</style>
</head>

<body>

<div class="form">

<h1>✏️ Modifier réservation</h1>

<form method="POST" action="{{ route('reservations.update',$reservation) }}">
@csrf
@method('PUT')

<select name="chien_id">
@foreach($chiens as $chien)
<option value="{{ $chien->id }}"
{{ $reservation->chien_id == $chien->id ? 'selected' : '' }}>
{{ $chien->nom }}
</option>
@endforeach
</select>

<input type="text" name="client_nom" value="{{ old('client_nom',$reservation->client_nom) }}">
<input type="text" name="client_contact" value="{{ old('client_contact',$reservation->client_contact) }}">

<input type="date" name="date_reservation" value="{{ old('date_reservation',$reservation->date_reservation) }}">

<select name="statut">
<option value="attente" {{ $reservation->statut=='attente'?'selected':'' }}>Attente</option>
<option value="confirmee" {{ $reservation->statut=='confirmee'?'selected':'' }}>Confirmée</option>
<option value="annulee" {{ $reservation->statut=='annulee'?'selected':'' }}>Annulée</option>
</select>

<input type="number" name="montant_verse" value="{{ old('montant_verse',$reservation->montant_verse) }}">

<textarea name="note">{{ old('note',$reservation->note) }}</textarea>

<button>Modifier</button>

</form>

</div>

</body>
</html>