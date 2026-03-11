
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name')}}-Formulaire clients</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Si tu as des styles -->
     <style>
      .navbar {
    display: flex;
    justify-content: space-around;
    background-color: #f9f8fa;
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
li a {
    text-decoration: none;
}
      h1 title
  {
    color:red;
  }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg_light">
    <div class="container">
      <ul class="collapse navbar-collapse" id="navbarSupportedContent">
      <li class="nav-item">
      <a class="nav-link @if(Request::route()->getName() == 'clients.create') active @endif" aria-current="page" href="{{ route('clients.create') }}">Enregistrer un nouveau client</a>
      </li>
       <li class="nav-item">
       <a class="nav-link @if(Request::route()->getName() == 'clients.index') active @endif" aria-current="page" href="{{ route('clients.index') }}">Liste des clients</a>
       </li>
       <li class="nav-item">
         <a class="nav-link active" aria-current="page" href="{{ route('welcome') }}">Accueil</a>
        </li>
        </ul>
    </div>
</div>
<img src="{{ asset('Clients.jpg') }}" alt="Image Clients">
</body>
</html>
