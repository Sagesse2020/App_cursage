<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Graphique financier</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{
    margin:0;
    font-family:Segoe UI;
    background:#0b1220;
    color:white;
    padding:25px;
}

h1{
    margin-bottom:20px;
}

/* ================= STATS ================= */

.stats{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
    gap:15px;
    margin-bottom:25px;
}

.card{
    background:#111827;
    padding:20px;
    border-radius:15px;
}

.card h3{
    font-size:14px;
    color:#94a3b8;
}

.card p{
    font-size:22px;
    font-weight:bold;
}

/* ================= CHART ================= */

.chart-box{
    background:#111827;
    padding:20px;
    border-radius:15px;
    margin-bottom:25px;
}

/* ================= TABLE ================= */

table{
    width:100%;
    border-collapse:collapse;
    background:#111827;
    border-radius:15px;
    overflow:hidden;
}

th,td{
    padding:12px;
    border-bottom:1px solid #1f2937;
}

th{
    background:#0f172a;
    color:#94a3b8;
}

tr:hover{
    background:#1f2937;
}

.badge{
    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
}

.credit{
    background:#16a34a;
}

.debit{
    background:#dc2626;
}

</style>
</head>

<body>

<h1>📊 Graphique financier </h1>

<!-- ================= STATS ================= -->
<div class="stats">

<div class="card">
<h3>Recettes</h3>
<p>{{ number_format($recettes,0,',',' ') }} FCFA</p>
</div>

<div class="card">
<h3>Charges</h3>
<div>Transactions : {{ number_format($chargesTransactions,0,',',' ') }} FCFA</div>

<div>Dépenses : {{ number_format($depenses,0,',',' ') }} FCFA</div>

<div>Salaires : {{ number_format($salaires,0,',',' ') }} FCFA</div>

<div>Charges totales : {{ number_format($charges,0,',',' ') }} FCFA</div>
</div>

<div class="card">
<h3>Pertes</h3>
<p>{{ number_format($pertes,0,',',' ') }} FCFA</p>
</div>

<div class="card">
<h3>Bénéfice</h3>
<p>{{ number_format($benefice,0,',',' ') }} FCFA</p>
</div>

</div>

<!-- ================= GRAPH ================= -->
<div class="chart-box">
<canvas id="chart"></canvas>
</div>

<!-- ================= TABLE ================= -->
<h2>📋 Dernières transactions</h2>

<table>
<tr>
<th>Date</th>
<th>Montant</th>
<th>Type</th>
<th>Utilisateur</th>
</tr>

@foreach($transactions as $t)
<tr>
<td>{{ $t->date_transaction }}</td>
<td>{{ number_format($t->montant,0,',',' ') }}</td>
<td>{{ $t->type }}</td>
<td>{{ $t->user->name ?? 'SYSTEME' }}</td>
</tr>
@endforeach

</table>

<script>

const ctx = document.getElementById('chart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($labels),
        datasets: [{
            label: 'Transactions mensuelles',
            data: @json($donnees),
            borderColor: '#00e6ff',
            backgroundColor: 'rgba(0,230,255,0.1)',
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                labels: { color: 'white' }
            }
        },
        scales: {
            x: { ticks: { color: 'white' } },
            y: { ticks: { color: 'white' } }
        }
    }
});

</script>

</body>
</html>