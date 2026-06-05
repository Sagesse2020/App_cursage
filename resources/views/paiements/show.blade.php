<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Détail paiement</title>

<style>

body{
    font-family:Arial;
    background:#0f172a;
    color:white;
    padding:20px;
}

.card{
    max-width:700px;
    margin:auto;
    background:#111827;
    padding:25px;
    border-radius:12px;
}

.info{
    margin-bottom:15px;
}

strong{
    color:#00e6ff;
}

.btn{
    display:inline-block;
    margin-top:20px;
    padding:10px 15px;
    background:#2563eb;
    color:white;
    text-decoration:none;
    border-radius:8px;
}

</style>

</head>
<body>

<div class="card">
<h2>Détails Paiement #{{ $paiement->id }}</h2>

<p>Montant : {{ $paiement->montant }}</p>
<p>Type : {{ $paiement->type }}</p>
<p>Mode : {{ $paiement->mode_paiement }}</p>
<p>Statut : {{ $paiement->statut }}</p>
<p>Date : {{ $paiement->date_paiement }}</p>

<hr>

<p>Réservation : {{ $paiement->reservation?->id }}</p>
<p>Vente : {{ $paiement->vente?->id }}</p>
<p>Commande : {{ $paiement->commande?->id }}</p>
<p>Facture : {{ $paiement->facture?->id }}</p>
<p>Achat : {{ $paiement->achat?->id }}</p>
</div>

</body>
</html>