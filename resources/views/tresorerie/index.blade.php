<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Trésorerie CURSAGE</title>

<link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
* { margin:0; padding:0; box-sizing:border-box; font-family: "Segoe UI", Tahoma; }
body { background:#0b1020; color:#f5f6fa; min-height:100vh; display:flex; flex-direction:column; }

/* NAVBAR */
nav { display:flex; justify-content:space-between; padding:15px 30px; background:#020617; }
.logo { width:180px; }
nav ul { display:flex; list-style:none; gap:15px; }
nav ul li a { padding:8px 12px; border-radius:6px; display:flex; align-items:center; }
nav ul li a:hover { background:#00e6ff20; color:#00e6ff; }

/* HEADER */
.admin-header { padding:60px 30px; text-align:center; }
.admin-header h1 { color:#00e6ff; font-size:40px; }

/* CARDS */
.cards { display:grid; grid-template-columns:repeat(auto-fit,minmax(250px,1fr)); gap:25px; padding:40px; }
.card { background:#111827; padding:25px; border-radius:15px; text-align:center; }

/* TABLE */
table { width:100%; border-collapse:collapse; margin-top:30px; }
th, td { padding:12px; }
th { background:#1f2937; }
tr:nth-child(even){ background:#1e293b; }
</style>
</head>

<body>

<nav>
<img src="{{ asset('logo_chorale.png') }}" class="logo">

<ul>
<li><a href="{{ route('admin') }}"><i class="fas fa-home"></i> Admin</a></li>
<li><a href="{{ route('tresorerie.index') }}"><i class="fas fa-coins"></i> Trésorerie</a></li>
<li><a href="{{ route('journal.index') }}"><i class="fas fa-book"></i> Journal</a></li>
<li><a href="{{ route('gestion.index') }}"><i class="fas fa-cogs"></i> Gestion</a></li>
<li><a href="{{ route('profil') }}"><i class="fas fa-user"></i> Profil</a></li>
</ul>
</nav>

<section class="admin-header">
<h1>Trésorerie CURSAGE</h1>
<p>Suivi financier global</p>
</section>

<!-- CARTES -->
<section class="cards">

<div class="card">
<i class="fas fa-wallet"></i>
<h3>Solde actuel</h3>
<p>{{ number_format($solde,0,',',' ') }} FCFA</p>
</div>

<div class="card">
<i class="fas fa-arrow-down"></i>
<h3>Total Entrées</h3>
<p>{{ number_format($totalEntrees,0,',',' ') }} FCFA</p>
</div>

<div class="card">
<i class="fas fa-arrow-up"></i>
<h3>Total Sorties</h3>
<p>{{ number_format($totalSorties,0,',',' ') }} FCFA</p>
</div>

</section>

<!-- GRAPHIQUE -->
<div style="padding:40px;">
<canvas id="soldeChart"></canvas>
</div>

<!-- TABLEAU -->
<div style="padding:40px;">
<table>
<thead>
<tr>
<th>Date</th>
<th>Type</th>
<th>Montant</th>
<th>Description</th>
</tr>
</thead>

<tbody>
@foreach($transactions as $t)
<tr>
<td>{{ $t->date_transaction->format('d/m/Y') }}</td>

<td>
@if(in_array($t->type,['paiement_client','versement_cursage']))
Entrée
@else
Sortie
@endif
</td>

<td>{{ number_format($t->montant,0,',',' ') }} FCFA</td>
<td>{{ $t->notes }}</td>

</tr>
@endforeach
</tbody>
</table>
</div>

<footer style="text-align:center; padding:20px;">
<p>© 2026 CURSAGE</p>
</footer>

<script>
const ctx = document.getElementById('soldeChart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($labels) !!},
        datasets: [{
            label: 'Solde',
            data: {!! json_encode($cumulData) !!},
            borderColor:'#00e6ff',
            backgroundColor:'rgba(0,230,255,0.2)',
            tension:0.4,
            fill:true
        }]
    }
});
</script>*
</body>
</html>
