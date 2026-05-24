<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Administration CURSAGE</title>

<link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

<style>

/* ================= RESET ================= */

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:"Segoe UI",Tahoma,Verdana,sans-serif;
}

html{
scroll-behavior:smooth;
}

body{
background:
radial-gradient(circle at top left,#111827,#020617 60%);
color:#f5f6fa;
min-height:100vh;
overflow-x:hidden;
}

/* ================= SCROLLBAR ================= */

::-webkit-scrollbar{
width:8px;
}

::-webkit-scrollbar-thumb{
background:#00e6ff;
border-radius:20px;
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

background:#fff;
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

/* ================= MENU ================= */

nav ul{
display:flex;
gap:14px;
list-style:none;
align-items:center;
}

nav ul li{
position:relative;
}

/* ================= LIENS ================= */

nav ul li a{

display:flex;
align-items:center;
gap:10px;

padding:12px 18px;

border-radius:14px;

background:rgba(255,255,255,.03);

border:1px solid rgba(255,255,255,.05);

color:#e2e8f0;

font-size:14px;
font-weight:500;

text-decoration:none;

transition:.35s ease;

backdrop-filter:blur(12px);
}

nav ul li a:hover{

background:linear-gradient(135deg,#00e6ff,#007cf0);

color:white;

transform:translateY(-3px);

box-shadow:
0 10px 25px rgba(0,230,255,.25);
}

nav ul li a i{
font-size:15px;
}

/* ================= DROPDOWN ================= */

.dropdown-content{

display:none;

position:absolute;

top:58px;
left:0;

min-width:240px;

padding:12px;

border-radius:18px;

background:rgba(15,23,42,.96);

backdrop-filter:blur(16px);

border:1px solid rgba(255,255,255,.05);

box-shadow:0 15px 35px rgba(0,0,0,.45);

animation:fadeUp .35s ease;
}

.dropdown:hover .dropdown-content{
display:block;
}

.dropdown-content li{
margin-bottom:8px;
}

.dropdown-content li:last-child{
margin-bottom:0;
}

.dropdown-content a{

display:block;

padding:12px;

border-radius:12px;

background:none;

border:none;
}

.dropdown-content a:hover{

padding-left:20px;

background:rgba(0,230,255,.08);
}

/* ================= MOBILE ================= */

.menu-toggle{
display:none;
font-size:28px;
cursor:pointer;
color:#00e6ff;
}

/* ================= HEADER ================= */

.admin-header{

position:relative;

padding:180px 30px 120px;

text-align:center;

overflow:hidden;

background:
linear-gradient(rgba(2,6,23,.82),rgba(2,6,23,.9)),
url('https://images.unsplash.com/photo-1551288049-bebda4e38f71')
center/cover;
}

/* ================= TITRE ================= */

.admin-header h1{

position:relative;

font-size:72px;

font-weight:800;

background:linear-gradient(90deg,#00e6ff,#4facfe);

-webkit-background-clip:text;

-webkit-text-fill-color:transparent;

margin-bottom:18px;
}

.admin-header p{
position:relative;
font-size:22px;
color:#cbd5e1;
}

/* ================= STATS ================= */

.hero-stats{

position:relative;

margin-top:60px;

display:flex;

justify-content:center;

gap:25px;

flex-wrap:wrap;
}

.stat-box{

background:rgba(255,255,255,.04);

border:1px solid rgba(255,255,255,.05);

backdrop-filter:blur(12px);

padding:25px;

width:220px;

border-radius:24px;

transition:.4s;
}

.stat-box:hover{

transform:translateY(-8px);

box-shadow:0 15px 40px rgba(0,230,255,.12);
}

.stat-box h2{

font-size:38px;

color:#00e6ff;

margin-bottom:10px;
}

.stat-box span{
color:#94a3b8;
font-size:14px;
}

/* ================= DASHBOARD ================= */

.dashboard{
padding:80px 35px;
}

.cards{

display:grid;

grid-template-columns:repeat(auto-fit,minmax(280px,1fr));

gap:28px;
}

/* ================= CARD ================= */

.card{

position:relative;

overflow:hidden;

padding:35px;

border-radius:28px;

background:rgba(17,24,39,.72);

backdrop-filter:blur(18px);

border:1px solid rgba(255,255,255,.05);

transition:.4s ease;

box-shadow:0 15px 40px rgba(0,0,0,.35);
}

.card:hover{

transform:translateY(-12px);

box-shadow:0 20px 50px rgba(0,230,255,.12);
}

.card i{

font-size:48px;

margin-bottom:20px;

color:#00e6ff;
}

.card h3{

font-size:24px;

margin-bottom:14px;
}

.card p{

line-height:1.8;

color:#94a3b8;

font-size:14px;
}

/* ================= FOOTER ================= */

footer{

padding:30px;

text-align:center;

background:#020617;

border-top:1px solid rgba(255,255,255,.05);

color:#94a3b8;
}

/* ================= RESPONSIVE ================= */

@media(max-width:950px){

.menu-toggle{
display:block;
}

nav{
flex-wrap:wrap;
}

nav ul{

width:100%;

display:none;

flex-direction:column;

align-items:flex-start;

margin-top:20px;

padding:20px;

border-radius:18px;

background:rgba(2,6,23,.95);
}

nav ul.active{
display:flex;
}

.dropdown-content{

position:relative;

top:12px;

width:100%;

box-shadow:none;
}

.admin-header{
padding-top:150px;
}

.admin-header h1{
font-size:42px;
}

}

@media(max-width:600px){

.admin-header h1{
font-size:32px;
}

.admin-header p{
font-size:16px;
}

.dashboard{
padding:50px 18px;
}

.card{
padding:28px;
}

.stat-box{
width:100%;
}

}

/* ================= ANIMATION ================= */

@keyframes fadeUp{

from{
opacity:0;
transform:translateY(35px);
}

to{
opacity:1;
transform:translateY(0);
}

}

</style>

</head>

<body>

<!-- ================= NAVBAR ================= -->

<nav>

<div class="logo-container">

<img src="{{ asset('images/cursage.png') }}"
alt="Logo CURSAGE"
class="logo-img">

<div class="logo-text">
<span class="title">CURSAGE</span>
<small>Plateforme intelligente</small>
</div>

</div>

<div class="menu-toggle" id="menuToggle">
<i class="fas fa-bars"></i>
</div>

<ul id="navMenu">

{{-- ================= ADMIN 2 & 3 ================= --}}

@if(auth()->user()->niveau_admin >= 2)

<li class="dropdown">

<a href="#">
<i class="fas fa-dog"></i>
Gestion Canine
</a>

<ul class="dropdown-content">

<li><a href="{{ route('races') }}">Races</a></li>
<li><a href="{{ route('chiens') }}">Chiens</a></li>
<li><a href="{{ route('ventes') }}">Ventes</a></li>
<li><a href="{{ route('services') }}">Services</a></li>
<li><a href="{{ route('produits') }}">Produits</a></li>

</ul>

</li>

<li class="dropdown">

<a href="#">
<i class="fas fa-dog"></i>
Gestion ventes
</a>

<ul class="dropdown-content">
<li><a href="{{ route('categories') }}">Categories</a></li>
<li><a href="{{ route('produits') }}">Produits</a></li>
<li><a href="{{ route('commandes') }}">Commandes</a></li>

</ul>

</li>

<li class="dropdown">

<a href="#">
<i class="fas fa-users"></i>
Gestion humaine
</a>

<ul class="dropdown-content">
<li><a href="{{ route('employes') }}">Employes</a></li>
<li><a href="{{ route('clients') }}">Clients</a></li>
<li><a href="{{ route('partenaires') }}">Partenaires</a></li>
<li><a href="{{ route('fournisseurs') }}">Fournisseurs</a></li>

</ul>

</li>

<li class="dropdown">

<a href="#">
<i class="fas fa-chart-line"></i>
Gestion analytique
</a>

<ul class="dropdown-content">

<li><a href="{{ route('statistiques') }}">Statistiques</a></li>
<li><a href="{{ route('commentaires.index') }}">Commentaires</a></li>
<li><a href="{{ route('journal.index') }}">Journal</a></li>
<li><a href="{{ route('graphique') }}">Graphiques</a></li>

</ul>

</li>

<li class="dropdown">

<a href="#">
<i class="fas fa-folder-open"></i>
Gestion contenu
</a>

<ul class="dropdown-content">

<li><a href="{{ route('documents') }}">Documents</a></li>
<li><a href="{{ route('evenements') }}">Évènements</a></li>
<li><a href="{{ route('publications') }}">Publications</a></li>

</ul>

</li>

@endif

{{-- ================= ADMIN 3 SEULEMENT ================= --}}

@if(auth()->user()->niveau_admin == 3)

<li class="dropdown">

<a href="#">
<i class="fas fa-user-cog"></i>
Gestion Utilisateurs
</a>

<ul class="dropdown-content">

<li><a href="{{ route('users.create') }}">Créer utilisateur</a></li>
<li><a href="{{ route('users.index') }}">Liste utilisateurs</a></li>

</ul>

</li>

<li class="dropdown">

<a href="#">
<i class="fas fa-coins"></i>
Gestion Financière
</a>

<ul class="dropdown-content">

<li><a href="{{ route('tresorerie.index') }}">Trésorerie</a></li>
<li><a href="{{ route('transactions') }}">Transactions</a></li>
<li><a href="{{ route('factures') }}">Factures</a></li>
<li><a href="{{ route('cloture') }}">Clôture</a></li>

</ul>

</li>

@endif

{{-- ================= PARTENAIRES : NIVEAU 1 ================= --}}

@if(auth()->user()->niveau_admin == 1)

<li class="dropdown">

<a href="#">
<i class="fas fa-handshake"></i>
Espace Partenaire
</a>

<ul class="dropdown-content">

<li>
<a href="{{ route('produits') }}">
<i class="fas fa-box"></i>
Mes Produits
</a>
</li>

<li>
<a href="{{ route('ventes.index') }}">
<i class="fas fa-shopping-cart"></i>
Mes Ventes
</a>
</li>

<li>
<a href="{{ route('publications') }}">
<i class="fas fa-bullhorn"></i>
Publications
</a>
</li>

<li>
<a href="{{ route('commentaires.index') }}">
<i class="fas fa-comments"></i>
Commentaires
</a>
</li>

<li>
<a href="{{ route('statistiques') }}">
<i class="fas fa-chart-pie"></i>
Statistiques
</a>
</li>

</ul>

</li>

@endif

{{-- ================= COMMUN ================= --}}

<li>
<a href="{{ route('profil') }}">
<i class="fas fa-user"></i>
Profil
</a>
</li>

<li>
<a href="{{ route('logout') }}">
<i class="fas fa-sign-out-alt"></i>
Déconnexion
</a>
</li>

</ul>

</nav>

<!-- ================= HEADER ================= -->

<section class="admin-header">

<h1>Administration CURSAGE</h1>

<p>

@if(auth()->user()->niveau_admin == 3)

Vision stratégique • Contrôle total

@elseif(auth()->user()->niveau_admin == 2)

Opérations terrain • Supervision avancée

@else

Partenariat • Collaboration sécurisée

@endif

</p>

<div class="hero-stats">

<div class="stat-box">
<h2>98%</h2>
<span>Sécurité système</span>
</div>

<div class="stat-box">
<h2>+120</h2>
<span>Transactions</span>
</div>

<div class="stat-box">
<h2>24/7</h2>
<span>Disponibilité</span>
</div>

</div>

</section>

<!-- ================= DASHBOARD ================= -->

<section class="dashboard">

<div class="cards">

@if(auth()->user()->niveau_admin == 3)

<div class="card">

<i class="fas fa-users-cog"></i>

<h3>Gestion utilisateurs</h3>

<p>
Création des comptes, permissions,
sécurité et contrôle complet du système.
</p>

</div>

@endif

@if(auth()->user()->niveau_admin >= 2)

<div class="card">

<i class="fas fa-dog"></i>

<h3>Gestion canine</h3>

<p>
Gestion des chiens, ventes,
services et suivi opérationnel.
</p>

</div>

<div class="card">

<i class="fas fa-chart-line"></i>

<h3>Gestion analytique</h3>

<p>
Statistiques, graphiques,
journal système et suivi des performances.
</p>

</div>

<div class="card">

<i class="fas fa-folder-open"></i>

<h3>Gestion contenu</h3>

<p>
Publications, documents,
évènements et contenus multimédias.
</p>

</div>

@endif

@if(auth()->user()->niveau_admin == 3)

<div class="card">

<i class="fas fa-coins"></i>

<h3>Gestion financière</h3>

<p>
Transactions, trésorerie,
facturation et contrôle financier global.
</p>

</div>

@endif

{{-- ================= PARTENAIRE ================= --}}

@if(auth()->user()->niveau_admin == 1)

<div class="card">

<i class="fas fa-handshake"></i>

<h3>Espace partenaire</h3>

<p>
Gestion des produits partenaires,
publicités, ventes et commissions.
</p>

</div>

<div class="card">

<i class="fas fa-bullhorn"></i>

<h3>Publicités</h3>

<p>
Suivi des publications sponsorisées
et visibilité des produits partenaires.
</p>

</div>

<div class="card">

<i class="fas fa-chart-pie"></i>

<h3>Statistiques ventes</h3>

<p>
Consultation des ventes,
performances et commissions générées.
</p>

</div>

@endif

</div>

</section>

<footer>

<p>
© {{ date('Y') }} CURSAGE — Administration centrale
</p>

</footer>

<script>

const menuToggle=document.getElementById("menuToggle");
const navMenu=document.getElementById("navMenu");

menuToggle.addEventListener("click",()=>{

navMenu.classList.toggle("active");

});

</script>

</body>
</html>