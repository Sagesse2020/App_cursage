<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Créer reservation</title>

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
    border:none;
}

button{
    background:#00e6ff;
    border:none;
    padding:10px;
    width:100%;
    font-weight:bold;
    border-radius:8px;
}
</style>
</head>

<body>

<div class="form">
<h1>📅 Ajouter réservation</h1>

<form method="POST" action="{{ route('reservations.store') }}">
@csrf

<select name="chien_id">
<option value="">Choisir chien</option>
@foreach($chiens as $chien)
<option value="{{ $chien->id }}">{{ $chien->nom }}</option>
@endforeach
</select>

<input type="text" name="client_nom" placeholder="Nom client">
<input type="text" name="client_contact" placeholder="Contact">

<input type="date" name="date_reservation">

<select name="statut">
<option value="attente">Attente</option>
<option value="confirmee">Confirmée</option>
<option value="annulee">Annulée</option>
</select>

<input type="number" name="montant_verse" placeholder="Montant versé">

<textarea name="note" placeholder="Note"></textarea>

<button>Enregistrer</button>

</form>
</div>

</body>
</html>