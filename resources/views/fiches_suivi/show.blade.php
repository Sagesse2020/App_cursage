<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Détail fiche</title>

<style>

body{
    margin:0;
    font-family:'Segoe UI',sans-serif;
    background:#0f172a;
    color:#e2e8f0;
}

/* CONTAINER */
.container{
    max-width:700px;
    margin:50px auto;
    padding:20px;
}

/* CARD */
.card{
    background:rgba(17,24,39,.92);
    border-radius:20px;
    padding:25px;
    box-shadow:0 20px 50px rgba(0,0,0,.4);
    border:1px solid rgba(255,255,255,.06);
}

/* HEADER */
h1{
    font-size:22px;
    margin-bottom:15px;
    background:linear-gradient(90deg,#00e6ff,#4facfe);
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}

/* INFO GRID */
.grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:15px;
}

.box{
    background:#1e293b;
    padding:12px;
    border-radius:12px;
}

.box strong{
    color:#00e6ff;
}

/* FULL WIDTH */
.full{
    margin-top:15px;
    background:#1e293b;
    padding:12px;
    border-radius:12px;
}

/* BUTTON */
.back{
    display:inline-block;
    margin-top:20px;
    padding:10px 15px;
    background:#334155;
    color:white;
    border-radius:10px;
    text-decoration:none;
    font-weight:bold;
}

/* RESPONSIVE */
@media(max-width:600px){
    .grid{
        grid-template-columns:1fr;
    }
}

</style>
</head>

<body>

<div class="container">

    <div class="card">

        <h1>🔎 Détail fiche de suivi</h1>

        <div class="grid">

            <div class="box">
                <strong>Chien</strong><br>
                {{ $fiche->chien->nom }}
            </div>

            <div class="box">
                <strong>Date</strong><br>
                {{ $fiche->date_suivi }}
            </div>

            <div class="box">
                <strong>Poids</strong><br>
                {{ $fiche->poids }} kg
            </div>

            <div class="box">
                <strong>Température</strong><br>
                {{ $fiche->temperature }} °C
            </div>

        </div>

        <div class="full">
            <strong>État général :</strong><br>
            {{ $fiche->etat_general }}
        </div>

        <div class="full">
            <strong>Alimentation :</strong><br>
            {{ $fiche->alimentation }}
        </div>

        <div class="full">
            <strong>Observation :</strong><br>
            {{ $fiche->observation }}
        </div>

        <a href="{{ route('fiches_suivi.index') }}" class="back">
            ⬅ Retour
        </a>

    </div>

</div>

</body>
</html>