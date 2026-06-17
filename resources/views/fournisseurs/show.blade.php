<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Détails employé</title>

<style>

body{
    background:#f1f5f9;
    font-family:Arial;
    padding:40px;
}

.card{
    max-width:900px;
    margin:auto;
    background:white;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.1);
}

.banner img{
    width:100%;
    height:350px;
    object-fit:contain;
}

.content{
    padding:35px;
}

h1{
    margin-bottom:20px;
}

.info{
    margin-bottom:15px;
    font-size:17px;
}

.badge{
    display:inline-block;
    padding:8px 14px;
    background:#dcfce7;
    color:#166534;
    border-radius:30px;
}

</style>

</head>

<body>

<div class="card">

<div class="banner">

@if($employee->photo)

<img
src="{{ asset('storage/'.$employee->photo) }}"
>

@endif

</div>

<div class="content">

<h1>
{{ $employee->nom }}
{{ $employee->prenom }}
</h1>

<div class="info">
📞 Téléphone :
{{ $employee->telephone }}
</div>

<div class="info">
📧 Email :
{{ $employee->email }}
</div>

<div class="info">
💼 Poste :
{{ $employee->poste }}
</div>

<div class="info">
💰 Salaire :
{{ number_format($employee->salaire,0,',',' ') }} FCFA
</div>

<div class="info">
📅 Embauché le :
{{ $employee->date_embauche }}
</div>

<div class="info">
📍 Adresse :
{{ $employee->adresse }}
</div>

<div class="info">
<span class="badge">
{{ $employee->statut }}
</span>
</div>

</div>

</div>

</body>
</html>