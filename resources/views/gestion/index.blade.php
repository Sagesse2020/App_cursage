<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gestion CURSAGE</title>
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
.admin-header { background: linear-gradient(rgba(11,16,32,0.9), rgba(11,16,32,0.9)), url('https://images.unsplash.com/photo-1581092580494-ec50f90b01b2') center/cover; padding:60px 30px; text-align:center; }
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
#gestionChart { margin-top:40px; background:#111827; padding:20px; border-radius:15px; }

/* FOOTER */
footer { margin-top:auto; background:#020617; padding:20px; text-align:center; color:#94a3b8; font-size:14px; }
.social-icons a { margin:0 10px; font-size:20px; color:#00e6ff; }
.social-icons a:hover { color:#00bcd4; }
</style>
</head>

<body>

<nav>
<img src="{{ asset('images/logo.png') }}" alt="Logo CURSAGE" class="logo">
<ul>
    <li><a href="{{ route('admin') }}"><i class="fas fa-home"></i>Admin</a></li>
    <li><a href="{{ route('gestion.index') }}"><i class="fas fa-cogs"></i>Gestion</a></li>
    <li><a href="{{ route('tresorerie.index') }}"><i class="fas fa-coins"></i>Trésorerie</a></li>
    <li><a href="{{ route('journal.index') }}"><i class="fas fa-book"></i>Journal</a></li>
    <li><a href="{{ route('profil') }}"><i class="fas fa-user"></i>Profil</a></li>
</ul>
</nav>

<section class="admin-header">
<h1>Gestion CURSAGE</h1>
<p>Dashboard complet du système</p>
</section>

<section class="dashboard">

<!-- CARTES -->
<div class="cards">

<div class="card">
<i class="fas fa-users"></i>
<h3>Utilisateurs</h3>
<p>{{ $totalUsers }}</p>
</div>

<div class="card">
<i class="fas fa-handshake"></i>
<h3>Partenaires</h3>
<p>{{ $totalPartners }}</p>
</div>

<div class="card">
<i class="fas fa-dog"></i>
<h3>Chiens</h3>
<p>{{ $totalChiens }}</p>
</div>

<div class="card">
<i class="fas fa-shopping-cart"></i>
<h3>Ventes</h3>
<p>{{ $totalVentes }}</p>
</div>

</div>

<!-- CHART -->
<canvas id="chart"></canvas>

<!-- TABLE USERS -->
<h2 style="margin-top:40px;color:#00e6ff;">Utilisateurs</h2>

<table>
<thead>
<tr>
<th>Nom</th>
<th>Email</th>
<th>Rôle</th>
<th>Date</th>
</tr>
</thead>

<tbody>
@foreach($users as $user)
<tr>
<td>{{ $user->name }}</td>
<td>{{ $user->email }}</td>
<td>{{ $user->niveau_admin }}</td>
<td>{{ $user->created_at->format('d/m/Y') }}</td>
</tr>
@endforeach
</tbody>
</table>

</section>

<footer>
© 2025 Gestion CURSAGE
</footer>

<script>
const ctx = document.getElementById('chart').getContext('2d');

new Chart(ctx,{
type:'bar',
data:{
labels:[
'Chiens',
'Ventes',
'Services',
'Partenaires',
'Utilisateurs'
],
datasets:[{
label:'Statistiques',
data:[
{{ $totalChiens }},
{{ $totalVentes }},
{{ $totalServices }},
{{ $totalPartners }},
{{ $totalUsers }}
],
backgroundColor:[
'#00e6ff',
'#00bcd4',
'#4facfe',
'#1e90ff',
'#38bdf8'
],
borderRadius:10
}]
},
options:{
responsive:true,
plugins:{ legend:{ display:false } }
}
});
</script>

</body>
</html>
