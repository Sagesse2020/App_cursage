<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Races canines</title>

<style>
body{
    font-family:'Segoe UI',sans-serif;
    background:#f4f6f8;
    padding:40px;
}
.container{max-width:1200px;margin:auto;}
header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;
}
h1{font-size:28px;}
.btn{
    background:#111;
    color:#fff;
    padding:12px 20px;
    border-radius:6px;
    text-decoration:none;
}
.grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(260px,1fr));
    gap:25px;
}
.card{
    background:#fff;
    border-radius:14px;
    box-shadow:0 12px 30px rgba(0,0,0,.08);
    overflow:hidden;
}
.card img{
    width:100%;
    height:180px;
    object-fit:cover;
}
.card-content{padding:18px;}
.card-content h3{margin-bottom:6px;}
.actions{
    margin-top:12px;
    display:flex;
    gap:10px;
}
.actions a, .actions button{
    flex:1;
    padding:8px;
    border-radius:6px;
    border:none;
    cursor:pointer;
    text-align:center;
    text-decoration:none;
    color:#fff;
}
.details{background:#333;}
.edit{background:#0a7;}
.delete{background:#c0392b;}
</style>
</head>

<body>
<div class="container">

<header>
    <h1>Races canines</h1>
    <a href="{{ route('races.create') }}" class="btn">+ Ajouter</a>
</header>

<div class="grid">
@foreach($races as $race)
<div class="card">
    <img src="{{ $race->image ? asset('storage/'.$race->image) : asset('images/no-image.png') }}">

    <div class="card-content">
        <h3>{{ $race->nom }}</h3>
        <p>{{ $race->origine }}</p>

        <div class="actions">
            @if(auth()->id() === $race->user_id || auth()->user()->niveau == 3)
                <a href="{{ route('races.edit',$race) }}" class="edit">Modifier</a>
                <a href="{{ route('races.destroy',$race) }}" class="edit">Supprimer</a>
            @endif
            <a href="{{ route('races.show',$race) }}" class="details">Voir</a>
        </div>
    </div>
</div>
@endforeach
</div>
</div>
</body>
</html>
