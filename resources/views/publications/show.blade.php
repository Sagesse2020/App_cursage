<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Détail publication</title>

<style>
body{
    margin:0;
    font-family:Segoe UI, sans-serif;
    background:#eef2f7;
}

/* CONTAINER PRINCIPAL */
.container{
    max-width:900px;
    margin:40px auto;
    padding:20px;
}

/* CARD PUBLICATION */
.card{
    background:#fff;
    border-radius:18px;
    padding:25px;
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
}

/* IMAGE */
.card img{
    width:100%;
    border-radius:14px;
    margin-bottom:15px;
}

/* TITRE */
h2{
    margin-bottom:10px;
}

/* COMMENTAIRES */
.comments{
    margin-top:30px;
}

.comment{
    display:flex;
    gap:10px;
    padding:12px;
    border-bottom:1px solid #eee;
}

.avatar{
    width:40px;
    height:40px;
    border-radius:50%;
    background:#2563eb;
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:bold;
    font-size:14px;
}

.comment-content{
    flex:1;
}

.comment-content b{
    font-size:14px;
}

.comment-content p{
    margin:3px 0 0;
    font-size:14px;
    color:#444;
}

/* FORM COMMENTAIRE */
form{
    margin-top:20px;
    display:flex;
    flex-direction:column;
    gap:10px;
}

textarea{
    width:100%;
    min-height:90px;
    padding:12px;
    border-radius:12px;
    border:1px solid #ddd;
    resize:none;
    font-size:14px;
    outline:none;
}

textarea:focus{
    border-color:#2563eb;
}

/* BUTTON */
button{
    align-self:flex-end;
    background:#2563eb;
    color:#fff;
    border:none;
    padding:10px 18px;
    border-radius:10px;
    cursor:pointer;
    font-weight:600;
}

button:hover{
    background:#1e40af;
}

/* RESPONSIVE */
@media(max-width:600px){
    .container{
        margin:10px;
        padding:10px;
    }

    .card{
        padding:15px;
    }
}
</style>
</head>

<body>

<div class="container">

    <div class="card">

        <!-- IMAGE PUBLICATION -->
        <img src="{{ asset('storage/'.$publication->image) }}" alt="publication">

        <h2>{{ $publication->titre }}</h2>

        <p>{{ $publication->contenu }}</p>

        <!-- COMMENTAIRES -->
        <div class="comments">
            <h3>💬 Commentaires</h3>

            @foreach($publication->comments as $comment)
                <div class="comment">

                    <div class="avatar">
                        {{ strtoupper(substr($comment->user->name,0,1)) }}
                    </div>

                    <div class="comment-content">
                        <b>{{ $comment->user->name }}</b>
                        <p>{{ $comment->content }}</p>
                    </div>

                </div>
            @endforeach

            <!-- FORMULAIRE -->
            <form method="POST" action="{{ route('comments.store') }}">
                @csrf

                <input type="hidden" name="commentable_id" value="{{ $publication->id }}">
                <input type="hidden" name="commentable_type" value="App\Models\Publication">

                <textarea name="content" placeholder="Écrire un commentaire..." required></textarea>

                <button type="submit">Publier</button>
            </form>

        </div>

    </div>

</div>

</body>
</html>