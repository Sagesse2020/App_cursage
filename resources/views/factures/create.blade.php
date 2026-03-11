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

input,select,textarea{
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

<h2>Créer facture</h2>

<form method="POST" action="{{ route('factures.store') }}" enctype="multipart/form-data">

@csrf

<label>Vente</label>

<select name="vente_id">

@foreach($ventes as $vente)

<option value="{{ $vente->id }}">
Vente #{{ $vente->id }}
</option>

@endforeach

</select>

<label>Type</label>

<input type="text" name="type" value="vente">

<button>Enregistrer</button>

</form>

</div>
</body>
</html>
