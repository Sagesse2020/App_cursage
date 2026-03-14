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
action="{{ route('races.update',$race) }}">

@csrf
@method('PUT')

<input type="text" name="nom" value="{{ $race->nom }}">

<input type="text" name="origine" value="{{ $race->origine }}">

<input type="text" name="description" value="{{ $race->description }}">

<button>Modifier</button>

</form>
</body>
</html>
