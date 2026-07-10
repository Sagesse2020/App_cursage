<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CURSAGE | Accueil</title>

<link rel="stylesheet"
href="{{ asset('fontawesome/css/all.min.css') }}">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:"Segoe UI",sans-serif;
}

body{
background:#0b1020;
color:#fff;
min-height:100vh;
display:flex;
flex-direction:column;
}

/* ================= NAVBAR ================= */

header{

background:#020617;

padding:15px 30px;

display:flex;
justify-content:space-between;
align-items:center;
flex-wrap:wrap;

box-shadow:
0 4px 15px rgba(0,0,0,.30);
}

nav{
display:flex;
flex-wrap:wrap;
gap:10px;
}

nav a{

color:#cbd5e1;
text-decoration:none;

font-weight:600;

padding:10px 14px;

border-radius:8px;

transition:.3s;
}

nav a:hover{

background:#00e6ff;
color:#0f172a;
}

/* ================= HERO ================= */

.hero{

text-align:center;

padding:60px 20px;
}

.hero h1{

font-size:42px;

color:#00e6ff;

margin-bottom:15px;
}

.hero p{

max-width:800px;

margin:auto;

line-height:1.8;

color:#cbd5e1;
}

/* ================= ACTIONS ================= */

.hero-buttons{

margin-top:30px;

display:flex;
justify-content:center;
gap:15px;
flex-wrap:wrap;
}

.btn{

padding:14px 22px;

border-radius:10px;

text-decoration:none;

font-weight:bold;

transition:.3s;
}

.btn-primary{
background:#00e6ff;
color:#0f172a;
}

.btn-secondary{
background:#1e293b;
color:white;
}

.btn:hover{
transform:translateY(-3px);
}

/* ================= CARDS ================= */

.cards{

margin-top:40px;

display:grid;

grid-template-columns:
repeat(auto-fit,minmax(250px,1fr));

gap:20px;

max-width:1200px;

margin-left:auto;
margin-right:auto;

padding:20px;
}

.card{

background:#111827;

padding:25px;

border-radius:18px;

text-align:center;

text-decoration:none;

color:white;

transition:.3s;

box-shadow:
0 10px 25px rgba(0,0,0,.25);
}

.card:hover{

transform:translateY(-8px);

box-shadow:
0 15px 30px rgba(0,230,255,.15);
}

.card i{

font-size:38px;

color:#00e6ff;

margin-bottom:15px;
}

.card h3{
margin-bottom:10px;
}

.card p{
color:#cbd5e1;
line-height:1.6;
}

/* ================= ACTIONS RAPIDES ================= */

.quick-actions{

max-width:1000px;

margin:50px auto;

padding:30px;

background:#111827;

border-radius:20px;
}

.quick-actions h2{

text-align:center;

margin-bottom:25px;

color:#00e6ff;
}

.actions-grid{

display:grid;

grid-template-columns:
repeat(auto-fit,minmax(220px,1fr));

gap:15px;
}

.actions-grid a{

background:#1e293b;

padding:15px;

border-radius:10px;

text-decoration:none;

color:white;

font-weight:bold;

text-align:center;

transition:.3s;
}

.actions-grid a:hover{

background:#00e6ff;
color:#0f172a;
}

/* ================= MESSAGE ================= */

.message{

max-width:1000px;

margin:50px auto;

padding:30px;

border-radius:20px;

background:
linear-gradient(
135deg,
#111827,
#0f172a
);

box-shadow:
0 10px 25px rgba(0,0,0,.30);
}

.message h2{

color:#00e6ff;

margin-bottom:15px;
}

.message p{

line-height:1.8;

color:#cbd5e1;
}

/* ================= FOOTER ================= */

footer{

margin-top:auto;

background:#00e6ff;

color:#101111;

text-align:center;

padding:15px;

font-weight:bold;
}

/* ================= RESPONSIVE ================= */

@media(max-width:768px){

.hero h1{
font-size:28px;
}

header{
justify-content:center;
gap:15px;
}

nav{
justify-content:center;
}

}

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

    /* LOGO */
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
</style>

</head>

<body>

<header>

<div class="logo-container">

<img
src="{{ asset('images/logo-cursage.png') }}"
alt="Logo CURSAGE"
class="logo-img">

<div class="logo-text">
<small>
Plateforme intelligente
</small>

</div>

</div>

<nav>

<a href="{{ route('welcome') }}">
<i class="fas fa-home"></i>
Accueil
</a>

<a href="{{ route('commandes.create') }}">
<i class="fas fa-shopping-cart"></i>
Commander
</a>

<a href="{{ route('profil') }}">
<i class="fas fa-user"></i>
Profil
</a>

<a href="{{ route('aide') }}">
<i class="fas fa-question-circle"></i>
Aide
</a>

<a href="{{ route('logout')  }}">Deconnexion</a>
@csrf

</form>

</nav>

</header>

<main>

<section class="hero">

<h1>
Bienvenue sur CURSAGE 
</h1>

<p>

CURSAGE est votre plateforme professionnelle
de gestion canine, de réservation,
de commande de produits et de services
en toute sécurité.

</p>


<div class="hero-buttons">

</div>

</section>

<section class="cards">

<a href="{{ route('races.index') }}" class="card">
<i class="fas fa-paw"></i>
<h3>Races</h3>
<p>Découvrir les races disponibles</p>
</a>

<a href="{{ route('chiens.index') }}" class="card">
<i class="fas fa-dog"></i>
<h3>Chiens</h3>
<p>Consulter tous les chiens disponibles</p>
</a>

<a href="{{ route('produits.index') }}" class="card">
<i class="fas fa-box"></i>
<h3>Produits</h3>
<p>Acheter les produits disponibles</p>
</a>

<a href="{{ route('services.index') }}" class="card">
<i class="fas fa-tools"></i>
<h3>Services</h3>
<p>Consulter nos services</p>
</a>

<a href="{{ route('evenements.index') }}" class="card">
<i class="fas fa-calendar"></i>
<h3>Évènements</h3>
<p>Suivre les évènements</p>
</a>

<a href="{{ route('publications.index') }}" class="card">
<i class="fas fa-bullhorn"></i>
<h3>Publications</h3>
<p>Lire les actualités</p>
</a>

</section>

<section class="quick-actions">

<h2>
⚡ Actions rapides
</h2>

<div class="actions-grid">

<a href="{{ route('commandes.create') }}">
🛒 Commander un produit
</a>

<a href="{{ route('profil') }}">
👤 Mon profil
</a>

<a href="{{ route('paiements.index') }}">
💰 Mes paiements
</a>

</div>

</section>

<section class="quick-actions">

<h2>📊 Statistiques en temps réel</h2>

<div class="actions-grid">

<a>🐶 Chiens disponibles : {{ $chiensDisponibles }}</a>
<a>💰 Chiens vendus : {{ $chiensVendus }}</a>
<a>📦 Produits : {{ $totalProduits }}</a>
<a>🛠 Services : {{ $totalServices }}</a>

</div>

</section>

<div class="message">

<h2>
🔒 Sécurité & Professionnalisme
</h2>

<p>

Chez CURSAGE,
chaque utilisateur dispose uniquement
des accès qui lui sont nécessaires.

Toutes vos réservations,
commandes et paiements sont sécurisés,
traçables et protégés.

</p>

</div>

</main>
<canvas id="homeChart"></canvas>

<script>
new Chart(document.getElementById('homeChart'), {
type: 'doughnut',
data: {
labels: ['Disponibles', 'Vendus'],
datasets: [{
data: [
{{ $chiensDisponibles }},
{{ $chiensVendus }}
],
backgroundColor: ['#00e6ff', '#ff4d4d']
}]
}
});
</script>

<footer>
<div class="social-icons">
      <a href="https://www.facebook.com/share/16riUmXBqu/" target="_blank"><i class="fab fa-facebook"></i></a>
      <a href="https://www.tiktok.com/@choralefoiparfait" target="_blank"><i class="fab fa-tiktok"></i></a>
      <a href="https://youtube.com/@choralefoiparfaite?si=og8TeBjZG2nDLH6o" target="_blank"><i class="fab fa-youtube"></i></a>
       <a href="{{ route('contact.form') }}"> <i class="fas fa-envelope"></i></a>
    </div>
© {{ date('Y') }}
CURSAGE —
Plateforme professionnelle & sécurisée

</footer>

</body>
</html>