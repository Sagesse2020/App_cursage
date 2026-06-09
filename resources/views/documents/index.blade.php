<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Documents</title>

<style>

body{
font-family:'Segoe UI',sans-serif;
background:#f4f6f8;
padding:40px;
}

.container{
max-width:1200px;
margin:auto;
}

header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:30px;
flex-wrap:wrap;
}

h1{
font-size:28px;
}

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
transition:.3s;
}

.card:hover{
transform:translateY(-5px);
}

.image-container{
height:200px;
display:flex;
align-items:center;
justify-content:center;
background:#f0f0f0;
}

.image-container img{
max-width:100%;
max-height:100%;
object-fit:contain;
}

.card-content{
padding:18px;
}

.card-content h3{
margin-bottom:6px;
}

.actions{
margin-top:12px;
display:flex;
gap:10px;
}

.actions a{
flex:1;
padding:8px;
border-radius:6px;
text-align:center;
text-decoration:none;
color:#fff;
}

.details{
background:#333;
}

.edit{
background:#0a7;
}

</style>

</head>

<body>

<div class="container">

<header>

<h1>Documents</h1>

</header>

<div class="grid">

@foreach($documents as $doc)

<div class="card">

<div class="image-container">

@php
$extension = strtolower(pathinfo($doc->fichier, PATHINFO_EXTENSION));
@endphp

@if(in_array($extension,['jpg','jpeg','png','gif','webp']))

<img src="{{ asset('storage/'.$doc->fichier) }}">

@elseif(in_array($extension,['pdf']))

<img src="{{ asset('images/pdf.png') }}">

@elseif(in_array($extension,['doc','docx']))

<img src="{{ asset('images/word.png') }}">

@else

<img src="{{ asset('images/file.png') }}">

@endif

</div>

<div class="card-content">

<h3>{{ $doc->titre }}</h3>

<p>{{ $doc->description ?? '—' }}</p>

<div class="actions">

<a href="{{ asset('storage/'.$doc->fichier) }}" class="details" target="_blank">
Voir
</a>

@if(auth()->id() === $doc->user_id || auth()->user()->niveau == 3)

<a href="{{ route('documents.edit',$doc) }}" class="edit">
Modifier
</a>>

<a href="{{ route('documents.destroy',$doc->id) }}" class="btn">
supprimer
</a>

<a href="{{ route('documents.create') }}" class="btn">
+ Ajouter
</a>

@endif

</div>

</div>

</div>

@endforeach

</div>

</div>

</body>
</html>
