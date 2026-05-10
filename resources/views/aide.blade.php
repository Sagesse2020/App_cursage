<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Aide - CURSAGE</title>
<link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

<style>
body{
    margin:0;
    font-family:"Segoe UI",sans-serif;
    background:#0b1020;
    color:#fff;
}

header{
    text-align:center;
    padding:80px 20px;
    background:#020617;
}

header h1{
    color:#00e6ff;
    font-size:40px;
}

section{
    max-width:1000px;
    margin:auto;
    padding:50px 20px;
}

.card{
    background:#111827;
    padding:20px;
    border-radius:12px;
    margin-bottom:15px;
}

.card h3{
    color:#00e6ff;
    margin-bottom:10px;
}

.card p{
    color:#cbd5e1;
    font-size:14px;
    line-height:1.6;
}

footer{
    text-align:center;
    padding:15px;
    background:#020617;
    color:#94a3b8;
}
</style>
</head>

<body>

<header>
    <h1>Centre d’aide CURSAGE</h1>
    <p>Guide d’utilisation de la plateforme</p>
</header>

<section>

    <div class="card">
        <h3>📌 Comment utiliser CURSAGE ?</h3>
        <p>
            Connectez-vous avec votre compte utilisateur. Selon votre rôle,
            vous aurez accès aux modules chiens, services, finances ou administration.
        </p>
    </div>

    <div class="card">
        <h3>🐶 Gestion des chiens</h3>
        <p>
            Accédez à la liste des chiens disponibles, vendus et leurs statuts.
            Chaque modification est enregistrée automatiquement.
        </p>
    </div>

    <div class="card">
        <h3>💼 Services informatiques</h3>
        <p>
            Consultez les services en cours ou terminés et suivez leur progression.
        </p>
    </div>

    <div class="card">
        <h3>💰 Finances</h3>
        <p>
            Visualisez les transactions, factures et rapports financiers générés par le système.
        </p>
    </div>

    <div class="card">
        <h3>🔐 Sécurité</h3>
        <p>
            Chaque utilisateur est limité selon son rôle pour garantir la sécurité des données.
        </p>
    </div>

    <div class="card">
        <h3>🆘 Besoin d’assistance ?</h3>
        <p>
            Contactez l’administrateur ou envoyez un mail à support@cursage.com
        </p>
    </div>

</section>

<footer>
    © {{ date('Y') }} CURSAGE — Aide & support
</footer>

</body>
</html>