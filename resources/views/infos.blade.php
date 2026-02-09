<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos de CURSAGE</title>
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <style>
        body { margin:0; font-family:"Segoe UI", sans-serif; background:#0b1020; color:#fff; }
        a { text-decoration:none; color:inherit; }
        header { background: linear-gradient(rgba(11,16,32,0.8), rgba(11,16,32,0.8)), url('https://images.unsplash.com/photo-1551288049-bebda4e38f71') center/cover; text-align:center; padding:80px 30px; }
        header h1 { font-size:48px; margin-bottom:20px; color:#00e6ff; }
        header p { font-size:20px; margin-bottom:30px; color:#cbd5e1; }
        section { padding:50px 30px; }
        section h2 { font-size:32px; margin-bottom:20px; color:#00e6ff; }
        section p { font-size:16px; line-height:1.6; color:#cbd5e1; margin-bottom:20px; }
        .services { display:grid; grid-template-columns: repeat(auto-fit,minmax(250px,1fr)); gap:25px; margin-top:30px; }
        .card { background:#111827; padding:25px; border-radius:15px; text-align:center; box-shadow:0 5px 15px rgba(0,0,0,0.5); transition:0.3s; }
        .card:hover { transform: translateY(-8px); }
        .card i { font-size:36px; color:#00e6ff; margin-bottom:15px; }
        .card h3 { font-size:20px; margin-bottom:10px; }
        .card p { font-size:14px; color:#94a3b8; }
        footer { padding:20px; text-align:center; background:#020617; color:#94a3b8; }
        .btn-contact { padding:12px 25px; background:#00e6ff; color:#0b1020; font-weight:bold; border:none; border-radius:10px; cursor:pointer; font-size:16px; transition:0.3s; }
        .btn-contact:hover { background:#00bcd4; }
    </style>
</head>
<body>

<!-- HEADER -->
<header>
    <h1>CURSAGE - Notre Entreprise</h1>
    <p>Expertise, professionnalisme et innovation au service de la gestion et des services informatiques.</p>
</header>

<!-- À propos -->
<section>
    <h2>Qui sommes-nous ?</h2>
    <p>CURSAGE est une entreprise spécialisée dans la sécurité , la supervision des chiens et partenaires, ainsi que la mise en place de services informatiques professionnels pour les entreprises. Notre mission est d'offrir des solutions fiables, sécurisées et innovantes pour faciliter le suivi des activités et optimiser les performances.</p>
</section>

<!-- Services -->
<section>
    <h2>Nos Services</h2>
    <div class="services">
        <div class="card">
            <i class="fas fa-dog"></i>
            <h3>Gestion Canine</h3>
            <p>Suivi complet des chiens, ventes, partenaires et commissions pour un contrôle total de vos activités.</p>
        </div>
        <div class="card">
            <i class="fas fa-laptop-code"></i>
            <h3>Services Informatiques</h3>
            <p>Développement de sites web, applications, maintenance réseau et sécurité informatique professionnelle.</p>
        </div>
        <div class="card">
            <i class="fas fa-chart-line"></i>
            <h3>Finances & Transactions</h3>
            <p>Suivi des paiements, factures, rapports financiers et analyses détaillées pour une gestion optimale.</p>
        </div>
        <div class="card">
            <i class="fas fa-user-cog"></i>
            <h3>Administration & Utilisateurs</h3>
            <p>Gestion sécurisée des utilisateurs, rôles et permissions pour un accès contrôlé et fiable.</p>
        </div>
    </div>
</section>

<!-- Contact -->
<section style="text-align:center;">
    <h2>Contactez-nous</h2>
    <p>Pour plus d'informations sur nos services ou pour une demande personnalisée, n'hésitez pas à nous contacter.</p>
    <button class="btn-contact" onclick="window.location.href='mailto:contact@cursage.com'">Nous contacter</button>
</section>

<!-- FOOTER -->
<footer>
    <p>&copy; 2025 CURSAGE - Tous droits réservés</p>
</footer>

</body>
</html>
