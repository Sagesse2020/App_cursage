<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Détail salaire</title>

<style>
body{font-family:'Segoe UI';background:#f1f5f9;padding:25px;}
.container{max-width:700px;margin:auto;background:white;padding:30px;border-radius:15px;}
.card{background:#f8fafc;padding:15px;margin-bottom:10px;border-radius:10px;}
.amount{font-size:22px;color:#2563eb;font-weight:bold;}
</style>
</head>

<body>

<div class="container">

<h1>💼 Salaire employé</h1>

<div class="card">Employé: {{ $salaire->employee->nom }}</div>

<div class="card">Mois: {{ $salaire->mois }}</div>

<div class="card">Base: {{ $salaire->salaire_base }}</div>

<div class="card">Prime: {{ $salaire->prime }}</div>

<div class="card">Retenue: {{ $salaire->retenue }}</div>

<div class="card amount">
Net: {{ number_format($salaire->montant_net,0,',',' ') }} FCFA
</div>

<div class="card">Statut: {{ $salaire->statut }}</div>

</div>

</body>
</html>