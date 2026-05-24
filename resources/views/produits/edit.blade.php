<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier produit</title>
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

<h1>Modifier produit</h1>

<form method="POST" action="{{ route('produits.update',$produit->id) }}" enctype="multipart/form-data">
@csrf
@method('PUT')

<input type="text" name="nom" value="{{ $produit->nom }}"><br>

<textarea name="description">{{ $produit->description }}</textarea><br>

<button>Modifier</button>

</form>
</body>
</html>
