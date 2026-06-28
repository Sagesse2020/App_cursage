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

 .social-icons a:hover { transform: scale(1.2); }

    .fa-facebook { color: #1877F2; }
    .fa-tiktok { color: #fff; }
    .fa-whatsapp { color: #25D366; }
    .fa-youtube { color: #FF0000; }

/* ===== LOGO ===== */

.logo-img{
height:140px;
width:140px;
object-fit:contain;

filter:
drop-shadow(0 0 10px rgba(0,230,255,.25))
drop-shadow(0 0 20px rgba(0,230,255,.15));

transition:.4s;
}

.logo-img:hover{
transform:scale(1.08);
filter:
drop-shadow(0 0 15px rgba(0,230,255,.5))
drop-shadow(0 0 30px rgba(0,230,255,.3));
}
.badge{
background:red;
color:white;
padding:2px 8px;
border-radius:50%;
font-size:12px;
}
/* ===== FILTRE ===== */
.filters{
display:flex;
gap:15px;
margin:20px 0;
flex-wrap:wrap;
}

.filters input,
.filters select{
padding:12px;
border:none;
border-radius:8px;
background:#1f2937;
color:white;
min-width:220px;
}

.filters button{
padding:12px 18px;
background:#00e6ff;
color:black;
border:none;
border-radius:8px;
font-weight:bold;
cursor:pointer;
}

/* ===== notiffications ===== */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.2); }
    100% { transform: scale(1); }
}

/* ================= NOTIFICATIONS DASHBOARD ================= */

.notifications-dashboard{
padding:30px 35px;
}

.notification-panel{
background:rgba(17,24,39,.75);
border:1px solid rgba(255,255,255,.05);
border-radius:25px;
padding:25px;
backdrop-filter:blur(15px);
}

.notification-title{
font-size:24px;
font-weight:700;
margin-bottom:20px;
color:#00e6ff;
display:flex;
align-items:center;
gap:12px;
}

.notification-item{
padding:18px;
border-radius:15px;
margin-bottom:15px;
display:flex;
justify-content:space-between;
align-items:center;
transition:.3s;
}

.notification-item.unread{
background:rgba(239,68,68,.15);
border-left:5px solid #ef4444;
}

.notification-item.read{
background:rgba(255,255,255,.03);
border-left:5px solid #10b981;
}

.notification-item:hover{
transform:translateX(8px);
}

.notification-content h4{
margin-bottom:8px;
color:white;
}

.notification-content p{
color:#cbd5e1;
margin-bottom:6px;
}

.notification-content small{
color:#94a3b8;
}

.btn-read{
background:#00e6ff;
border:none;
padding:10px 15px;
border-radius:10px;
cursor:pointer;
font-weight:bold;
}

.btn-read:hover{
background:#4facfe;
}

.notification-footer{
text-align:center;
margin-top:20px;
}

.notification-footer a{
color:#00e6ff;
text-decoration:none;
font-weight:bold;
}
</style>

</head>

<body>

<nav>

<div class="logo-container">
<img src="{{ asset('images/logo.png') }}" class="logo-img">
<div class="logo-text">
<small>Plateforme intelligente</small>
</div>
</div>
<div class="menu-toggle" id="menuToggle">
<i class="fas fa-bars"></i>
</div>

<ul id="navMenu">

@php
$nbNotifications = App\Models\Notification::where('lu',false)
    ->where('user_id', auth()->id())
    ->count();
@endphp

  @if($nbNotifications > 0)
<span class="badge" style="background:#ef4444; animation:pulse 1.5s infinite;">
    {{ $nbNotifications }}
</span>
@endif

{{-- ================= Gestion partenaire ================= --}}
@if(auth()->user()->niveau_admin == 1)
<li class="dropdown">
<a href="#">Élevage</a>
<ul class="dropdown-content">
<li><a href="{{ route('chiens') }}"> Mes Chiens</a></li>
<li><a href="{{ route('races') }}"> Mes Races</a></li>
</ul>
</li>
<li class="dropdown">
<a href="#"><i class="fas fa-shopping-cart"></i> Ventes</a>
<ul class="dropdown-content">
<li><a href="{{ route('categories') }}"> Mes catégories</a></li>
<li><a href="{{ route('produits') }}"> Mes produits</a></li>
<li><a href="{{ route('ventes') }}"> Mes ventes</a></li>
<li><a href="{{ route('commandes') }}"> Mes commandes</a></li>
</ul>
</li>

<li class="dropdown">
<a href="#"><i class="fas fa-folder"></i> Contenu</a>
<ul class="dropdown-content">
<li><a href="{{ route('evenements') }}"> Mes évènements</a></li>
<li><a href="{{ route('publications') }}">Mes publications</a></li>
</ul>
</li>

@endif

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
<li><a href="{{ route('fiches_suivi') }}">Fiches de suivi</a></li>
<li><a href="{{ route('services') }}">Services</a></li>
</ul>
</li>

</ul>
</li>

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
<li><a href="{{ route('partenaire_commissions') }}">Commission de partenaires</a></li>
<li><a href="{{ route('fournisseurs') }}">Fournisseurs</a></li>
@if(auth()->user()->niveau_admin == 3)
<li><a href="{{ route('users.index') }}">Liste des utilisateurs</a></li>
<li><a href="{{ route('users.create') }}">Creer un utilisateur</a></li>
@endif
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
@if(auth()->user()->niveau_admin == 2)  
<li><a href="{{ route('recettes.index') }}">Recettes</a></li>
<li><a href="{{ route('benefices.index') }}">Bénéfices</a></li>
<li><a href="{{ route('pertes.index') }}">Pertes</a></li>
@endif
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
@endif

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
<li><a href="{{ route('paiements') }}">Paiements</a></li>
<li><a href="{{ route('paiement_fournisseurs') }}">Paiements des fournisseurs</a></li>
<li><a href="{{ route('paiement_commissions') }}">Paiements des commissions</a></li>
<li><a href="{{ route('depenses') }}">Depenses</a></li>
<li><a href="{{ route('salaires') }}">Salaires</a></li>
</ul>
</li>

<li class="dropdown">
<a href="#">Rapports</a>
<ul class="dropdown-content">
<li><a href="{{ route('recettes.index') }}">Recettes</a></li>
<li><a href="{{ route('benefices.index') }}">Bénéfices</a></li>
<li><a href="{{ route('pertes.index') }}">Pertes</a></li>
<li>
<a href="{{ route('notifications.index') }}" style="position:relative;">
    Notifications <i class="fas fa-bell"></i>

    @if($nbNotifications > 0)
        <span class="badge">{{ $nbNotifications }}</span>
    @endif
</a>
</li>
</ul>
</li>
</ul>
</li>
<li>
</li>
@endif

<li><a href="{{ route('profil') }}"><i class="fas fa-user"></i> Profil</a></li>
<li><a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>

</ul>
</li>
</ul>

</nav>

<section class="admin-header">
<h1>Administration CURSAGE</h1>
<p>Gestion intelligente multi-modules</p>
</section>

{{-- ================= ALERTES NOTIFICATIONS ================= --}}

<section class="notifications-dashboard">

    @php
        $notificationsRecentes = App\Models\Notification::where('user_id', auth()->id())
            ->latest()
            ->take(5)
            ->get();
    @endphp

    @if($notificationsRecentes->count())

        <div class="notification-panel">

            <div class="notification-title">
                <i class="fas fa-bell"></i>
                Alertes récentes
            </div>

            @foreach($notificationsRecentes as $notification)

                <div class="notification-item {{ $notification->lu ? 'read' : 'unread' }}">

                    <div class="notification-content">

                        <h4>
                            {{ $notification->titre }}
                        </h4>

                        <p>
                            {{ $notification->message }}
                        </p>

                        <small>
                            {{ $notification->created_at->diffForHumans() }}
                        </small>

                    </div>

                    @if(!$notification->lu)

                        <form action="{{ route('notifications.read',$notification) }}"
                              method="POST">
                            @csrf
                            @method('PATCH')

                            <button class="btn-read">
                                Marquer lu
                            </button>
                        </form>

                    @endif

                </div>

            @endforeach

            <div class="notification-footer">
                <a href="{{ route('notifications.index') }}">
                    Voir toutes les notifications
                </a>
            </div>

        </div>

    @endif

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

 <footer>
    <p>Suivez-nous sur nos plates formes en ligne</p>
    <div class="social-icons">
      <a href="https://www.facebook.com/share/16riUmXBqu/" target="_blank"><i class="fab fa-facebook"></i></a>
      <a href="https://www.tiktok.com/@choralefoiparfait" target="_blank"><i class="fab fa-tiktok"></i></a>
      <a href="https://youtube.com/@choralefoiparfaite?si=og8TeBjZG2nDLH6o" target="_blank"><i class="fab fa-youtube"></i></a>
      <a href="{{ route('contact.form') }}"> <i class="fas fa-envelope"></i></a>
    </div>
</footer>

<script>
document.getElementById("menuToggle")
.addEventListener("click",()=>document.getElementById("navMenu").classList.toggle("active"));
</script>

</body>
</html>