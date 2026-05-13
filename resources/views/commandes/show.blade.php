<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>{{ $evenement->titre }}</title>

<style>
body{
    font-family:Segoe UI;
    background:#0f172a;
    margin:0;
    color:#e2e8f0;
}

.container{
    max-width:900px;
    margin:40px auto;
    background:#111827;
    padding:25px;
    border-radius:16px;
}

img{
    width:100%;
    height:320px;
    object-fit:cover;
    border-radius:12px;
}

h1{margin-top:15px}

p{color:#cbd5e1;line-height:1.6}

.back{
    display:inline-block;
    margin-top:15px;
    background:#2563eb;
    color:white;
    padding:10px 15px;
    border-radius:8px;
    text-decoration:none;
}

/* COMMENTAIRES */
.comment-box{
    margin-top:30px;
    background:#0b1220;
    padding:15px;
    border-radius:12px;
}

.comment{
    padding:10px;
    border-bottom:1px solid #1f2937;
}

.comment b{color:#60a5fa}

/* FORM */
textarea{
    width:100%;
    height:90px;
    padding:10px;
    border-radius:8px;
    border:none;
    margin-top:10px;
}

button{
    background:#22c55e;
    border:none;
    padding:10px 15px;
    margin-top:10px;
    border-radius:8px;
    cursor:pointer;
}

@media(max-width:600px){
    .container{margin:10px;padding:15px}
}
</style>
</head>

<body>

<div class="container">

<h2>{{ $commande->produit_nom }}</h2>

<p>Quantité: {{ $commande->quantite }}</p>
<p>Total: {{ $commande->montant_total }}</p>
<p>Paiement: {{ $commande->mode_paiement }}</p>
<p>Statut: {{ $commande->statut }}</p>

</div>
</body>
</html>