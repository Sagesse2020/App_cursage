<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Événements</title>
<style>
body{font-family:'Segoe UI',sans-serif;background:#f4f6f8;padding:40px;}
.container{max-width:1200px;margin:auto;}
header{display:flex;justify-content:space-between;align-items:center;margin-bottom:30px;}
h1{font-size:28px;}
.btn{background:#111;color:#fff;padding:12px 20px;border-radius:6px;text-decoration:none;}
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:25px;}
.card{background:#fff;border-radius:14px;box-shadow:0 12px 30px rgba(0,0,0,.08);overflow:hidden;}
.card img{width:100%;height:180px;object-fit:cover;}
.card-content{padding:18px;}
.card-content h3{margin-bottom:6px;}
.actions{margin-top:12px;display:flex;gap:10px;}
.actions a, .actions button{flex:1;padding:8px;border-radius:6px;border:none;cursor:pointer;text-align:center;text-decoration:none;color:#fff;}
.details{background:#333;}
.edit{background:#0a7;}
.delete{background:#c0392b;}
</style>
</head>
<body>
<div class="container">
<header>
    <h1>Événements</h1>
    <a href="{{ route('evenements.create') }}" class="btn">+ Ajouter</a>
</header>

<div class="grid">
@foreach($evenements as $ev)
<div class="card">
    @if($ev->image)
        <img src="{{ asset('storage/'.$ev->image) }}">
    @else
        <img src="{{ asset('images/event.png') }}">
    @endif
    <div class="card-content">
        <h3>{{ $ev->titre }}</h3>
        <p>{{ $ev->description ?? '—' }}</p>
        <p><strong>Date :</strong> {{ $ev->date }}</p>
        <div class="actions">
            <a href="{{ route('evenements.show',$ev) }}" class="details">Voir</a>
            <a href="{{ route('evenements.edit',$ev) }}" class="edit">Modifier</a>
        </div>
    </div>
</div>
@endforeach
</div>
</div>
</body>
</html>
