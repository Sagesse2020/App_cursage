<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CURSAGE — Gestion & Services Premium</title>

    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

    <style>
        /* ===============================
           RESET & BASE
        =============================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #0b1020;
            color: #f5f6fa;
            line-height: 1.6;
        }

        a { text-decoration: none; color: inherit; }

        /* ===============================
           NAVBAR
        =============================== */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 50px;
            background: linear-gradient(90deg, #0f2027, #203a43, #2c5364);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 5px 20px rgba(0,0,0,0.4);
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo-img {
            width: 55px;
            height: 55px;
            border-radius: 8px;
        }

        .logo-text {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: 2px;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 25px;
        }

        nav ul li a {
            font-weight: 500;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #00e6ff;
        }

        .btn-nav {
            background: #00e6ff;
            color: #0b1020;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: bold;
        }

        .btn-nav:hover {
            background: #00bcd4;
        }

        /* ===============================
           HERO
        =============================== */
        .hero {
            min-height: 90vh;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 80px 60px;
            background: linear-gradient(
                rgba(11,16,32,0.85),
                rgba(11,16,32,0.85)
            ),
            url('https://images.unsplash.com/photo-1521737604893-d14cc237f11d')
            no-repeat center/cover;
        }

        .hero-text {
            max-width: 600px;
        }

        .hero-text h1 {
            font-size: 48px;
            font-weight: 900;
            margin-bottom: 20px;
            color: #00e6ff;
        }

        .hero-text p {
            font-size: 20px;
            margin-bottom: 30px;
            color: #dcdde1;
        }

        .hero-buttons a {
            display: inline-block;
            margin-right: 15px;
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: bold;
        }

        .btn-primary {
            background: #00e6ff;
            color: #0b1020;
        }

        .btn-secondary {
            border: 2px solid #00e6ff;
            color: #00e6ff;
        }

        .btn-primary:hover {
            background: #00bcd4;
        }

        .btn-secondary:hover {
            background: #00e6ff;
            color: #0b1020;
        }

        /* ===============================
           SERVICES
        =============================== */
        .services {
            padding: 80px 60px;
            background: #0f172a;
        }

        .services h2 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 50px;
            color: #00e6ff;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 30px;
        }

        .service-card {
            background: #111827;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
            transition: transform 0.3s;
        }

        .service-card:hover {
            transform: translateY(-10px);
        }

        .service-card i {
            font-size: 40px;
            color: #00e6ff;
            margin-bottom: 20px;
        }

        .service-card h3 {
            font-size: 22px;
            margin-bottom: 15px;
        }

        .service-card p {
            color: #cbd5e1;
        }

        /* ===============================
           FOOTER
        =============================== */
        footer {
            background: #020617;
            padding: 40px;
            text-align: center;
        }

        footer p {
            margin-bottom: 15px;
            color: #94a3b8;
        }

        .social-icons a {
            margin: 0 10px;
            font-size: 22px;
            color: #00e6ff;
        }

        .social-icons a:hover {
            color: #00bcd4;
        }

    </style>
</head>

<body>

<!-- NAVBAR -->
<nav>
    <div class="logo-container">
        <img src="{{ asset('logo_cursage.png') }}" class="logo-img" alt="CURSAGE">
        <span class="logo-text">CURSAGE</span>
    </div>

    <ul>
      <li><a href="{{ route('clients.create') }}"><i class="fas fa-images"></i>Clients</a></li>
      <li><a href="{{ route('races.create') }}"><i class=" fas fa-microphone"></i>Races</a></li>
      <li><a href="{{ route('chiens.create') }}"><i class="fas fa-users"></i></a>Chiens</li>
      <li><a href="{{ route('login') }}" class="btn-nav">Connexion</a></li>
    </ul>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="hero-text">
        <h1>CURSAGE</h1>
        <p>
            Plateforme professionnelle de gestion, vente et services.
            Chiens de race, services informatiques, partenaires certifiés.
            Une vision. Une structure. Une entreprise.
        </p>

        <div class="hero-buttons">
            <a href="{{ route('register') }}" class="btn-primary">Créer un compte</a>
            <a href="{{ route('infos') }}" class="btn-secondary">Découvrir CURSAGE</a>
        </div>
    </div>
</section>

<!-- SERVICES -->
<section class="services">
    <h2>Nos Domaines d’Excellence</h2>

    <div class="services-grid">
        <div class="service-card">
            <i class="fas fa-dog"></i>
            <h3>Gestion & Vente de Chiens</h3>
            <p>Suivi complet, ventes sécurisées, partenaires contrôlés et commissions automatiques.</p>
        </div>

        <div class="service-card">
            <i class="fas fa-laptop-code"></i>
            <h3>Services Informatiques</h3>
            <p>Conception de sites, applications, réseaux, maintenance et solutions sur mesure.</p>
        </div>

        <div class="service-card">
            <i class="fas fa-users-cog"></i>
            <h3>Gestion des Partenaires</h3>
            <p>Accès cloisonné, transparence financière et contrôle administratif total.</p>
        </div>

        <div class="service-card">
            <i class="fas fa-chart-line"></i>
            <h3>Suivi Financier</h3>
            <p>Revenus, commissions, factures, statistiques et croissance maîtrisée.</p>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <p>&copy; {{ date('Y') }} CURSAGE — Tous droits réservés</p>

    <div class="social-icons">
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-whatsapp"></i></a>
        <a href="#"><i class="fab fa-linkedin"></i></a>
    </div>
</footer>
</body>
</html>

