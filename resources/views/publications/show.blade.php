<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Détail publication</title>
<style>
body{font-family:Segoe UI;background:#f4f6f8;padding:40px}
.box{
    max-width:900px;
    margin:auto;
    background:#fff;
    border-radius:18px;
    padding:30px;
    box-shadow:0 15px 30px rgba(0,0,0,.1);
}
img{width:100%;border-radius:14px;margin-bottom:20px}
small{color:#777}
</style>
</head>
<body>

<div class="box">
    <h1>{{ $publication->titre }}</h1>
    <small>Publié par {{ $publication->user->name ?? 'Inconnu' }}</small>

    @if($publication->image)
        <img src="{{ asset('storage/'.$publication->image) }}">
    @endif

    <p>{{ $publication->contenu }}</p>
</div>

</body>
</html>
