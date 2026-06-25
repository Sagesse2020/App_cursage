<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Créer une transaction</title>
<style>

.form-container{
max-width:600px;
margin:auto;
padding:30px;
}

input,select,textarea,label{
width:100%;
padding:10px;
margin:10px 0;
background:#111827;
border:none;
color:white;
border-radius:6px;
}

button{
background:#00e6ff;
padding:12px;
border:none;
border-radius:6px;
cursor:pointer;
}
</style>
</head>
<body>

<h1>Nouvelle transaction</h1>

<form method="POST" action="{{ route('transactions.store') }}" enctype="multipart/form-data">

@csrf

<label>Type</label>

<select name="type">

<option value="paiement_client">Paiement client</option>

<option value="paiement_partenaire">Paiement partenaire</option>

<option value="versement_cursage">Versement cursage</option>

<option value="autre">Autre</option>

</select>

<label>Montant</label>

<input type="number" name="montant" required>

<label>Destinataire</label>

<input type="text" name="destinataire">


<label>Vente liée</label>

<select name="vente_id">

<option value="">Aucune</option>

@foreach($ventes as $vente)

<option value="{{ $vente->id }}">{{ $vente->id }}</option>

@endforeach

</select>
<label>Date transaction</label>

<input type="date" name="date_transaction" required>

<label>Notes</label>

<textarea name="notes"></textarea>

<button>Enregistrer</button>

</form>

</div>

</body>
</body>
</html>
