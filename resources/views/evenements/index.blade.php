<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Événements</title>

<style>
body{
    font-family:Segoe UI;
    background:#0b1220;
    margin:0;
    color:#fff;
}

.container{
    max-width:1200px;
    margin:auto;
    padding:30px;
}

header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

h1{
    font-size:28px;
}

.btn{
    background:#2563eb;
    padding:10px 16px;
    border-radius:10px;
    color:white;
    text-decoration:none;
    transition:.3s;
}
.btn:hover{background:#1d4ed8}

.grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(270px,1fr));
    gap:20px;
}

/* CARD PRO */
.card{
    background:#111827;
    border-radius:16px;
    overflow:hidden;
    transition:.3s;
    box-shadow:0 10px 25px rgba(0,0,0,.3);
}

.card:hover{
    transform:translateY(-6px);
}

/* IMAGE FIX PRO */
.card img{
    width:100%;
    height:200px;
    object-fit:cover;
    display:block;
    background:#0f172a;
}

.card-content{
    padding:15px;
}

.card-content h3{
    margin:0;
    font-size:18px;
}

.meta{
    font-size:13px;
    color:#94a3b8;
    margin:6px 0;
}

.actions{
    display:flex;
    gap:8px;
    margin-top:10px;
}

.actions a{
    flex:1;
    text-align:center;
    padding:8px;
    border-radius:8px;
    color:white;
    text-decoration:none;
    font-size:13px;
}

.view{background:#22c55e}
.edit{background:#f59e0b}

@media(max-width:600px){
    header{flex-direction:column;gap:10px}
}
</style>
</head>

<body>

<div class="container">

<div class="grid">

@foreach($evenements as $ev)

<div class="card">

    {{-- IMAGE SAFE --}}
    <img src="{{ $ev->image ? asset('storage/'.$ev->image) : asset('images/event.png') }}">
    

    <div class="card-content">
        <h3>{{ $ev->titre }}</h3>

        <div class="meta">
            📅 {{ $ev->date }}
        </div>

        <p>{{ Str::limit($ev->description, 90) }}</p>

        <div class="actions">

 @if(auth()->id() === $ev->user_id || auth()->user()->niveau_admin >= 2)
 
<a href="{{ route('evenements.edit',$ev) }}" class="edit">Modifier</a>

<form method="POST" action="{{ route('evenements.destroy',$ev->id) }}" style="display:inline;" "
      onsubmit="return confirm('Voulez-vous vraiment supprimer cet evenement ?');">
@csrf
@method('DELETE')
<button class="btn delete">Supprimer</button>
</form>

<header>
    <a href="{{ route('evenements.create') }}" class="btn">+ Ajouter</a>
</header>

@endif
            <a href="{{ route('evenements.show', $ev->id) }}" class="view">Voir</a>
        </div>
    </div>

</div>

@endforeach

</div>

</div>

</body>
</html>