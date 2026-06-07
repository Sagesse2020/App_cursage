<!DOCTYPE html>

<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Détail Réservation</title>

<style>

body{
    font-family:"Segoe UI";
    background:#0f172a;
    color:white;
    padding:30px;
}

.card{
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

.info{
    margin-bottom:15px;
    padding:15px;
    background:#1e293b;
    border-radius:10px;
}

.label{
    color:#94a3b8;
    font-size:14px;
}

.value{
    margin-top:5px;
    font-size:18px;
    font-weight:600;
}

.back{
    display:inline-block;
    margin-top:20px;
    background:#00e6ff;
    color:black;
    text-decoration:none;
    padding:10px 15px;
    border-radius:10px;
    font-weight:bold;
}

</style>

</head>
<body>

<div class="card">

<h1>📅 Détail Réservation</h1>

<div class="info">
<div class="label">Client</div>
<div class="value">
{{ $reservation->client->nom ?? '-' }}
</div>
</div>

<div class="info">
<div class="label">Chien</div>
<div class="value">
{{ $reservation->chien->nom ?? '-' }}
</div>
</div>

<div class="info">
<div class="label">Date réservation</div>
<div class="value">
{{ $reservation->date_reservation }}
</div>
</div>

<div class="info">
<div class="label">Statut</div>
<div class="value">
{{ $reservation->statut }}
</div>
</div>

<div class="info">
<div class="label">Montant avancé</div>
<div class="value">
{{ number_format($reservation->montant_avance,0,',',' ') }} FCFA
</div>
</div>

<div class="info">
<div class="label">Reste à payer</div>
<div class="value">
{{ number_format($reservation->reste_a_payer,0,',',' ') }} FCFA
</div>
</div>

<div class="info">
<div class="label">Créée par</div>
<div class="value">
{{ $reservation->user->name ?? '-' }}
</div>
</div>

<a href="{{ route('reservations.index') }}" class="back">
← Retour
</a>

</div>

</body>
</html>
