<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier service</title>
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

<h2>Modifier service</h2>

<form method="POST" action="{{ route('services.update',$service->id) }}" enctype="multipart/form-data">

@csrf
@method('PUT')

<input type="text" name="nom" value="{{ $service->nom }}">

<textarea name="description">
{{ $service->description }}
</textarea>

<input type="number" name="prix_vente" value="{{ $service->prix_vente }}">

<select name="statut">

<option value="en cours" @if($service->statut=='en cours') selected @endif>
En cours
</option>

<option value="termine" @if($service->statut=='termine') selected @endif>
Terminé
</option>

</select>

<button>Modifier</button>

</form>
</div>

</body>
</html>
