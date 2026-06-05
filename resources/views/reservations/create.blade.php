<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Nouvelle Réservation</title>

<style>

body{
    font-family:"Segoe UI";
    background: radial-gradient(circle at top left,#111827,#020617 60%);
    color:#f5f6fa;
    padding:30px;
}

.container{
    max-width:900px;
    margin:auto;
    background:rgba(17,24,39,.8);
    padding:30px;
    border-radius:20px;
    border:1px solid rgba(255,255,255,.05);
    box-shadow:0 10px 40px rgba(0,0,0,.5);
}

h1{
    margin-bottom:25px;
    color:#00e6ff;
}

.grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:15px;
}

input,select,textarea{
    width:100%;
    padding:12px;
    border-radius:10px;
    border:none;
    outline:none;
    background:#0f172a;
    color:white;
}

textarea{
    min-height:120px;
}

.btn{
    margin-top:20px;
    background:linear-gradient(135deg,#00e6ff,#007cf0);
    border:none;
    padding:12px 18px;
    border-radius:12px;
    color:white;
    cursor:pointer;
    font-weight:bold;
}

.btn:hover{
    transform:scale(1.03);
}

.label{
    font-size:13px;
    margin-bottom:6px;
    display:block;
    color:#94a3b8;
}

</style>

</head>

<body>

<div class="container">

<h1>📅 Nouvelle Réservation</h1>

<form method="POST" action="{{ route('reservations.store') }}">
@csrf

<div class="grid">

<div>
<span class="label">🐶 Chien</span>
<select name="chien_id" required>
<option value="">Choisir un chien</option>
@foreach($chiens as $chien)
<option value="{{ $chien->id }}">{{ $chien->nom }}</option>
@endforeach
</select>
</div>

<div>
<span class="label">👤 Nom client</span>
<input type="text" name="client_nom" required>
</div>

<div>
<span class="label">📞 Contact client</span>
<input type="text" name="client_contact">
</div>

<div>
<span class="label">📅 Date réservation</span>
<input type="date" name="date_reservation" required>
</div>

<div>
<span class="label">📌 Statut</span>
<select name="statut">
<option value="attente">Attente</option>
<option value="confirmee">Confirmée</option>
<option value="annulee">Annulée</option>
</select>
</div>

<div>
<span class="label">💰 Montant versé</span>
<input type="number" name="montant_verse">
</div>

</div>

<br>

<span class="label">📝 Note</span>
<textarea name="note"></textarea>

<button class="btn">Enregistrer réservation</button>

</form>

</div>

</body>
</html>