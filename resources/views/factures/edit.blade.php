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

<h2>Modifier une facture</h2>

<form method="POST" action="{{ route('factures.update',$facture->id) }}" enctype="multipart/form-data">

@csrf
@method('PUT')

<label>Vente</label>

<select name="vente_id">

@foreach($ventes as $vente)

<option value="{{ $vente->id }}"
@if($vente->id==$facture->vente_id) selected @endif>

Vente #{{ $vente->id }}

</option>

@endforeach

</select>

<label>Type</label>

<input type="text" name="type" value="{{ $facture->type }}">

<button>Modifier</button>

</form>

</div>

</body>
</html>
