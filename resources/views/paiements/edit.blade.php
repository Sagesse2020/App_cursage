<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier paiement</title>
</head>

<body>

<div class="form">

<h2>Modifier Paiement</h2>

<form method="POST" action="{{ route('paiements.update', $paiement) }}">
@csrf
@method('PUT')

<input type="number" name="montant" value="{{ $paiement->montant }}"><br>

<select name="type">
    <option value="reservation" @selected($paiement->type=='reservation')>Réservation</option>
    <option value="vente" @selected($paiement->type=='vente')>Vente</option>
    <option value="commande" @selected($paiement->type=='commande')>Commande</option>
    <option value="facture" @selected($paiement->type=='facture')>Facture</option>
    <option value="achat" @selected($paiement->type=='achat')>Achat</option>
</select><br>

<select name="mode_paiement">
    @foreach(['especes','mobile_money','virement','carte_bancaire','cheque'] as $m)
        <option value="{{ $m }}" @selected($paiement->mode_paiement==$m)>
            {{ $m }}
        </option>
    @endforeach
</select><br>

<select name="statut">
    @foreach(['paye','partiel','en_attente','annule'] as $s)
        <option value="{{ $s }}" @selected($paiement->statut==$s)>
            {{ $s }}
        </option>
    @endforeach
</select><br>

<input type="date" name="date_paiement" value="{{ $paiement->date_paiement }}"><br>

<button type="submit">Mettre à jour</button>

</div>

</body>
</html>