<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier publication</title>
<style>
body{font-family:Segoe UI;background:#f4f6f8;padding:40px}
form{
    max-width:700px;
    margin:auto;
    background:#fff;
    padding:30px;
    border-radius:18px;
}
input,textarea{
    width:100%;
    padding:12px;
    margin-top:10px;
}
button{
    margin-top:20px;
    background:#333;
    color:#fff;
    border:none;
    padding:14px;
    border-radius:8px;
    width:100%;
}
</style>
</head>
<body>

<h1>Modifier transaction</h1>

<form method="POST" action="{{ route('transactions.update',$transaction) }}" enctype="multipart/form-data">

@csrf
@method('PUT')

<select name="type">

<option value="paiement_client" {{ $transaction->type=='paiement_client'?'selected':'' }}>Paiement client</option>

<option value="paiement_partenaire" {{ $transaction->type=='paiement_partenaire'?'selected':'' }}>Paiement partenaire</option>

<option value="versement_cursage" {{ $transaction->type=='versement_cursage'?'selected':'' }}>Versement cursage</option>

<option value="autre" {{ $transaction->type=='autre'?'selected':'' }}>Autre</option>

</select>

<input type="number" name="montant" value="{{ $transaction->montant }}">

<input type="text" name="destinataire" value="{{ $transaction->destinataire }}">

<textarea name="notes">{{ $transaction->notes }}</textarea>

<button>Mettre à jour</button>

</form>

</div>

</body>
</html>
