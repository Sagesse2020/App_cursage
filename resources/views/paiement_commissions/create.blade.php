<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Nouvelle commission</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
font-family:'Segoe UI',sans-serif;
background:#f1f5f9;
padding:25px;
color:#1e293b;
}

.container{
max-width:900px;
margin:auto;
background:white;
padding:35px;
border-radius:20px;
box-shadow:0 10px 30px rgba(0,0,0,.08);
}

h1{
text-align:center;
margin-bottom:30px;
color:#0f172a;
font-size:30px;
}

.form-grid{
display:grid;
grid-template-columns:1fr 1fr;
gap:20px;
}

.form-group{
display:flex;
flex-direction:column;
}

label{
font-weight:600;
margin-bottom:8px;
}

input,
select,
textarea{
padding:12px;
border:1px solid #cbd5e1;
border-radius:12px;
font-size:15px;
}

textarea{
resize:none;
height:120px;
}

.full{
grid-column:1/-1;
}

.btn{
background:#2563eb;
color:white;
border:none;
padding:14px;
border-radius:12px;
cursor:pointer;
font-weight:bold;
font-size:16px;
width:100%;
transition:.3s;
margin-top:10px;
}

.btn:hover{
background:#1d4ed8;
}

@media(max-width:768px){

.form-grid{
grid-template-columns:1fr;
}

.container{
padding:20px;
}

}

</style>

</head>

<body>

<div class="container">

<h1>💰 Nouveau paiement commission</h1>

<form action="{{ route('paiement_commissions.store') }}" method="POST">

@csrf

<div class="form-grid">

<!-- Commission partenaire -->
<div class="form-group full">
<label>Commission partenaire</label>
<select name="partenaire_commission_id" required>
<option value="">-- Choisir une commission --</option>

@foreach($commissions as $commission)
<option value="{{ $commission->id }}">
{{ $commission->partenaire->nom }}
@if($commission->produit)
- 📦 {{ $commission->produit->nom }}
@elseif($commission->chien)
- 🐶 {{ $commission->chien->nom }}
@endif
</option>
@endforeach

</select>
</div>

<!-- Montant -->
<div class="form-group">
<label>Montant</label>
<input type="number" name="montant" step="0.01" required>
</div>

<!-- Date paiement -->
<div class="form-group">
<label>Date de paiement</label>
<input type="date" name="date_paiement" required>
</div>

<!-- Mode paiement -->
<div class="form-group">
<label>Mode de paiement</label>
<select name="mode_paiement" required>
<option value="espece">Espèce</option>
<option value="virement">Virement</option>
<option value="mobile_money">Mobile Money</option>
</select>
</div>

<!-- Statut -->
<div class="form-group">
<label>Statut</label>
<select name="statut">
<option value="en_attente">En attente</option>
<option value="paye">Payé</option>
<option value="annule">Annulé</option>
</select>
</div>

<!-- Référence -->
<div class="form-group full">
<label>Référence</label>
<input type="text" name="reference" placeholder="Ex: PAY-2026-001">
</div>

<!-- Observation -->
<div class="form-group full">
<label>Observation</label>
<textarea name="observation" placeholder="Note ou commentaire..."></textarea>
</div>

</div>

<button class="btn">
💾 Enregistrer le paiement
</button>

</form>

</div>

</body>
</html>