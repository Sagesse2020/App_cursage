<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier le chien</title>

<style>
body{
    font-family:'Segoe UI',sans-serif;
    background:#eef2f5;
    padding:40px;
}
form{
    max-width:600px;
    margin:auto;
    background:#fff;
    padding:30px;
    border-radius:14px;
    box-shadow:0 10px 30px rgba(0,0,0,.1);
}
img{
    width:100%;
    height:220px;
    object-fit:cover;
    border-radius:10px;
    margin-bottom:15px;
}
label{display:block;margin-top:15px;font-weight:600;}
input,textarea{
    width:100%;
    padding:10px;
    margin-top:6px;
    border-radius:6px;
    border:1px solid #ccc;
}
button{
    margin-top:20px;
    background:#333;
    color:#fff;
    border:none;
    padding:12px;
    width:100%;
    border-radius:6px;
}
</style>
</head>

<body>

<form method="POST" enctype="multipart/form-data"
action="{{ route('chiens.update',$chien) }}">

@csrf
@method('PUT')

<input type="text" name="nom" value="{{ $chien->nom }}">

<input type="number" name="prix_base" value="{{ $chien->prix_base }}">

<input type="number" name="prix_vaccine" value="{{ $chien->prix_vaccine }}">

<input type="number" name="prix_dressage" value="{{ $chien->prix_dressage }}">

<input type="text" name="age" value="{{ $chien->age}}">

<input type="text" name="notes" value="{{ $chien->notes}}">

<button>Modifier</button>

</form>
</body>
</html>
