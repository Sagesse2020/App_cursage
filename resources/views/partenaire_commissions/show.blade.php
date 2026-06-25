<!DOCTYPE html>

<html lang="fr">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Détails commmission partenaire </title>

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
<h1>

💰 Commission partenaire

</h1>

<div class="ligne">

<strong>Partenaire :</strong>

{{ $partenaireCommission->partenaire->nom }}

</div>

<div class="ligne">

<strong>Produit :</strong>

{{ $partenaireCommission->produit?->nom }}

</div>

<div class="ligne">

<strong>Chien :</strong>

{{ $partenaireCommission->chien?->nom }}

</div>

<div class="ligne">

<strong>Pourcentage :</strong>

{{ $partenaireCommission->pourcentage }} %

</div>

<div class="ligne">

<strong>Montant fixe :</strong>

{{ number_format(
$partenaireCommission->montant_fixe,
0,
',',
' '
) }}

FCFA

</div>

<div class="ligne">

<strong>Date début :</strong>

{{ $partenaireCommission->date_debut }}

</div>

<div class="ligne">

<strong>Date fin :</strong>

{{ $partenaireCommission->date_fin }}

</div>

</div>

</body>
</html>
