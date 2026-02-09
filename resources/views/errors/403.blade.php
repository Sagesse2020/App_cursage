<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accès refusé</title>
    <style>
        body {
            background:#0b1020;
            color:#fff;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
            font-family:Segoe UI;
        }
        .box {
            text-align:center;
        }
        h1 { color:#ff4d4d; }
    </style>
</head>
<body>
<div class="box">
    <h1>⛔ Accès interdit</h1>
    <p>Cette section est réservée à l’administrateur principal (niveau 3).</p>
    <a href="{{ url()->previous() }}">⬅ Retour</a>
</div>
</body>
</html>
