<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>CURSAGE | Accueil</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:"Segoe UI",sans-serif;
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
    box-shadow:0 4px 15px rgba(0,0,0,0.3);
}

header img{
    height:45px;
}

nav a{
    color:#cbd5e1;
    text-decoration:none;
    margin-left:18px;
    font-weight:600;
    padding:8px 12px;
    border-radius:6px;
    transition:0.3s;
}

nav a:hover{
    background:#00e6ff;
    color:#00e6f;
}

/* ================= MAIN ================= */
main{
    flex:1;
    padding:50px 20px;
    text-align:center;
}

h1{
    font-size:38px;
    color:#00e6ff;
    margin-bottom:10px;
}

.subtitle{
    font-size:16px;
    max-width:700px;
    margin:auto;
    color:#cbd5e1;
}

/* ================= CARDS ================= */
.cards{
    margin-top:40px;
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(230px,1fr));
    gap:20px;
    max-width:1000px;
    margin-left:auto;
    margin-right:auto;
}

.card{
    background:#11182;
    padding:25px;
    border-radius:15px;
    text-align:center;
    transition:0.3s;
    box-shadow:0 10px 25px rgba(0,0,0,0.25);
}

.card:hover{
    transform:translateY(-8px);
}

.card i{
    font-size:32px;
    color:#00e6ff;
    margin-bottom:10px;
}

.card h3{
    margin:10px 0;
    font-size:18px;
}

.card .value{
    font-size:28px;
    font-weight:blod;
    color:#00e6ff;
}

/* ================= MESSAGE ================= */
.message{
    margin-top:50px;
    background:linear-gradient(135deg,#111827,#0f172a);
    padding:30px;
    border-radius:18px;
    max-width:900px;
    margin-left:auto;
    margin-right:auto;
    box-shadow:0 10px 25px rgba(0,0,0,0.3);
    color:#cbd5e1;
}

.message h2{
    color:#00e6ff;
    margin-bottom:10px;
}

/* ================= FOOTER ================= */
footer{
    background:#00e6ff;
    color:#101111;
    text-align:center;
    padding:15px;
    font-size:14px;
}

/* ================= RESPONSIVE ================= */
@media(max-width:768px){
    h1{font-size:26px}
}
</style>
</head>

<body>

<header>
   <div class="logo-container">

    <img src="{{ asset('images/logo-cursage.png') }}" alt="Logo CURSAGE" class="logo-img">

    <div class="logo-text">
        <span class="title">CURSAGE</span>
        <small>Plateforme intelligente</small>
    </div>

</div>

    <nav>
        <a href="{{ route('welcome')}}"><i class="fas fa-home"></i> Accueil</a>
        <a href="{{ route('commandes.create') }}">Commander des produits</a>
        <a href="{{ route('profil') }}"><i class="fas fa-user"></i> Profil</a>
        <a href="{{ route('aide')}}"><i class="fas fa-user"></i>Aide</a>
        <a href="{{ route('logout') }}"
        <i class="fas fa-sign-out-alt"></i> Déconnexion
        </a>
        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">
            @csrf
        </form>
    </nav>
</header>

<main>
    <h1>Bienvenue sur CURSAGE 👋</h1>

    <p class="subtitle">
        CURSAGE est votre plateforme professionnelle pour le suivi des chiens,
        des services informatiques et des opérations en toute transparence et sécurité.
    </p>

    <!-- BODY ORIGINAL CONSERVÉ -->
    <div class="cards">
        <div class="card">
            <i class="fas fa-dog"></i>
            <h3></h3>
            <div class="value"><a href="{{ route('races.index') }}">Races disponibles</a></div>
        </div>

         <div class="card">
            <i class="fas fa-check-circle"></i>
            <h3> </h3>
            <div class="value"><a href="{{ route('chiens.index') }}">Chiens disponibles</a></div>
        </div>

        <div class="card">
            <i class="fas fa-check-circle"></i>
            <h3> </h3>
            <div class="value"><a href="{{ route('produits.index') }}">Produits disponibles</a></div>
        </div>

        <div class="card">
            <i class="fas fa-laptop-code"></i>
            <h3></h3>
            <div class="value"><a href="{{ route('evenements.index') }}">Liste des évenements</a></div>
        </div>

        <div class="card">
            <i class="fas fa-tools"></i>
            <h3></h3>
            <div class="value"><a href="{{ route('publications.index') }}">Liste des pubications
            </a></div>
        </div>

        <div class="card">
            <i class="fas fa-tools"></i>
            <h3></h3>
            <div class="value"><a href="{{ route('services.index') }}">Liste des services
            </a></div>
        </div>
    </div>

    <div class="message">
        <h2>🔒 Sécurité & Professionnalisme</h2>
        <p>
            Chez CURSAGE, chaque utilisateur a accès uniquement aux informations
            nécessaires.
            Vos données sont protégées, votre travail est valorisé,
            et la gestion reste claire et professionnelle.
        </p>
    </div>
</main>

<footer>
    © {{ date('Y') }} CURSAGE — Plateforme professionnelle & sécurisée
</footer>

</body>
</html>