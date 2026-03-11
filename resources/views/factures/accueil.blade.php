
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name')}}-Formulaire facture</title>
     <style>
        h1{
     color: red;
     }
        .navbar{
            display: flex;
            justify-content: space-around;
            background-color: #f8f9fa;
            padding: 10px;
        }
        .navbar a {
            text-decoration: none;
           color: #0858b4;
            padding: 8px 16px;
        }

         ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }
        li {
            margin-right: 20px;
        }
        li a{
            text-decoration: none;
        }

    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg_light">
    <div class="container">
      <ul class="collapse navbar-collapse" id="navbarSupportedContent">
      <li class="nav-item">
      <a class="nav-link @if(Request::route()->getName() == 'factures.create') active @endif" aria-current="page" href="{{ route('factures.create') }}">Enregistrer une transaction</a>
      </li>
       <li class="nav-item">
       <a class="nav-link @if(Request::route()->getName() == 'factures.index') active @endif" aria-current="page" href="{{ route('factures.index') }}">Liste des transactions</a>
       </li>
       <li class="nav-item">
         <a class="nav-link active" aria-current="page" href="{{ route('admin') }}">Accueil</a>
        </li>
    </div>
</body>
</html>

