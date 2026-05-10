<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>À propos de CURSAGE</title>
<link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

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
}

/* ================= HEADER ================= */
header{
    text-align:center;
    padding:90px 20px;
    background:linear-gradient(rgba(11,16,32,0.85), rgba(11,16,32,0.85)),
    url('https://images.unsplash.com/photo-1551288049-bebda4e38f71') center/cover;
}

header h1{
    font-size:42px;
    color:#00e6ff;
    margin-bottom:15px;
}

header p{
    font-size:18px;
    color:#cbd5e1;
    max-width:800px;
    margin:auto;
}

/* ================= SECTIONS ================= */
section{
    padding:60px 20px;
    max-width:1100px;
    margin:auto;
}

section h2{
    font-size:30px;
    color:#00e6ff;
    margin-bottom:20px;
}

section p{
    color:#cbd5e1;
    line-height:1.7;
    font-size:15px;
}

/* ================= CARDS ================= */
.services{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:20px;
    margin-top:30px;
}

.card{
    background:#111827;
    padding:25px;
    border-radius:15px;
    text-align:center;
    transition:0.3s;
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
    margin-bottom:10px;
}

.card p{
    font-size:14px;
    color:#94a3b8;
}

/* ================= FOOTER ================= */
footer{
    background:#020617;
    text-align:center;
    padding:15px;
    color:#94a3b8;
    font-size:14px;
}

/* ================= BUTTON ================= */
.btn-contact{
    margin-top:20px;
    padding:12px 20px;
    background:#00e6ff;
    border:none;
    border-radius:8px;
    color:#0b1020;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s;
}

.btn-contact:hover{
    background:#00bcd4;
}
</style>
</head>

<body>

<!-- HEADER -->
<header>
    <h1>CURSAGE</h1>
    <p>
        Plateforme professionnelle de gestion intelligente des activités canines, 
        des services informatiques et du suivi administratif et financier.
    </p>
</header>

<!-- ABOUT -->
<section>
    <h2>Qui sommes-nous ?</h2>
    <p>
        CURSAGE est une plateforme de gestion complète conçue pour centraliser
        les activités liées à la gestion canine, aux services informatiques et à
        l’administration des opérations internes de CURSAGE
        <br><br>
        L’objectif est d’offrir une solution sécurisée, moderne et efficace permettant
        de suivre les chiens, les ventes, les services, les utilisateurs, ainsi que
        les performances globales de l’organisation.
    </p>
</section>

<!-- VISION APP -->
<section>
    <h2>Vision de l’application</h2>
    <p>
        CURSAGE a été conçu pour permettre :
        <br><br>
        ✔ Une gestion centralisée des chiens (disponibles, vendus, suivi)<br>
        ✔ Une gestion des services informatiques (en cours, terminés, maintenance)<br>
        ✔ Un suivi des finances et transactions avec transparence<br>
        ✔ Une administration sécurisée des utilisateurs selon leurs rôles<br>
        ✔ Une traçabilité complète des actions dans le système
    </p>
</section>

<!-- SERVICES -->
<section>
    <h2>Modules principaux</h2>

    <div class="services">

        <div class="card">
            <i class="fas fa-dog"></i>
            <h3>Gestion Canine</h3>
            <p>
                Suivi des chiens, ventes, statuts et partenaires avec contrôle complet
                des opérations liées aux animaux.
            </p>
        </div>

        <div class="card">
            <i class="fas fa-laptop-code"></i>
            <h3>Services IT</h3>
            <p>
                Gestion des services informatiques : développement, maintenance, support et suivi.
            </p>
        </div>

        <div class="card">
            <i class="fas fa-chart-line"></i>
            <h3>Finance</h3>
            <p>
                Suivi des paiements, factures, rapports financiers et analyse des performances.
            </p>
        </div>

        <div class="card">
            <i class="fas fa-user-shield"></i>
            <h3>Sécurité</h3>
            <p>
                Gestion des rôles, permissions et contrôle des accès utilisateurs.
            </p>
        </div>

    </div>
</section>

<!-- CONTACT -->
<section style="text-align:center;">
    <h2>Contact</h2>
    <p>
        Besoin d’assistance ou d’informations sur CURSAGE ?
        Notre équipe est disponible pour vous accompagner.
    </p>

    <button class="btn-contact"
        onclick="window.location.href='mailto:contact@cursage.com'">
        Nous contacter
    </button>
</section>

<!-- FOOTER -->
<footer>
    © {{ date('Y') }} CURSAGE — Plateforme professionnelle & sécurisée
</footer>

</body>
</html>