<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nouvelle Réservation</title>

<style>

body{
    font-family:"Segoe UI",sans-serif;
    background: radial-gradient(circle at top left,#111827,#020617 60%);
    color:#f5f6fa;
    padding:30px;
}

/* container */
.container{
    max-width:900px;
    margin:auto;
    background:rgba(17,24,39,.85);
    padding:30px;
    border-radius:20px;
    border:1px solid rgba(255,255,255,.05);
    box-shadow:0 15px 40px rgba(0,0,0,.5);
}

/* title */
h1{
    margin-bottom:25px;
    color:#00e6ff;
    font-size:28px;
}

/* grid */
.grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:15px;
}

/* field */
.field{
    display:flex;
    flex-direction:column;
}

label{
    font-size:13px;
    margin-bottom:6px;
    color:#94a3b8;
}

/* inputs */
input,select,textarea{
    width:100%;
    padding:12px;
    border-radius:10px;
    border:none;
    outline:none;
    background:#0f172a;
    color:white;
    transition:.2s;
}

input:focus,select:focus,textarea:focus{
    outline:1px solid #00e6ff;
}

/* textarea */
textarea{
    min-height:110px;
    resize:none;
}

/* button */
.btn{
    margin-top:20px;
    background:linear-gradient(135deg,#00e6ff,#007cf0);
    border:none;
    padding:12px 18px;
    border-radius:12px;
    color:white;
    cursor:pointer;
    font-weight:bold;
    transition:.2s;
}

.btn:hover{
    transform:scale(1.03);
}

/* sections */
.section-title{
    margin:20px 0 10px;
    font-size:14px;
    color:#00e6ff;
    text-transform:uppercase;
}

</style>

</head>

<body>

<div class="container">

<h1>📅 Nouvelle Réservation</h1>

<form method="POST" action="{{ route('reservations.store') }}">
@csrf

<!-- SECTION CLIENT / CHIEN -->
<div class="section-title">Informations principales</div>

<div class="grid">

    <div class="field">
        <label>👤 Client</label>
        <select name="client_id" required>
            <option value="">Choisir client</option>
            @foreach($clients as $client)
                <option value="{{ $client->id }}">{{ $client->nom }}</option>
            @endforeach
        </select>
    </div>

    <div class="field">
        <label>🐶 Chien</label>
        <select name="chien_id" required>
            <option value="">Choisir chien</option>
            @foreach($chiens as $chien)
                <option value="{{ $chien->id }}">{{ $chien->nom }}</option>
            @endforeach
        </select>
    </div>

</div>

<!-- SECTION FINANCE -->
<div class="section-title">Paiement</div>

<div class="grid">

    <div class="field">
        <label>💰 Montant avancé</label>
        <input type="number" step="0.01" name="montant_avance">
    </div>

    <div class="field">
        <label>💵 Montant versé</label>
        <input type="number" step="0.01" name="montant_verse">
    </div>

    <div class="field">
        <label>💳 Reste à payer</label>
        <input type="number" step="0.01" name="reste_a_payer">
    </div>

</div>

<!-- SECTION RESERVATION -->
<div class="section-title">Détails réservation</div>

<div class="grid">

    <div class="field">
        <label>📅 Date réservation</label>
        <input type="date" name="date_reservation" required>
    </div>

    <div class="field">
        <label>📌 Statut</label>
        <select name="statut">
            <option value="attente">Attente</option>
            <option value="confirmee">Confirmée</option>
            <option value="annulee">Annulée</option>
        </select>
    </div>

</div>

<button class="btn">Enregistrer réservation</button>

</form>

</div>

</body>
</html>