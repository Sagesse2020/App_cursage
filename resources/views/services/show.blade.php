<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Détail service</title>
<style>
body{font-family:Segoe UI;background:#f4f6f8;padding:40px}
.box{
    max-width:900px;
    margin:auto;
    background:#fff;
    border-radius:18px;
    padding:30px;
    box-shadow:0 15px 30px rgba(0,0,0,.1);
}
img{width:100%;border-radius:14px;margin-bottom:20px}
small{color:#777}
</style>
</head>
<body>

<div class="box">
    <h1> Details du service </h1>
    <p>Service : {{  $service->nom }}</p> 
    <p>Description : {{ $service->description }}</p>
    <p>Tarifs : {{ number_format($service->prix_vente, 0, ',', ' ') }}</p> 
    <p>Statut du service : {{ $service->statut }}</p>
</div>

</body>
</html>
