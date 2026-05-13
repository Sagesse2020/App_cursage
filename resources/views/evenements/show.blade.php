<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>{{ $evenement->titre }}</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Segoe UI',sans-serif;
    background:
    linear-gradient(rgba(15,23,42,.92),rgba(15,23,42,.95)),
    url('{{ asset("images/bg-pattern.jpg") }}');
    background-size:cover;
    background-attachment:fixed;
    color:#fff;
}

/* CONTAINER */
.container{
    max-width:1000px;
    margin:40px auto;
    padding:25px;
}

/* CARD */
.card{
    background:#111827;
    border-radius:24px;
    overflow:hidden;
    box-shadow:
    0 20px 50px rgba(0,0,0,.45),
    0 0 0 1px rgba(255,255,255,.03);
}

/* IMAGE */
.image-box{
    width:100%;
    max-height:500px;
    background:#0b1220;
    border-radius:18px;
    overflow:hidden;

    display:flex;
    align-items:center;
    justify-content:center;
}

.image-box img{
    max-width:100%;
    max-height:500px;
    object-fit:contain;
}

.image-box img:hover{
    transform:scale(1.03);
}

/* OVERLAY */
.overlay{
    position:absolute;
    inset:0;
    background:linear-gradient(
        to top,
        rgba(0,0,0,.7),
        rgba(0,0,0,.1)
    );
}

/* CONTENT */
.content{
    padding:30px;
}

.badge{
    display:inline-block;
    background:#2563eb;
    color:white;
    padding:8px 14px;
    border-radius:50px;
    font-size:13px;
    margin-bottom:15px;
    font-weight:600;
}

h1{
    font-size:34px;
    margin-bottom:15px;
    line-height:1.3;
}

.meta{
    display:flex;
    gap:20px;
    flex-wrap:wrap;
    margin-bottom:20px;
    color:#94a3b8;
    font-size:15px;
}

.description{
    color:#d1d5db;
    line-height:1.9;
    font-size:16px;
}

/* BUTTONS */
.actions{
    margin-top:30px;
    display:flex;
    gap:15px;
    flex-wrap:wrap;
}

.btn{
    padding:12px 20px;
    border-radius:12px;
    text-decoration:none;
    color:white;
    font-weight:600;
    transition:.3s;
}

.btn-back{
    background:#2563eb;
}

.btn-back:hover{
    background:#1d4ed8;
}

.btn-edit{
    background:#f59e0b;
}

.btn-edit:hover{
    background:#d97706;
}

/* COMMENTAIRES */
.comment-box{
    margin-top:35px;
    background:#0b1220;
    border-radius:20px;
    padding:25px;
}

.comment-title{
    margin-bottom:20px;
    font-size:22px;
}

.comment{
    background:#111827;
    border:1px solid rgba(255,255,255,.05);
    padding:16px;
    border-radius:14px;
    margin-bottom:15px;
}

.comment-user{
    color:#60a5fa;
    font-weight:bold;
    margin-bottom:8px;
}

.comment-text{
    color:#d1d5db;
    line-height:1.7;
}

/* FORM */
.form-group{
    margin-top:20px;
}

textarea{
    width:100%;
    min-height:120px;
    border:none;
    outline:none;
    resize:none;
    border-radius:16px;
    padding:16px;
    background:#111827;
    color:white;
    font-size:15px;
    border:1px solid rgba(255,255,255,.06);
}

textarea:focus{
    border-color:#2563eb;
}

.submit-btn{
    margin-top:15px;
    background:#22c55e;
    color:white;
    border:none;
    padding:12px 20px;
    border-radius:12px;
    cursor:pointer;
    font-weight:600;
    transition:.3s;
}

.submit-btn:hover{
    background:#16a34a;
}

/* EMPTY */
.empty{
    color:#94a3b8;
    padding:15px 0;
}

/* RESPONSIVE */
@media(max-width:768px){

    .container{
        padding:15px;
    }

    .image-box{
        height:260px;
    }

    .content{
        padding:20px;
    }

    h1{
        font-size:25px;
    }

    .meta{
        flex-direction:column;
        gap:8px;
    }

    .actions{
        flex-direction:column;
    }

    .btn{
        text-align:center;
    }
}

</style>
</head>

<body>

<div class="container">

<div class="card">

    {{-- IMAGE --}}
    @php
        $imageUrl = $evenement->image
        ? asset('storage/' . $evenement->image)
        : asset('images/event.png');
    @endphp

    <div class="image-box">

        <img src="{{ $imageUrl }}" alt="Événement">

        <div class="overlay"></div>

    </div>

    {{-- CONTENT --}}
    <div class="content">

        <span class="badge">📅 Événement Cursage</span>

        <h1>{{ $evenement->titre }}</h1>

        <div class="meta">
            <span>📆 {{ $evenement->date }}</span>
            <span>💬 {{ $evenement->comments->count() }} commentaire(s)</span>
        </div>

        <div class="description">
            {{ $evenement->description }}
        </div>

        <div class="actions">

            <a href="{{ route('evenements.index') }}" class="btn btn-back">
                ← Retour
            </a>

        </div>

    </div>

</div>

{{-- COMMENTAIRES --}}
<div class="comment-box">

    <h2 class="comment-title">
        💬 Commentaires
    </h2>

    @forelse($evenement->comments as $comment)

        <div class="comment">

            <div class="comment-user">
                {{ $comment->user->name ?? 'Utilisateur' }}
            </div>

            <div class="comment-text">
                {{ $comment->content }}
            </div>

        </div>

    @empty

        <div class="empty">
            Aucun commentaire pour le moment.
        </div>

    @endforelse

    {{-- FORMULAIRE --}}
    <form method="POST" action="{{ route('comments.store') }}">

        @csrf

        <input type="hidden"
               name="commentable_id"
               value="{{ $evenement->id }}">

        <input type="hidden"
               name="commentable_type"
               value="App\Models\Evenement">

        <div class="form-group">

            <textarea
                name="content"
                placeholder="Écrire un commentaire..."
                required></textarea>

        </div>

        <button type="submit" class="submit-btn">
            Envoyer le commentaire
        </button>

    </form>

</div>

</div>

</body>
</html>