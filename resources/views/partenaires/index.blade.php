<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Partenaires</title>
<style>
body{font-family:Segoe UI;background:#f4f6f8;padding:40px}
.grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(300px,1fr));
    gap:25px;
}
.card{
    background:#fff;
    border-radius:16px;
    box-shadow:0 10px 25px rgba(0,0,0,.1);
    overflow:hidden;
}
.card img{
    width:100%;
    height:200px;
    object-fit:cover;
}
.content{padding:20px}
small{color:#777}
.actions{
    display:flex;
    gap:10px;
    margin-top:15px;
}
.actions a{
    flex:1;
    text-align:center;
    padding:10px;
    border-radius:8px;
    text-decoration:none;
    color:#fff;
    background:#0a7;
}
.actions .danger{background:#c00}
</style>
</head>
<body>

<h1>Partenaires</h1>
<a href="{{ route('partenaires.create') }}">➕ Nouveau partenaire</a>

<div class="grid">
@foreach($partenaires as $partenaire)
<div class="card">
        <small>Par {{ $partenaire->user->name ?? 'Utilisateur inconnu' }}</small>
          <h3>{{ $partenaire->nom }}</h3>
          <p>{{ $partenaire->telephone }}</p>
          <p>{{ $partenaire->email }}</p>
          <p>{{ $partenaire->adresse }}</p>
          <p>{{ $partenaire->pourcentage_commission }}</p>
          <p>{{ $partenaire->notes }}</p>

        <div class="actions">
            <a href="{{ route('partenaires.show',$partenaire) }}">Voir</a>

            @if(auth()->id() === $partenaire->user_id || auth()->user()->niveau == 3)
                <a href="{{ route('partenaires.edit',$partenaire) }}">Modifier</a>
            @endif
        </div>
    </div>
</div>
@endforeach
</div>
</body>
</html>
