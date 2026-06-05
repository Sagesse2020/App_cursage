<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Bénéfices</title>

<style>
body{
    font-family: Arial;
    background:#0f172a;
    color:white;
    padding:20px;
}

.header{
    margin-bottom:20px;
}

.dashboard{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:15px;
    margin-bottom:20px;
}

.card{
    background:#111827;
    padding:15px;
    border-radius:10px;
    text-align:center;
}

.good{ color:#16a34a; font-size:22px; font-weight:bold; }
.bad{ color:#dc2626; font-size:22px; font-weight:bold; }
.info{ color:#3b82f6; font-size:22px; font-weight:bold; }

table{
    width:100%;
    border-collapse: collapse;
    background:#1f2937;
    border-radius:10px;
    overflow:hidden;
}

th, td{
    padding:12px;
    border-bottom:1px solid #374151;
}

th{
    background:#111827;
}
</style>
</head>

<body>

<div class="header">
<h1>📊 Bénéfices globaux</h1>
</div>

<div class="card">
Recettes
<br>
<div class="good">
{{ number_format($recettesTotal,0,',',' ') }} FCFA
</div>
</div>

<div class="card">
Dépenses
<br>
<div class="bad">
{{ number_format($depensesTotal,0,',',' ') }} FCFA
</div>
</div>

<div class="card">
Bénéfice
<br>
<div class="info">
{{ number_format($beneficeTotal,0,',',' ') }} FCFA
</div>
</div>
<table>

<tr>
<th>Période</th>
<th>Recettes</th>
<th>Dépenses</th>
<th>Bénéfice</th>
</tr>

@foreach($stats as $stat)

<tr>
<td>{{ $stat['periode'] }}</td>
<td>{{ number_format($stat['recettes'],0,',',' ') }}</td>
<td>{{ number_format($stat['depenses'],0,',',' ') }}</td>
<td>{{ number_format($stat['benefice'],0,',',' ') }}</td>
</tr>

@endforeach

</table>

</body>
</html>