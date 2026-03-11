<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>{{ $document->titre }}</title>
<style>
body{font-family:'Segoe UI',sans-serif;background:#eef2f5;padding:40px;}
.container{max-width:900px;margin:auto;background:#fff;padding:30px;border-radius:16px;box-shadow:0 15px 40px rgba(0,0,0,.1);}
img{width:100%;height:320px;object-fit:cover;border-radius:10px;margin-bottom:15px;}
h1{margin-bottom:10px;}
p{line-height:1.6;color:#555;}
.back{display:inline-block;margin-top:20px;background:#111;color:#fff;padding:10px 18px;border-radius:6px;text-decoration:none;}
</style>
</head>
<body>
<div class="container">

@if($document->fichier && in_array(pathinfo($document->fichier, PATHINFO_EXTENSION), ['jpg','jpeg','png']))
<img src="{{ asset('storage/'.$document->fichier) }}">
@endif

<h1>{{ $document->titre }}</h1>
<p>{{ $document->description ?? 'Aucune description' }}</p>

<a href="{{ route('documents.index') }}" class="back">← Retour</a>

</div>
</body>
</html>
