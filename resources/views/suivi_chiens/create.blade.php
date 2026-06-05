<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Créer mouvement</title>

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

<h1>Nouveau mouvement stock</h1>

<form method="POST">
@csrf

<select name="produit_id">
@foreach($produits as $p)
<option value="{{ $p->id }}">{{ $p->nom }}</option>
@endforeach
</select>

<select name="type">
<option value="entree">Entrée</option>
<option value="sortie">Sortie</option>
</select>

<input type="number" name="quantite" placeholder="Quantité">
<input type="text" name="motif" placeholder="Motif">

<button>Enregistrer</button>
</form>
</div>

</body>
</html>