<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Gestion des documents</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}

body{
background:#f4f6f8;
padding:35px;
}

.container{
max-width:1500px;
margin:auto;
}

.header{

display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:35px;
flex-wrap:wrap;
gap:20px;

}

.header h1{

font-size:34px;
color:#222;

}

.add{

background:#16a34a;
color:white;
padding:13px 24px;
border-radius:8px;
text-decoration:none;
font-weight:bold;
transition:.3s;

}

.add:hover{

background:#15803d;

}

.grid{

display:grid;
grid-template-columns:repeat(auto-fill,minmax(360px,1fr));
gap:25px;

}

.card{

background:white;
border-radius:14px;
box-shadow:0 8px 25px rgba(0,0,0,.08);
padding:25px;
transition:.3s;
border-left:6px solid #0f62fe;

}

.card:hover{

transform:translateY(-6px);

}

.icon{

text-align:center;
font-size:65px;
margin-bottom:20px;

}

.title{

font-size:22px;
font-weight:bold;
margin-bottom:10px;
color:#222;

}

.description{

color:#666;
line-height:1.6;
margin-bottom:20px;
min-height:60px;

}

.info{

display:flex;
justify-content:space-between;
margin-bottom:12px;
font-size:14px;
color:#555;

}

.badge{

display:inline-block;
padding:6px 12px;
border-radius:30px;
font-size:12px;
font-weight:bold;
background:#eef3ff;
color:#0f62fe;

}

.actions{

display:flex;
flex-wrap:wrap;
gap:10px;
margin-top:25px;

}

.actions a,
.actions button{

flex:1;
padding:10px;
border:none;
border-radius:6px;
text-align:center;
cursor:pointer;
text-decoration:none;
font-weight:600;
color:white;
transition:.3s;

}

.view{

background:#2563eb;

}

.download{

background:#7c3aed;

}

.edit{

background:#059669;

}

.delete{

background:#dc2626;

}

.actions a:hover,
.actions button:hover{

opacity:.9;

}

.empty{

background:white;
padding:70px;
text-align:center;
border-radius:12px;
box-shadow:0 8px 20px rgba(0,0,0,.08);

}

.empty i{

font-size:80px;
color:#bbb;
margin-bottom:20px;

}

</style>

</head>

<body>

<div class="container">

<div class="header">

<h1>

<i class="fas fa-folder-open"></i>

Gestion des documents

</h1>

<a href="{{ route('documents.create') }}" class="add">

<i class="fas fa-plus"></i>

Nouveau document

</a>

</div>

@if($documents->count())

<div class="grid">

@foreach($documents as $doc)

@php

$extension=strtolower(pathinfo($doc->fichier,PATHINFO_EXTENSION));

@endphp

<div class="card">

<div class="icon">

@if(in_array($extension,['jpg','jpeg','png','gif','webp']))

<i class="fas fa-image" style="color:#f59e0b;"></i>

@elseif($extension=="pdf")

<i class="fas fa-file-pdf" style="color:#dc2626;"></i>

@elseif(in_array($extension,['doc','docx']))

<i class="fas fa-file-word" style="color:#2563eb;"></i>

@elseif(in_array($extension,['xls','xlsx']))

<i class="fas fa-file-excel" style="color:#16a34a;"></i>

@elseif(in_array($extension,['zip','rar']))

<i class="fas fa-file-archive" style="color:#9333ea;"></i>

@else

<i class="fas fa-file" style="color:#555;"></i>

@endif

</div>

<div class="title">

{{ $doc->titre }}

</div>

<div class="description">

{{ $doc->description ?: 'Aucune description.' }}

</div>

<div class="info">

<span>

<strong>Type</strong>

</span>

<span class="badge">

{{ strtoupper($extension ?: 'FICHIER') }}

</span>

</div>

<div class="info">

<span>

<strong>Ajouté le</strong>

</span>

<span>

{{ $doc->created_at->format('d/m/Y') }}

</span>

</div>

@if($doc->user)

<div class="info">

<span>

<strong>Auteur</strong>

</span>

<span>

{{ $doc->user->name }}

</span>

</div>

@endif

@if($doc->fichier)

<div class="info">

<span>

<strong>Téléchargement</strong>

</span>

<span>

Disponible

</span>

</div>

@endif

<div class="actions">

@if($doc->fichier)

<a href="{{ asset('storage/'.$doc->fichier) }}"

target="_blank"

class="view">

<i class="fas fa-eye"></i>

Voir

</a>

<a href="{{ asset('storage/'.$doc->fichier) }}"

download

class="download">

<i class="fas fa-download"></i>

Télécharger

</a>

@endif

@if(auth()->id()==$doc->user_id || auth()->user()->niveau_admin>=2)

<a href="{{ route('documents.edit',$doc) }}"

class="edit">

<i class="fas fa-pen"></i>

Modifier

</a>

<form

action="{{ route('documents.destroy',$doc) }}"

method="POST"

style="flex:1;"

onsubmit="return confirm('Supprimer ce document ?')">

@csrf

@method('DELETE')

<button

type="submit"

class="delete">

<i class="fas fa-trash"></i>

Supprimer

</button>

</form>

@endif

</div>

</div>

@endforeach

</div>

@else

<div class="empty">

<i class="fas fa-folder-open"></i>

<h2>

Aucun document enregistré

</h2>

<br>

<a href="{{ route('documents.create') }}" class="add">

Ajouter le premier document

</a>

</div>

@endif

</div>

</body>

</html>