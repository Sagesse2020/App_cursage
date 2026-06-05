<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Pertes</title>

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

.card{
    background:#111827;
    padding:15px;
    border-radius:10px;
    margin-bottom:15px;
}

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
    text-align:left;
}

th{
    background:#111827;
}

.badge{
    padding:5px 10px;
    border-radius:20px;
    background:#dc2626;
    color:white;
    font-size:12px;
}
</style>
</head>

<body>

<div class="header">
<h1>📉 Pertes enregistrées</h1>
</div>

<div class="card">
<strong>Total pertes :</strong> {{ number_format($total_pertes,0,',',' ') }} FCFA
</div>

<table>
<tr>
<th>Date</th>
<th>Motif</th>
<th>Montant</th>
<th>Utilisateur</th>
</tr>

@foreach($pertes as $perte)
<tr>
<td>{{ $perte->created_at }}</td>
<td>{{ $perte->motif }}</td>
<td><span class="badge">{{ $perte->montant }} FCFA</span></td>
<td>{{ $perte->user->name ?? 'SYSTEME' }}</td>
</tr>
@endforeach

</table>

</body>
</html>