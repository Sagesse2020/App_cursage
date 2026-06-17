<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Créer un Client</title>

<style>

/* ================= GLOBAL ================= */
*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:"Segoe UI",Tahoma,sans-serif;
}

body{
background:#f4f7fa;
padding:20px;
color:#1f2937;
}

/* ================= CONTAINER ================= */
.container{
max-width:700px;
margin:auto;
background:#fff;
padding:30px;
border-radius:16px;
box-shadow:0 10px 25px rgba(0,0,0,.08);
}

/* ================= TITLE ================= */
h1{
text-align:center;
margin-bottom:25px;
color:#0d6efd;
font-size:2rem;
}

/* ================= ERRORS ================= */
.errors{
background:#ffe5e5;
padding:12px;
border-radius:10px;
margin-bottom:15px;
color:#dc3545;
}

/* ================= FORM ================= */
form{
display:flex;
flex-direction:column;
gap:15px;
}

input{
padding:12px;
border:1px solid #d1d5db;
border-radius:10px;
outline:none;
transition:.3s;
}

input:focus{
border-color:#0d6efd;
box-shadow:0 0 0 3px rgba(13,110,253,.15);
}

/* ================= BUTTON ================= */
button{
padding:12px;
background:#0d6efd;
color:white;
border:none;
border-radius:10px;
cursor:pointer;
font-weight:600;
transition:.3s;
}

button:hover{
background:#0b5ed7;
transform:translateY(-2px);
}

/* ================= RESPONSIVE ================= */
@media(max-width:768px){
.container{
padding:20px;
}

h1{
font-size:1.6rem;
}
}

</style>
</head>

<body>

<div class="container">

<h1>➕ Ajouter un client</h1>

@if($errors->any())
<div class="errors">
<ul>
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<form method="POST" action="{{ route('clients.store') }}">
@csrf

<input type="text" name="nom" placeholder="Nom complet" value="{{ old('nom') }}" required>

<input type="email" name="email" placeholder="Adresse email" value="{{ old('email') }}" required>

<input type="text" name="telephone" placeholder="Téléphone" value="{{ old('telephone') }}" required>

<input type="text" name="adresse" placeholder="Adresse complète" value="{{ old('adresse') }}" required>

<input type="password" name="password" placeholder="Mot de passe" required>

<input type="password" name="password_confirmation" placeholder="Confirmer mot de passe" required>

<button type="submit">Créer le client</button>

</form>

</div>

</body>
</html>