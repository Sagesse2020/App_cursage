<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>{{ $race->nom }}</title>

<style>
body{
    font-family:'Segoe UI',sans-serif;
    background:#eef2f5;
    padding:40px;
}
.container{
    max-width:900px;
    margin:auto;
    background:#fff;
    border-radius:16px;
    box-shadow:0 15px 40px rgba(0,0,0,.1);
    overflow:hidden;
}
.image{
    width:100%;
    height:320px;
}
.image img{
    width:100%;
    height:100%;
    object-fit:cover;
}
.content{
    padding:30px;
}
h1{margin-bottom:10px;}
p{line-height:1.6;color:#555;}
.back{
    display:inline-block;
    margin-top:20px;
    background:#111;
    color:#fff;
    padding:10px 18px;
    border-radius:6px;
    text-decoration:none;
}
</style>
</head>

<body>
<div class="container">

<div class="image">
    <img src="{{ $race->image ? asset('storage/'.$race->image) : asset('images/no-image.png') }}">
</div>

<div class="content">
    <h1>{{ $race->nom }}</h1>
    <strong>Origine :</strong> {{ $race->origine ?? '—' }}

    <p style="margin-top:15px;">
        {{ $race->description ?? 'Aucune description.' }}
    </p>

    <a href="{{ route('races.index') }}" class="back">← Retour</a>
</div>
</div>
</body>
</html>
