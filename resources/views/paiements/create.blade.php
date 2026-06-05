<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Nouveau paiement</title>

<style>

body{
    font-family:Arial;
    background:#0f172a;
    color:white;
    padding:20px;
}

.form{
    max-width:700px;
    margin:auto;
    background:#111827;
    padding:25px;
    border-radius:12px;
}

input,
select,
textarea{
    width:100%;
    padding:10px;
    margin-bottom:12px;
    border:none;
    border-radius:8px;
}

button{
    background:#00e6ff;
    color:#0f172a;
    border:none;
    padding:12px;
    width:100%;
    border-radius:8px;
    font-weight:bold;
}

</style>

</head>
<body>

<div class="form">

<h1>💰 Nouveau paiement</h1>

<form
action="{{ route('paiements.store') }}"
method="POST">

@csrf

<input type="number" name="montant" placeholder="Montant"><br>

<select name="type">
    <option value="">Type</option>
    <option value="reservation">Réservation</option>
    <option value="vente">Vente</option>
    <option value="commande">Commande</option>
    <option value="facture">Facture</option>
    <option value="achat">Achat</option>
</select><br>

<select name="mode_paiement">
    <option value="">Mode paiement</option>
    <option value="especes">Espèces</option>
    <option value="mobile_money">Mobile Money</option>
    <option value="virement">Virement</option>
    <option value="carte_bancaire">Carte bancaire</option>
    <option value="cheque">Chèque</option>
</select><br>

<select name="statut">
    <option value="paye">Payé</option>
    <option value="partiel">Partiel</option>
    <option value="en_attente">En attente</option>
    <option value="annule">Annulé</option>
</select><br>

<input type="date" name="date_paiement"><br>

<h4>Réservation</h4>
<select name="reservation_id">
    <option value="">Aucune</option>
    @foreach($reservations as $r)
        <option value="{{ $r->id }}">#{{ $r->id }}</option>
    @endforeach
</select>

<h4>Vente</h4>
<select name="vente_id">
    <option value="">Aucune</option>
    @foreach($ventes as $v)
        <option value="{{ $v->id }}">#{{ $v->id }}</option>
    @endforeach
</select>

<h4>Commande</h4>
<select name="commande_id">
    <option value="">Aucune</option>
    @foreach($commandes as $c)
        <option value="{{ $c->id }}">#{{ $c->id }}</option>
    @endforeach
</select>

<h4>Facture</h4>
<select name="facture_id">
    <option value="">Aucune</option>
    @foreach($factures as $f)
        <option value="{{ $f->id }}">#{{ $f->id }}</option>
    @endforeach
</select>

<h4>Achat</h4>
<select name="achat_id">
    <option value="">Aucune</option>
    @foreach($achats as $a)
        <option value="{{ $a->id }}">#{{ $a->id }}</option>
    @endforeach
</select>

<br><br>

<button type="submit">Enregistrer</button>

</form>

</div>

</body>
</html>