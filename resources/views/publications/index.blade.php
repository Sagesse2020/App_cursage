<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Publications</title>
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

<h1>Publications</h1>
<a href="{{ route('publications.create') }}">➕ Nouvelle publication</a>

<div class="grid">
@foreach($publications as $pub)
<div class="card">
    @if($pub->image)
        <img src="{{ asset('storage/'.$pub->image) }}">
    @endif
    <div class="content">
        <h3>{{ $pub->titre }}</h3>
        <small>Par {{ $pub->user->name ?? 'Utilisateur inconnu' }}</small>
        <p>{{ Str::limit($pub->contenu,120) }}</p>
        <div class="actions">
                    <a href="{{ route('commandes.create',$pub) }}">
                    Commander
                    </a>
            <a href="{{ route('publications.show',$pub) }}">Voir</a>

            @if(auth()->id() === $pub->user_id || auth()->user()->niveau == 3)
                <a href="{{ route('publications.edit',$pub) }}">Modifier</a>
            @endif
        </div>
    </div>
</div>
@endforeach
</div>
</body>
</html>
