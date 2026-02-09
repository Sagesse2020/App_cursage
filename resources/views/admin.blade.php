<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration CURSAGE</title>

    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

    <style>
        *{margin:0;padding:0;box-sizing:border-box;font-family:"Segoe UI",Tahoma,Verdana,sans-serif}
        body{background:#0b1020;color:#f5f6fa;min-height:100vh;display:flex;flex-direction:column}
        a{text-decoration:none;color:inherit}

        nav{
            display:flex;justify-content:space-between;align-items:center;
            padding:15px 30px;
            background:linear-gradient(90deg,#020617,#0f172a);
            box-shadow:0 4px 15px rgba(0,0,0,.6)
        }
        .logo{width:180px;max-height:70px;object-fit:contain}
        nav ul{display:flex;gap:14px;list-style:none;flex-wrap:wrap}
        nav ul li a{
            padding:8px 12px;border-radius:6px;font-size:14px;
            transition:.3s
        }
        nav ul li a i{margin-right:6px;color:#00e6ff}
        nav ul li a:hover{background:rgba(0,230,255,.15);color:#00e6ff}

        .admin-header{
            background:linear-gradient(rgba(11,16,32,.9),rgba(11,16,32,.9)),
            url('https://images.unsplash.com/photo-1551288049-bebda4e38f71') center/cover;
            padding:60px 30px;text-align:center
        }
        .admin-header h1{font-size:42px;color:#00e6ff}
        .admin-header p{color:#cbd5e1;font-size:18px}

        .dashboard{padding:50px 30px}
        .cards{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
            gap:25px
        }
        .card{
            background:#111827;padding:25px;border-radius:15px;
            box-shadow:0 10px 30px rgba(0,0,0,.5);
            transition:.3s
        }
        .card:hover{transform:translateY(-8px)}
        .card i{font-size:36px;color:#00e6ff;margin-bottom:15px}
        .card h3{margin-bottom:10px}
        .card p{color:#94a3b8;font-size:14px}

        footer{
            margin-top:auto;background:#020617;padding:20px;
            text-align:center;color:#94a3b8
        }
    </style>
</head>

<body>

<!-- ================= NAVBAR ================= -->
<nav>
    <img src="{{ asset('logo_chorale.png') }}" class="logo">

    <ul>
        {{-- Fondateurs (2 & 3) --}}
        @if(auth()->user()->role >= 2)
            <li><a href="{{ route('races') }}"><i class="fas fa-dog"></i>Races</a></li>
            <li><a href="{{ route('chiens') }}"><i class="fas fa-paw"></i>Chiens</a></li>
            <li><a href="{{ route('clients') }}"><i class="fas fa-paw"></i>Clients</a></li>
            <li><a href="{{ route('journal.index') }}"><i class="fas fa-book"></i>Journal</a></li>
        @endif

        {{-- Super Admin uniquement (TOI) --}}
        @if(auth()->user()->role == 3)
            <li><a href="{{ route('tresorerie.index') }}"><i class="fas fa-coins"></i>Trésorerie</a></li>
            <li><a href="{{ route('gestion.index') }}"><i class="fas fa-cogs"></i>Gestion</a></li>
            <li><a href="{{ route('graphique') }}"><i class="fas fa-chart-line"></i>Statistiques</a></li>
        @endif

        {{-- Tous --}}
        <li><a href="{{ route('profil') }}"><i class="fas fa-user"></i>Profil</a></li>
        <li><a href="{{ route('cloture') }}"><i class="fas fa-sign-out-alt"></i>Déconnexion</a></li>
    </ul>
</nav>

<!-- ================= HEADER ================= -->
<section class="admin-header">
    <h1>Administration CURSAGE</h1>
    <p>
        @if(auth()->user()->role == 3)
            Vision stratégique • Contrôle total
        @elseif(auth()->user()->role == 2)
            Opérations terrain • Suivi global
        @else
            Partenariat • Collaboration sécurisée
        @endif
    </p>
</section>

<!-- ================= DASHBOARD ================= -->
<section class="dashboard">
    <div class="cards">

        @if(auth()->user()->role == 3)
        <div class="card">
            <i class="fas fa-users-cog"></i>
            <h3>Gestion des utilisateurs</h3>
            <p>Création, rôles, permissions et sécurité.</p>
        </div>
        @endif

        @if(auth()->user()->role >= 2)
        <div class="card">
            <i class="fas fa-dog"></i>
            <h3>Chiens & partenaires</h3>
            <p>Produits, ventes et commissions traçables.</p>
        </div>
        @endif

        <div class="card">
            <i class="fas fa-laptop-code"></i>
            <h3>Services CURSAGE</h3>
            <p>Présentation et suivi des services via l’application.</p>
        </div>

        @if(auth()->user()->role == 3)
        <div class="card">
            <i class="fas fa-chart-line"></i>
            <h3>Finances & statistiques</h3>
            <p>Chiffre d’affaires, bénéfices, réserves.</p>
        </div>
        @endif

    </div>
</section>
<footer>
    <p>&copy; 2025 CURSAGE — Administration centrale</p>
</footer>
</body>
</html>
