<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Commandes</title>

<style>
body{
    font-family:Segoe UI;
    background:#0f172a;
    color:white;
    margin:0;
}

.container{
    max-width:1000px;
    margin:auto;
    padding:30px;
}

.card{
    background:#111827;
    padding:15px;
    margin-bottom:10px;
    border-radius:12px;
}

.btn{
    background:#3b82f6;
    padding:6px 10px;
    border-radius:6px;
    color:white;
    text-decoration:none;
}
</style>
</head>

<body>

<div class="container">

<h2>🛒 Liste des commandes</h2>

@foreach($commandes as $c)
<div class="card">
    <h4>{{ $c->produit_nom }}</h4>
    <p>Quantité: {{ $c->quantite }}</p>
    <p>Total: {{ $c->montant_total }} FCFA</p>
    <p>Statut: {{ $c->statut }}</p>

     
@if(auth()->id() === $c->user_id || auth()->user()->niveau == 3)

<a href="{{ route('commandes.edit',$c->id) }}" class="btn">
Modifier
</a>

<a href="{{ route('commandes.destroy',$c->id) }}" class="btn">
supprimer
</a>

<a href="{{ route('commandes.create') }}" class="btn">
+ Nouvelle commande
</a>
@endif

    <a class="btn" href="{{ route('commandes.show',$c->id) }}">Voir</a>
</div>
@endforeach

</div>

</body>
</html>