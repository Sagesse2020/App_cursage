<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Passer une commande</title>
<style>
body{font-family:'Segoe UI',sans-serif;background:#f4f6f8;padding:40px;}
form{max-width:600px;margin:auto;background:#fff;padding:30px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,.1);}
label{display:block;margin-top:15px;font-weight:600;}
input,textarea{width:100%;padding:10px;margin-top:6px;border-radius:6px;border:1px solid #ccc;}
button{margin-top:20px;background:#0a7;color:#fff;border:none;padding:12px;width:100%;border-radius:6px;cursor:pointer;}
</style>
</head>
<body>
<div style="max-width:700px;margin:auto;background:#0f172a;color:white;padding:20px;border-radius:12px">

<h2>🛒 Passer une commande</h2>

<form method="POST" action="{{ route('commandes.store') }}">
@csrf

<label>Produit</label>
<input type="text" name="produit_nom" value="{{ $produit->nom ?? '' }}" required>

<label>Prix unitaire</label>
<input type="number" name="prix_unitaire" value="{{ $produit->prix ?? 0 }}" required>

<label>Quantité</label>
<input type="number" name="quantite" min="1" value="1">

<label>Mode paiement</label>
<select name="mode_paiement">
    <option value="cash">Cash</option>
    <option value="mobile_money">Mobile Money</option>
</select>

<button type="submit">Valider commande</button>

</form>

</div>
</body>
</html>
