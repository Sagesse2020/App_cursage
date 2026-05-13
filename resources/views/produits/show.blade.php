<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Détail publication</title>

<style>
body{
background:#020617;
font-family:Segoe UI;
color:white;
}

.container{
max-width:1000px;
margin:50px auto;
background:#111827;
padding:35px;
border-radius:24px;
}

.image img{
width:100%;
max-height:500px;
object-fit:contain;
background:#0f172a;
padding:20px;
border-radius:20px;
}

h1{
margin-top:20px;
font-size:38px;
}

.price{
font-size:32px;
margin:20px 0;
color:#00e6ff;
font-weight:bold;
}

.meta{
margin-bottom:10px;
color:#94a3b8;
}

.back{
display:inline-block;
margin-top:30px;
padding:12px 20px;
background:#2563eb;
color:white;
text-decoration:none;
border-radius:14px;
}
</style>
</head>

<body>

        <h1>{{ $produit->nom }}</h1>

<img src="{{ asset('storage/'.$produit->photo) }}" width="300">

<p>{{ $produit->description }}</p>

<p>Prix vente : {{ $produit->prix_vente }}</p>

<p>Créé par : {{ $produit->user->name ?? 'Cursage' }}</p>

</body>
</html>