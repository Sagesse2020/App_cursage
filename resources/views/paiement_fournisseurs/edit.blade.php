<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Modifier paiement fournisseur</title>

<style>

/* même design que create */

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

input,select,textarea{
padding:12px;
border-radius:12px;
border:1px solid #cbd5e1;
}

.full{
grid-column:1/-1;
}

.btn{
background:#2563eb;
color:white;
padding:14px;
border:none;
border-radius:12px;
width:100%;
font-weight:bold;
margin-top:10px;
}

</style>

</head>

<body>

<div class="container">

<h1>✏️ Modifier paiement fournisseur</h1>

<form action="{{ route('paiement_fournisseurs.update',$paiementFournisseur) }}" method="POST">

@csrf
@method('PUT')

<div class="form-grid">

<div class="form-group full">
<label>Fournisseur</label>
<select name="fournisseur_id">

@foreach($fournisseurs as $f)

<option value="{{ $f->id }}"
@if($paiementFournisseur->fournisseur_id == $f->id) selected @endif>
{{ $f->nom }}
</option>

@endforeach

</select>
</div>

<div class="form-group">
<label>Montant</label>
<input type="number" name="montant"
value="{{ $paiementFournisseur->montant }}">
</div>

<div class="form-group">
<label>Date</label>
<input type="date" name="date_paiement"
value="{{ $paiementFournisseur->date_paiement }}">
</div>

<div class="form-group">
<label>Mode</label>
<input type="text" name="mode_paiement"
value="{{ $paiementFournisseur->mode_paiement }}">
</div>

<div class="form-group">
<label>Statut</label>
<select name="statut">

<option value="paye"
@if($paiementFournisseur->statut=='paye') selected @endif>
Payé
</option>

<option value="en_attente"
@if($paiementFournisseur->statut=='en_attente') selected @endif>
En attente
</option>

</select>
</div>

<div class="form-group full">
<label>Observation</label>
<textarea name="observation">{{ $paiementFournisseur->observation }}</textarea>
</div>

</div>

<button class="btn">💾 Modifier</button>

</form>

</div>

</body>
</html>
