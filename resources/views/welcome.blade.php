<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CURSAGE - Accueil</title>
<link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:"Segoe UI",sans-serif}
body{background:#0b1020;color:#fff}

/* ================= NAVBAR ================= */
nav{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px 30px;
    background:#020617;
    flex-wrap:wrap;
}
nav .logo{font-size:22px;font-weight:bold;color:#00e6ff}
nav ul{
    list-style:none;
    display:flex;
    gap:15px;
    flex-wrap:wrap;
}
nav ul li a{
    text-decoration:none;
    color:#cbd5e1;
    padding:8px 14px;
    border-radius:6px;
    transition:0.3s;
}
nav ul li a:hover{
    background:#00e6ff;
    color:#0b1020;
}

/* ================= HERO ================= */
header{
    padding:80px 20px;
    text-align:center;
    background:linear-gradient(rgba(11,16,32,0.85), rgba(11,16,32,0.85)),
    url('https://images.unsplash.com/photo-1551288049-bebda4e38f71') center/cover;
}
header h1{font-size:40px;color:#00e6ff;margin-bottom:20px}
header p{font-size:18px;color:#cbd5e1;margin-bottom:30px}

.hero-buttons{
    display:flex;
    justify-content:center;
    gap:15px;
    flex-wrap:wrap;
}
.btn{
    padding:12px 22px;
    border-radius:8px;
    border:none;
    cursor:pointer;
    font-weight:bold;
    transition:0.3s;
    text-decoration:none;
}
.btn-primary{background:#00e6ff;color:#0b1020}
.btn-primary:hover{background:#00bcd4}
.btn-outline{
    background:transparent;
    border:2px solid #00e6ff;
    color:#00e6ff;
}
.btn-outline:hover{
    background:#00e6ff;
    color:#0b1020;
}

/* ================= SERVICES ================= */
section.services{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:25px;
    padding:60px 30px;
}
.card{
    background:#111827;
    padding:25px;
    border-radius:15px;
    text-align:center;
    transition:0.3s;
}
.card:hover{transform:translateY(-8px)}
.card i{font-size:35px;color:#00e6ff;margin-bottom:15px}
.card h3{margin-bottom:10px}
.card p{color:#94a3b8;font-size:14px}

/* ================= FOOTER ================= */
footer{
    padding:25px;
    text-align:center;
    background:#020617;
    color:#94a3b8;
    font-size:14px;
}

/* ================= RESPONSIVE ================= */
@media(max-width:768px){
    header h1{font-size:28px}
    header p{font-size:15px}
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav>
    <div class="logo">CURSAGE</div>
    <ul>
        <li><a href="{{ route('publications.index') }}">Publications</a></li>
        <li><a href="{{ route('documents.index') }}">Documents</a></li>
        <li><a href="{{ route('evenements.index') }}">Évènements</a></li>
        @guest
            <li><a href="{{ route('login') }}" style="background:#00e6ff;color:#0b1020;">Connexion</a></li>
        @endguest
        @auth
            <li><a href="{{ route('admin') }}">Dashboard</a></li>
        @endauth
    </ul>
</nav>

<!-- HERO -->
<header>
    <h1>Bienvenue chez CURSAGE</h1>
    <p>Plateforme intelligente pour la gestion moderne, sécurisée et évolutive</p>
    <div class="hero-buttons">
         <a href="{{ route('register') }}" class="btn btn-primary">Créer un compte</a>
         <a href="{{ route('infos') }}" class="btn btn-outline">Découvrir</a>
    </div>
</header>

<!-- SERVICES -->
<section class="services">
    <div class="card">
        <i class="fas fa-dog"></i>
        <h3>Gestion & Suivi</h3>
        <p>Gestion dans le domaine canin</p>
        <p>Services informatiques</p>
    </div>

    <div class="card">
        <i class="fas fa-file-alt"></i>
        <h3>Documents</h3>
        <p>Stockage et visualisation sécurisée des fichiers.</p>
    </div>

    <div class="card">
        <i class="fas fa-newspaper"></i>
        <h3>Publications</h3>
        <p>Fil d’actualité avec attribution des auteurs.</p>
    </div>

    <div class="card">
        <i class="fas fa-calendar-alt"></i>
        <h3>Évènements</h3>
        <p>Organisation et suivi d’activités et rencontres.</p>
    </div>
</section>

<footer>
    © 2025 CURSAGE — cursagesolutions.com
</footer>

</body>
</html>
