<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Commande</title>

<style>

body{
    margin:0;
    font-family:Arial;
    background:#0f172a;
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
}

.card{
    width:100%;
    max-width:600px;
    background:#fff;
    padding:25px;
    border-radius:12px;
}

h2{
    text-align:center;
    color:#0f172a;
}

.info{
    background:#e0f2fe;
    padding:10px;
    margin-bottom:15px;
    border-radius:8px;
    color:#075985;
}

label{
    display:block;
    margin-top:10px;
    font-weight:bold;
}

input,select{
    width:100%;
    padding:10px;
    margin-top:5px;
    border-radius:8px;
    border:1px solid #ccc;
}

button{
    width:100%;
    margin-top:20px;
    padding:12px;
    background:#2563eb;
    color:#fff;
    border:none;
    border-radius:8px;
    cursor:pointer;
}

button:hover{
    background:#1d4ed8;
}

</style>

</head>

<body>

<div class="card">

<h2>🛒 Passer une commande</h2>

<div class="info">
Choisissez un produit et validez votre commande
</div>

<form method="POST" action="{{ route('commandes.store') }}">
@csrf

<label>Produit</label>
<select name="produit_id" required>
    <option value="">-- Sélectionner --</option>
    @foreach($produits as $produit)
        <option value="{{ $produit->id }}">
            {{ $produit->nom }} ({{ $produit->prix_vente }} FCFA)
        </option>
    @endforeach
</select>

<label>Quantité</label>
<input type="number" name="quantite" min="1" value="1" required>

<label>Mode paiement</label>
<select name="mode_paiement">
    <option value="cash">Cash</option>
    <option value="mobile_money">Mobile Money</option>
</select>

<button>Valider la commande</button>

</form>

</div>

</body>
</html>