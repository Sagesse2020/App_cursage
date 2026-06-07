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

html{scroll-behavior:smooth;}

body{
background:radial-gradient(circle at top left,#111827,#020617 60%);
color:#f5f6fa;
min-height:100vh;
overflow-x:hidden;
}

/* ================= NAV ================= */

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

/* LOGO */

.logo-container{display:flex;align-items:center;gap:12px;}

.logo-img{
width:60px;height:60px;object-fit:cover;border-radius:14px;
background:rgba(0,230,255,.25);
padding:4px;
box-shadow:0 5px 18px rgba(0,230,255,.25);
}

.logo-text{display:flex;flex-direction:column;}

.title{
font-size:22px;font-weight:800;
background:linear-gradient(90deg,#00e6ff,#4facfe);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
}

small{font-size:11px;color:#94a3b8;}

/* MENU */

nav ul{
display:flex;
gap:14px;
list-style:none;
align-items:center;
}

nav ul li{position:relative;}

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
transition:.3s;
}

nav ul li a:hover{
background:linear-gradient(135deg,#00e6ff,#007cf0);
transform:translateY(-3px);
}

/* ================= DROPDOWN MULTI NIVEAUX ================= */

.dropdown-content{
display:none;
position:absolute;
top:55px;
left:0;
min-width:230px;
background:rgba(15,23,42,.96);
border-radius:14px;
padding:10px;
}

.dropdown:hover > .dropdown-content{
display:block;
}

.dropdown-content li{
position:relative;
}

.dropdown-content li a{
padding:10px;
display:block;
border-radius:10px;
}

.dropdown-content li a:hover{
background:rgba(0,230,255,.1);
padding-left:18px;
}

/* SOUS MENU (niveau 2) */

.dropdown-content .dropdown-content{
left:100%;
top:0;
position:absolute;
}

/* MOBILE */

.menu-toggle{display:none;cursor:pointer;color:#00e6ff;font-size:28px;}

@media(max-width:900px){

.menu-toggle{display:block;}

nav ul{
display:none;
flex-direction:column;
width:100%;
margin-top:20px;
background:rgba(2,6,23,.95);
padding:20px;
}

nav ul.active{display:flex;}

.dropdown-content{
position:relative;
top:0;
left:0;
}
}

/* HEADER */

.admin-header{
padding:180px 30px 120px;
text-align:center;
background:
linear-gradient(rgba(2,6,23,.85),rgba(2,6,23,.95)),
url('https://images.unsplash.com/photo-1551288049-bebda4e38f71') center/cover;
}

.admin-header h1{
font-size:72px;
font-weight:800;
background:linear-gradient(90deg,#00e6ff,#4facfe);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
}

.admin-header p{color:#cbd5e1;font-size:20px;}

/* DASHBOARD */

.dashboard{padding:80px 35px;}

.cards{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
gap:28px;
}

.card{
padding:35px;
border-radius:25px;
background:rgba(17,24,39,.72);
border:1px solid rgba(255,255,255,.05);
transition:.3s;
}

.card:hover{transform:translateY(-10px);}

/* FOOTER */

footer{
text-align:center;
padding:30px;
background:#020617;
color:#94a3b8;
border-top:1px solid rgba(255,255,255,.05);
}

</style>

</head>

<body>

<nav>

<div class="logo-container">
<img src="{{ asset('images/logo.png') }}" class="logo-img">
<div class="logo-text">
<span class="title">CURSAGE</span>
<small>Plateforme intelligente</small>
</div>
</div>

<div class="menu-toggle" id="menuToggle">
<i class="fas fa-bars"></i>
</div>

<ul id="navMenu">

{{-- ================= CANINE ================= --}}
@if(auth()->user()->niveau_admin >= 2)

<li class="dropdown">
<a href="#"><i class="fas fa-dog"></i> Canine</a>

<ul class="dropdown-content">

<li class="dropdown">
<a href="#">Élevage</a>
<ul class="dropdown-content">
<li><a href="{{ route('chiens') }}">Chiens</a></li>
<li><a href="{{ route('races') }}">Races</a></li>
<li><a href="{{ route('reproductions') }}">Reproduction</a></li>
<li><a href="{{ route('naissances') }}">Naissances</a></li>
<li><a href="{{ route('deces') }}">Décès</a></li>
</ul>
</li>

<li class="dropdown">
<a href="#">Soins</a>
<ul class="dropdown-content">
<li><a href="{{ route('consultations') }}">Consultations</a></li>
<li><a href="{{ route('traitements') }}">Traitements</a></li>
<li><a href="{{ route('services') }}">Services</a></li>
</ul>
</li>

</ul>
</li>

@endif

{{-- ================= VENTES ================= --}}
<li class="dropdown">
<a href="#"><i class="fas fa-shopping-cart"></i> Ventes</a>
<ul class="dropdown-content">
<li><a href="{{ route('categories') }}">Catégories</a></li>
<li><a href="{{ route('produits') }}">Produits</a></li>
<li><a href="{{ route('ventes') }}">Ventes</a></li>
<li><a href="{{ route('commandes') }}">Commandes</a></li>
<li><a href="{{ route('reservations') }}">Réservations</a></li>
</ul>
</li>

{{-- ================= HUMAIN ================= --}}
<li class="dropdown">
<a href="#"><i class="fas fa-users"></i> Humain</a>
<ul class="dropdown-content">
<li><a href="{{ route('employees') }}">Employés</a></li>
<li><a href="{{ route('clients') }}">Clients</a></li>
<li><a href="{{ route('partenaires') }}">Partenaires</a></li>
<li><a href="{{ route('fournisseurs') }}">Fournisseurs</a></li>
<li><a href="{{ route('users.index') }}">Liste des utilisateurs</a></li>
<li><a href="{{ route('users.create') }}">Creer un utilisateur</a></li>
</ul>
</li>

{{-- ================= ANALYSE ================= --}}
<li class="dropdown">
<a href="#"><i class="fas fa-chart-line"></i> Analyse</a>
<ul class="dropdown-content">
<li><a href="{{ route('statistiques') }}">Statistiques</a></li>
<li><a href="{{ route('graphique') }}">Graphiques</a></li>
<li><a href="{{ route('journal.index') }}">Journal</a></li>
<li><a href="{{ route('commentaires.index') }}">Commentaires</a></li>
<li><a href="{{ route('activites.index') }}">Historique de modification</a></li>
</ul>
</li>

{{-- ================= CONTENU ================= --}}
<li class="dropdown">
<a href="#"><i class="fas fa-folder"></i> Contenu</a>
<ul class="dropdown-content">
<li><a href="{{ route('documents') }}">Documents</a></li>
<li><a href="{{ route('evenements') }}">Évènements</a></li>
<li><a href="{{ route('publications') }}">Publications</a></li>
</ul>
</li>

{{-- ================= FINANCE ================= --}}
@if(auth()->user()->niveau_admin == 3)


<li class="dropdown">
<a href="#"><i class="fas fa-coins"></i> Finance</a>

<ul class="dropdown-content">

<li class="dropdown">
<a href="#">Opérations</a>
<ul class="dropdown-content">
<li><a href="{{ route('transactions') }}">Transactions</a></li>
<li><a href="{{ route('factures') }}">Factures</a></li>
<li><a href="{{ route('tresorerie.index') }}">Trésorerie</a></li>
</ul>
</li>

<li class="dropdown">
<a href="#">Rapports</a>
<ul class="dropdown-content">
<li><a href="{{ route('recettes.index') }}">Recettes</a></li>
<li><a href="{{ route('benefices.index') }}">Bénéfices</a></li>
<li><a href="{{ route('pertes.index') }}">Pertes</a></li>
</ul>
</li>
</ul>
</li>

@endif

<li>
<a href="mailto:contact@cursagesolutions.com?subject=Support CURSAGE&body=Bonjour,">
📨 Contacter le support
</a>
</li>

</ul>
</li>

<li><a href="{{ route('profil') }}"><i class="fas fa-user"></i> Profil</a></li>
<li><a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>

</ul>

</nav>

<section class="admin-header">
<h1>Administration CURSAGE</h1>
<p>Gestion intelligente multi-modules</p>
</section>

<section class="dashboard">
<div class="cards">
<div class="card"><i class="fas fa-dog"></i><h3>Canine</h3></div>
<div class="card"><i class="fas fa-shopping-cart"></i><h3>Ventes</h3></div>
<div class="card"><i class="fas fa-users"></i><h3>Humain</h3></div>
<div class="card"><i class="fas fa-chart-line"></i><h3>Analyse</h3></div>
<div class="card"><i class="fas fa-coins"></i><h3>Finance</h3></div>
</div>
</section>

<footer style="text-align:center; padding:25px; background:#020617; color:#94a3b8;">

    <p>© {{ date('Y') }} CURSAGE</p>

    <div style="margin-top:10px; display:flex; justify-content:center; gap:15px; flex-wrap:wrap;">

        <a href="https://facebook.com" target="_blank">
            <i class="fab fa-facebook"></i> Facebook
        </a>

        <a href="https://instagram.com" target="_blank">
            <i class="fab fa-instagram"></i> Instagram
        </a>

        <a href="https://tiktok.com" target="_blank">
            <i class="fab fa-tiktok"></i> TikTok
        </a>

        <a href="https://youtube.com" target="_blank">
            <i class="fab fa-youtube"></i> YouTube
        </a>

        <a href="{{ route('contact.form') }}">
            <i class="fas fa-envelope"></i> Contact
        </a>

    </div>

</footer>

<script>
document.getElementById("menuToggle")
.addEventListener("click",()=>document.getElementById("navMenu").classList.toggle("active"));
</script>

</body>
</html>