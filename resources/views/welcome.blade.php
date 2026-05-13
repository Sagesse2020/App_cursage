<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CURSAGE - Accueil</title>

<link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

<style>

/* ================= RESET ================= */
*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:"Segoe UI",Tahoma,sans-serif;
}

body{
background:
radial-gradient(circle at top left,#111827,#020617 60%);
color:#f5f6fa;
min-height:100vh;
overflow-x:hidden;
}

/* ================= NAVBAR ================= */
nav{
position:fixed;
top:0;
left:0;
width:100%;
z-index:999;

display:flex;
justify-content:space-between;
align-items:center;

padding:18px 40px;

background:rgba(2,6,23,.75);
backdrop-filter:blur(18px);

border-bottom:1px solid rgba(255,255,255,.05);

box-shadow:0 8px 35px rgba(0,0,0,.35);
}

nav .logo{
font-size:22px;
font-weight:bold;
color:#00e6ff;
}

nav ul{
display:flex;
gap:14px;
list-style:none;
}

nav ul li a{

display:flex;
align-items:center;
gap:10px;

padding:12px 18px;

border-radius:14px;

background:rgba(255,255,255,.03);
border:1px solid rgba(255,255,255,.05);

color:#e2e8f0;

text-decoration:none;
font-size:14px;

transition:.3s;
}

nav ul li a:hover{
background:linear-gradient(135deg,#00e6ff,#007cf0);
transform:translateY(-3px);
color:#fff;
}

/* ================= HERO ================= */
header{
position:relative;
text-align:center;
padding:180px 30px 100px;
overflow:hidden;

background:
linear-gradient(rgba(2,6,23,.85),rgba(2,6,23,.95)),
url('https://images.unsplash.com/photo-1551288049-bebda4e38f71')
center/cover;
}

/* GLOW */
header::before,
header::after{
content:"";
position:absolute;
border-radius:50%;
filter:blur(80px);
opacity:.4;
animation:float 8s ease-in-out infinite;
}

header::before{
width:500px;
height:500px;
background:#00e6ff;
top:-200px;
right:-150px;
}

header::after{
width:400px;
height:400px;
background:#007cf0;
bottom:-180px;
left:-120px;
animation-duration:10s;
}

header h1{
font-size:64px;
font-weight:800;
background:linear-gradient(90deg,#00e6ff,#4facfe);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
margin-bottom:15px;
animation:fadeUp 1s ease;
}

header p{
font-size:20px;
color:#cbd5e1;
max-width:800px;
margin:auto;
animation:fadeUp 1.2s ease;
}

/* ================= BUTTONS ================= */
.hero-buttons{
margin-top:30px;
display:flex;
justify-content:center;
gap:15px;
flex-wrap:wrap;
}

.btn{
padding:12px 22px;
border-radius:14px;
font-weight:600;
text-decoration:none;
transition:.3s;
}

.btn-primary{
background:linear-gradient(135deg,#00e6ff,#007cf0);
color:#fff;
}

.btn-primary:hover{
transform:translateY(-3px);
}

.btn-outline{
border:1px solid #00e6ff;
color:#00e6ff;
background:transparent;
}

.btn-outline:hover{
background:#00e6ff;
color:#0b1020;
}

/* ================= SERVICES ================= */
section.services{
padding:80px 35px;
display:grid;
grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
gap:28px;
max-width:1100px;
margin:auto;
}

.card{
background:rgba(17,24,39,.72);
backdrop-filter:blur(18px);
border:1px solid rgba(255,255,255,.05);

padding:35px;
border-radius:28px;

text-align:center;

transition:.4s;

box-shadow:0 15px 40px rgba(0,0,0,.35);
}

.card:hover{
transform:translateY(-12px);
box-shadow:0 20px 50px rgba(0,230,255,.12);
}

.card i{
font-size:46px;
color:#00e6ff;
margin-bottom:20px;
}

.card h3{
font-size:22px;
margin-bottom:12px;
}

.card p{
color:#94a3b8;
font-size:14px;
line-height:1.7;
}

/* ================= FOOTER ================= */
footer{
padding:25px;
text-align:center;
background:#020617;
border-top:1px solid rgba(255,255,255,.05);
color:#94a3b8;
}

/* ================= ANIMATIONS ================= */
@keyframes fadeUp{
from{opacity:0;transform:translateY(30px);}
to{opacity:1;transform:translateY(0);}
}

@keyframes float{
0%{transform:translateY(0);}
50%{transform:translateY(25px);}
100%{transform:translateY(0);}
}

/* ================= RESPONSIVE ================= */
@media(max-width:768px){
header h1{font-size:36px;}
header p{font-size:16px;}
}

/* ===== LOGO ===== */

.logo-container{
display:flex;
align-items:center;
gap:12px;
}

.logo-img{
width:55px;
height:55px;
object-fit:cover;
border-radius:14px;

/* Effet premium */
background:#125d8f;
padding:4px;

box-shadow:
0 5px 18px rgba(0,230,255,.25);

transition:.3s;
}

.logo-img:hover{
transform:scale(1.05);
}

.logo-text{
display:flex;
flex-direction:column;
line-height:1.1;
}

.logo-text .title{
font-size:22px;
font-weight:800;
letter-spacing:1px;

background:linear-gradient(90deg,#00e6ff,#4facfe);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
}

.logo-text small{
font-size:11px;
color:#94a3b8;
margin-top:2px;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav>
<div class="logo-container">

    <img src="{{ asset('images/logo-cursage.png') }}" alt="Logo CURSAGE" class="logo-img">

    <div class="logo-text">
        <span class="title">CURSAGE</span>
        <small>Plateforme intelligente</small>
    </div>

</div>

<ul>
<li><a href="{{ route('publications.index') }}"><i class="fas fa-newspaper"></i> Publications</a></li>
<li><a href="{{ route('documents.index') }}"><i class="fas fa-file-alt"></i> Documents</a></li>
<li><a href="{{ route('evenements.index') }}"><i class="fas fa-calendar-alt"></i> Évènements</a></li>
<li>
<a href="{{ route('aide') }}">
<i class="fas fa-user"></i>
Aide
</a>
</li>
@guest
<li><a href="{{ route('login') }}">Connexion</a></li>
@endguest

@auth
<li><a href="{{ route('admin') }}"><i class="fas fa-user-shield"></i> Dashboard</a></li>
@endauth
</ul>

</nav>

<!-- HERO -->
<header>

<h1>Bienvenue chez CURSAGE</h1>

<p>
Plateforme intelligente de gestion canine, services informatiques,
administration et suivi financier sécurisé.
</p>

<div class="hero-buttons">
<a href="{{ route('register') }}" class="btn btn-primary">Créer un compte</a>
<a href="{{ route('infos') }}" class="btn btn-outline">Découvrir</a>
</div>

</header>

<!-- SERVICES -->
<section class="services">

<div class="card">
<i class="fas fa-dog"></i>
<h3>Gestion Canine</h3>
<p>Suivi des chiens, ventes, partenaires et traçabilité complète.</p>
</div>

<div class="card">
<i class="fas fa-laptop-code"></i>
<h3>Services IT</h3>
<p>Développement, maintenance et support informatique professionnel.</p>
</div>

<div class="card">
<i class="fas fa-chart-line"></i>
<h3>Analyse & Stats</h3>
<p>Suivi des performances et indicateurs clés du système.</p>
</div>

<div class="card">
<i class="fas fa-coins"></i>
<h3>Finances</h3>
<p>Gestion des transactions, factures et trésorerie.</p>
</div>

</section>

<!-- FOOTER -->
<footer>
© {{ date('Y') }} CURSAGE — Plateforme professionnelle & sécurisée
</footer>

</body>
</html>