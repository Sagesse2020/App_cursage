<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>{{ $chien->nom }}</title>

<style>

body{
font-family:'Segoe UI',sans-serif;
background:#eef2f5;
margin:0;
padding:40px;
}

/* container principal */

.container{
max-width:900px;
margin:auto;
background:#fff;
border-radius:14px;
box-shadow:0 15px 35px rgba(0,0,0,.1);
overflow:hidden;
display:grid;
grid-template-columns:350px 1fr;
}

/* image */

.image{
width:100%;
height:100%;
}

.image img{
width:100%;
height:100%;
object-fit:cover;
display:block;
}

/* contenu */

.content{
padding:30px;
}

.content h1{
margin-top:0;
font-size:28px;
margin-bottom:10px;
}

.info{
margin-bottom:10px;
font-size:15px;
color:#555;
}

/* bloc prix */

.price-box{
margin-top:20px;
background:#f7f7f7;
padding:15px;
border-radius:8px;
}

.price{
display:flex;
justify-content:space-between;
margin-bottom:8px;
font-weight:500;
}

/* statut */

.status{
margin-top:15px;
padding:6px 12px;
background:#16a34a;
color:#fff;
display:inline-block;
border-radius:6px;
font-size:14px;
}

/* notes */

.notes{
margin-top:20px;
color:#555;
line-height:1.6;
}

/* bouton retour */

.back{
display:inline-block;
margin-top:25px;
background:#111827;
color:#fff;
padding:10px 18px;
border-radius:6px;
text-decoration:none;
transition:.2s;
}

.back:hover{
background:#374151;
}

/* RESPONSIVE */

@media(max-width:768px){

.container{
grid-template-columns:1fr;
}

.image{
height:280px;
}

.content{
padding:20px;
}

}

</style>
</head>

<body>

<div class="container">

<div class="image">
<img src="{{ asset('storage/'.$chien->photo) }}" alt="{{ $chien->nom }}">
</div>

<div class="content">

<h1>{{ $chien->nom }}</h1>

<div class="info">
<strong>Race :</strong> {{ $chien->race->nom ?? 'Race inconnue' }}
</div>

<div class="info">
<strong>Partenaire :</strong> {{ $chien->partenaire->nom ?? 'Aucun partenaire' }}
</div>

<div class="info">
<strong>Age :</strong> {{ $chien->age ?? 'Age inconnu' }}
</div>

<div class="price-box">

<div class="price">
<span>Prix de base</span>
<span>{{ number_format($chien->prix_base,0,',',' ') }} FCFA</span>
</div>

<div class="price">
<span>Prix avec vaccin</span>
<span>{{ number_format($chien->prix_vaccine,0,',',' ') }} FCFA</span>
</div>

<div class="price">
<span>Prix dressage</span>
<span>{{ number_format($chien->prix_dressage,0,',',' ') }} FCFA</span>
</div>

</div>

<div class="status">
Statut : {{ $chien->statut }}
</div>

<div class="notes">
{{ $chien->notes }}
</div>

<a href="{{ route('chiens.index') }}" class="back">
← Retour à la liste
</a>

</div>

</div>

</body>
</html>
