<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CURSAGE | Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, sans-serif;
            background: linear-gradient(135deg, #eef2ff, #dbeafe);
            color: #1f2937;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ===== INFO TEXT ===== */
.info-text{
    font-size:15px;
    color:#555;
    background:#020617;
    padding:12px 18px;
    border-radius:6px;
}

        /* ===== NAVBAR ===== */
        header {
            background: #1e3a8a;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #fff;
            box-shadow: 0 6px 15px rgba(0,0,0,.15);
        }

        header img {
            height: 48px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 600;
            transition: color .3s;
        }

        nav a:hover {
            color: #00ffd6;
        }

        /* ===== MAIN ===== */
        main {
            flex: 1;
            padding: 3rem 1.5rem;
            text-align: center;
        }

        h1 {
            font-size: 2.6rem;
            color: #1e3a8a;
            margin-bottom: 10px;
        }

        .subtitle {
            font-size: 1.2rem;
            max-width: 700px;
            margin: auto;
            color: #374151;
        }

        /* ===== CARDS ===== */
        .cards {
            margin-top: 3rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 20px;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }

        .card {
            background: #fff;
            padding: 1.8rem;
            border-radius: 16px;
            box-shadow: 0 12px 25px rgba(0,0,0,.1);
            transition: transform .3s, box-shadow .3s;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 35px rgba(0,0,0,.15);
        }

        .card i {
            font-size: 2.2rem;
            color: #1e40af;
            margin-bottom: 10px;
        }

        .card h3 {
            margin: 8px 0;
            font-size: 1.2rem;
        }

        .card .value {
            font-size: 2rem;
            font-weight: bold;
            color: #020617;
        }

        /* ===== MESSAGE ===== */
        .message {
            margin-top: 3rem;
            background: #1e40af;
            color: #e0f2fe;
            padding: 2rem;
            border-radius: 18px;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
            box-shadow: 0 10px 25px rgba(0,0,0,.25);
        }

        /* ===== FOOTER ===== */
        footer {
            background: #020617;
            color: #94a3b8;
            text-align: center;
            padding: 1.2rem;
            font-size: .9rem;
        }
    </style>
</head>
<body>

<header>
    <img src="{{ asset('logo_cursage.png') }}" alt="CURSAGE">
    <nav>
        <a href="{{ route('home') }}"><i class="fas fa-home"></i> Accueil</a>
        <a href="{{ route('profil') }}"><i class="fas fa-user"></i> Profil</a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
           <i class="fas fa-sign-out-alt"></i> Déconnexion
        </a>
        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">@csrf</form>
    </nav>
</header>

<main>
    <h1>Bienvenue sur CURSAGE 👋</h1>
    <p class="subtitle">
        CURSAGE est votre plateforme professionnelle pour le suivi des chiens,
        des services informatiques et des opérations en toute transparence et sécurité.
    </p>
    <div class="cards">
        <div class="card">
            <i class="fas fa-dog"></i>
            <h3>Chiens disponibles</h3>
            <div class="value">{{ $chiensDisponibles ?? 0 }}</div>
        </div>

        <div class="card">
            <i class="fas fa-check-circle"></i>
            <h3>Chiens vendus</h3>
            <div class="value">{{ $chiensVendus ?? 0 }}</div>
        </div>

        <div class="card">
            <i class="fas fa-laptop-code"></i>
            <h3>Services en cours</h3>
            <div class="value">{{ $servicesEnCours ?? 0 }}</div>
        </div>

        <div class="card">
            <i class="fas fa-tools"></i>
            <h3>Services terminés</h3>
            <div class="value">{{ $servicesVendus ?? 0 }}</div>
        </div>
    </div>

    <div class="message">
        <h2>🔒 Sécurité & Professionnalisme</h2>
        <p>
            Chez CURSAGE, chaque utilisateur a accès uniquement aux informations
            nécessaires à son rôle.
            Vos données sont protégées, votre travail est valorisé,
            et la gestion reste claire et professionnelle.
        </p>
    </div>
</main>

<footer>
     <p class="info-text">
            Les éléments ci-dessous présentent les fonctionnalités disponibles dans l’application.
            Utilisez le menu en haut pour y accéder.
        </p>
    © {{ date('Y') }} CURSAGE — Plateforme professionnelle & sécurisée
</footer>

</body>
</html>
