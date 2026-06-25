<!DOCTYPE html>

<html lang="fr">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Détails partenaire</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
font-family:'Segoe UI',sans-serif;
background:#f1f5f9;
padding:30px;
}

.container{
max-width:1000px;
margin:auto;
background:white;
border-radius:25px;
overflow:hidden;
box-shadow:0 10px 35px rgba(0,0,0,.08);
}

.header{
background:linear-gradient(135deg,#2563eb,#1d4ed8);
padding:30px;
color:white;
text-align:center;
}

.header h1{
font-size:35px;
}

.content{
padding:35px;
display:grid;
grid-template-columns:350px 1fr;
gap:30px;
}

.photo-box{
background:#e2e8f0;
border-radius:20px;
overflow:hidden;
height:400px;
}

.photo-box img{
width:100%;
height:100%;
object-fit:cover;
}

.info-box{
display:grid;
gap:15px;
}

.info{
background:#f8fafc;
padding:15px;
border-radius:12px;
font-size:16px;
}

.label{
font-weight:bold;
color:#2563eb;
}

.badge{
display:inline-block;
padding:8px 15px;
border-radius:30px;
font-size:13px;
font-weight:bold;
margin-top:10px;
}

.actif{
background:#dcfce7;
color:#166534;
}

.suspendu{
background:#fee2e2;
color:#991b1b;
}

.inactif{
background:#e2e8f0;
color:#334155;
}

.actions{
margin-top:25px;
display:flex;
gap:15px;
flex-wrap:wrap;
}

.btn{
background:#2563eb;
color:white;
padding:12px 18px;
border-radius:12px;
text-decoration:none;
font-weight:bold;
}

.btn:hover{
background:#1d4ed8;
}

.btn-dark{
background:#0f172a;
}

.btn-dark:hover{
background:#020617;
}

@media(max-width:768px){

.content{
grid-template-columns:1fr;
}

.photo-box{
height:300px;
}

}

</style>

</head>

<body>

<div class="container">

<div class="header">
<h1>🤝 Fiche partenaire</h1>
</div>

<div class="content">

<div class="photo-box">

@if($partenaire->photo)

<img src="{{ asset('storage/'.$partenaire->photo) }}">

@else

<img src="{{ asset('default-user.png') }}">

@endif

</div>

<div class="info-box">

<div class="info">
<span class="label">Nom :</span>
{{ $partenaire->nom }}
</div>

<div class="info">
<span class="label">Prénom :</span>
{{ $partenaire->prenom }}
</div>

<div class="info">
<span class="label">Téléphone :</span>
{{ $partenaire->telephone }}
</div>

<div class="info">
<span class="label">Email :</span>
{{ $partenaire->email }}
</div>

<div class="info">
<span class="label">Entreprise :</span>
{{ $partenaire->entreprise }}
</div>

<div class="info">
<span class="label">Type :</span>

@if($partenaire->type_partenaire == 'vendeur')
Partenaire vendeur
@else
Apporteur d'affaires
@endif

</div>

<div class="info">
<span class="label">Commission :</span>
{{ $partenaire->commission }} %
</div>

<div class="info">
<span class="label">Adresse :</span>
{{ $partenaire->adresse }}
</div>

<div>

<span class="badge {{ $partenaire->statut }}">
{{ $partenaire->statut }}
</span>

</div>

<div class="actions">

<a
href="{{ route('partenaires.index') }}"
class="btn-dark btn">
Retour </a>

@if(auth()->user()->niveau_admin >= 2)

<a
href="{{ route('partenaires.edit',$partenaire) }}"
class="btn">
Modifier </a>

@endif

</div>

</div>

</div>

</div>

</body>
</html>
