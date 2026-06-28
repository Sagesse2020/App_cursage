
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name')}}-Formulaire paiement du fournisseur</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Si tu as des styles -->
     <style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Segoe UI',sans-serif;
    background:#f1f5f9;
    color:#1e293b;
}

/* NAVBAR */

.navbar{
    background:white;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
    padding:15px 30px;
}

.navbar ul{
    list-style:none;
    display:flex;
    gap:20px;
    flex-wrap:wrap;
}

.navbar a{
    text-decoration:none;
    color:#334155;
    font-weight:600;
    transition:.3s;
}

.navbar a:hover{
    color:#2563eb;
}

/* BUTTONS */

.btn{
    background:#2563eb;
    color:white;
    padding:12px 18px;
    border:none;
    border-radius:10px;
    cursor:pointer;
    transition:.3s;
}

.btn:hover{
    background:#1d4ed8;
}

/* FORM */

form{
    background:white;
    padding:30px;
    border-radius:18px;
    box-shadow:0 8px 25px rgba(0,0,0,.08);
}

input,
textarea,
select{
    width:100%;
    padding:12px;
    border:1px solid #cbd5e1;
    border-radius:10px;
    margin-top:6px;
    margin-bottom:15px;
}

input:focus,
textarea:focus,
select:focus{
    outline:none;
    border-color:#2563eb;
    box-shadow:0 0 5px rgba(37,99,235,.3);
}

/* CONTAINER */

.container{
    width:100%;
    max-width:1200px;
    margin:auto;
    padding:20px;
}

/* CARD */

.card{
    background:white;
    border-radius:18px;
    box-shadow:0 8px 25px rgba(0,0,0,.08);
    overflow:hidden;
}

/* TITLES */

h1,h2,h3{
    color:#0f172a;
}

/* IMAGE */

img{
    max-width:100%;
}

/* RESPONSIVE */

@media(max-width:768px){

    .navbar ul{
        flex-direction:column;
    }

}
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg_light">
    <div class="container">
      <ul class="collapse navbar-collapse" id="navbarSupportedContent">
      <li class="nav-item">
      <a class="nav-link @if(Request::route()->getName() == 'paiement_fournisseurs.create') active @endif" aria-current="page" href="{{ route('paiement_fournisseurs.create') }}">Enregistrer un paiement de fournisseurs</a>
      </li>
       <li class="nav-item">
       <a class="nav-link @if(Request::route()->getName() == 'paiement_fournisseurs.index') active @endif" aria-current="page" href="{{ route('paiement_fournisseurs.index') }}">Tous les paiements de fournisseurs</a>
       </li>
       <li class="nav-item">
         <a class="nav-link active" aria-current="page" href="{{ route('admin') }}">Accueil</a>
        </li>
        </ul>
    </div>
</div>
<img src="{{ asset('') }}" alt="">
</body>
</html>
