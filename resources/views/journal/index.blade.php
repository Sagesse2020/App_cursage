<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Journal CURSAGE</title>
<link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
* { margin:0; padding:0; box-sizing:border-box; font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif; }
body { background:#0b1020; color:#f5f6fa; min-height:100vh; display:flex; flex-direction:column; }
a { text-decoration:none; color:inherit; }

/* NAVBAR */
nav { display:flex; justify-content:space-between; align-items:center; padding:15px 30px; background:linear-gradient(90deg,#020617,#0f172a); box-shadow:0 4px 15px rgba(0,0,0,0.6); }
.logo { width:180px; max-height:70px; object-fit:contain; }
nav ul { display:flex; list-style:none; gap:14px; align-items:center; }
nav ul li a { padding:8px 12px; border-radius:6px; font-size:14px; font-weight:500; display:flex; align-items:center; transition:0.3s; }
nav ul li a i { margin-right:6px; color:#00e6ff; }
nav ul li a:hover { background: rgba(0,230,255,0.15); color:#00e6ff; }

/* HEADER */
.admin-header { background: linear-gradient(rgba(11,16,32,0.9), rgba(11,16,32,0.9)), url('https://images.unsplash.com/photo-1601933475589-dce5b8b53f42') center/cover; padding:60px 30px; text-align:center; }
.admin-header h1 { font-size:42px; font-weight:800; color:#00e6ff; margin-bottom:10px; }
.admin-header p { font-size:18px; color:#cbd5e1; }

/* DASHBOARD CARDS */
.dashboard { padding:50px 30px; }
.cards { display:grid; grid-template-columns:repeat(auto-fit,minmax(250px,1fr)); gap:25px; }
.card { background:#111827; padding:25px; border-radius:15px; box-shadow:0 10px 30px rgba(0,0,0,0.5); transition: transform 0.3s, box-shadow 0.3s; text-align:center; }
.card:hover { transform: translateY(-8px); box-shadow: 0 15px 35px rgba(0,0,0,0.6); }
.card i { font-size:36px; color:#00e6ff; margin-bottom:15px; }
.card h3 { font-size:20px; margin-bottom:10px; }
.card p { font-size:16px; color:#94a3b8; }

/* TABLEAU */
table { width:100%; border-collapse:collapse; margin-top:30px; background:#111827; border-radius:12px; overflow:hidden; }
th, td { padding:12px 15px; text-align:left; }
th { background:#1f2937; color:#00e6ff; }
tr:nth-child(even) { background:#1e293b; }
tr:hover { background:#0f172a; }

/* CHART */
#journalChart { margin-top:40px; background:#111827; padding:20px; border-radius:15px; }

/* FOOTER */
footer { margin-top:auto; background:#020617; padding:20px; text-align:center; color:#94a3b8; font-size:14px; }
.social-icons a { margin:0 10px; font-size:20px; color:#00e6ff; }
.social-icons a:hover { color:#00bcd4; }
</style>
</head>

<body>

<nav>
<img src="{{ asset('logo_chorale.png') }}" alt="Logo CURSAGE" class="logo">
<ul>
    <li><a href="{{ route('admin') }}"><i class="fas fa-home"></i>Admin</a></li>
    <li><a href="{{ route('profil') }}"><i class="fas fa-user"></i>Profil</a></li>
</ul>
</nav>

<section class="admin-header">
<h1>Journal CURSAGE</h1>
<p>Historique complet des écritures comptables</p>
</section>

<section class="dashboard">
<div class="cards">
</div>

<!-- Graphique -->
<canvas id="journalChart"></canvas>

<!-- Tableau des écritures -->
<h2 style="margin-top:40px; color:#00e6ff;">Détail des écritures</h2>
<table class="table-pro">
    <thead>
        <tr>
            <th>Date</th>
            <th>Compte</th>
            <th>Débit (CFA)</th>
            <th>Crédit (CFA)</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach($journal as $entry)
        <tr>
            <td>{{ $entry['date'] }}</td>
            <td>{{ $entry['compte'] }}</td>
            <td class="text-right">{{ number_format($entry['debit'], 0, ',', ' ') }}</td>
            <td class="text-right">{{ number_format($entry['credit'], 0, ',', ' ') }}</td>
            <td>{{ $entry['description'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</section>

<footer>
<div class="social-icons">
    <a href="#"><i class="fab fa-facebook"></i></a>
    <a href="#"><i class="fab fa-tiktok"></i></a>
    <a href="#"><i class="fab fa-whatsapp"></i></a>
    <a href="#"><i class="fab fa-youtube"></i></a>
</div>
<p>&copy; 2025 CURSAGE — Journal</p>
</footer>

<script>
const ctx3 = document.getElementById('journalChart').getContext('2d');
const journalChart = new Chart(ctx3, {
    type: 'line',
    data: {
        labels: [
            @foreach(\App\Models\Transaction::orderBy('created_at')->get() as $tx)
            '{{ $tx->created_at->format("d/m") }}',
            @endforeach
        ],
        datasets: [{
            label: 'Débit',
            data: [
                @foreach(\App\Models\Transaction::orderBy('created_at')->get() as $tx)
                {{ $tx->debit }},
                @endforeach
            ],
            borderColor:'#00e6ff',
            backgroundColor:'rgba(0,230,255,0.2)',
            tension:0.4,
            fill:true
        },{
            label: 'Crédit',
            data: [
                @foreach(\App\Models\Transaction::orderBy('created_at')->get() as $tx)
                {{ $tx->credit }},
                @endforeach
            ],
            borderColor:'#00bcd4',
            backgroundColor:'rgba(0,188,212,0.2)',
            tension:0.4,
            fill:true
        }]
    },
    options: {
        responsive:true,
        plugins:{ legend:{ labels:{ color:'#f5f6fa' } } },
        scales:{
            x:{ ticks:{ color:'#f5f6fa' }, grid:{ color:'#1e293b' } },
            y:{ ticks:{ color:'#f5f6fa' }, grid:{ color:'#1e293b' } }
        }
    }
});
</script>
</body>
</html>
