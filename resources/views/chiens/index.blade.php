<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Chiens disponibles</title>

    <style>
        body{
            font-family: 'Segoe UI', sans-serif;
            background:#f4f6f8;
            margin:0;
            padding:40px;
            color:#222;
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
        }

        h1{
            font-size:28px;
            font-weight:600;
        }

        .btn{
            padding:12px 20px;
            background:#111;
            color:#fff;
            text-decoration:none;
            border-radius:6px;
            font-size:14px;
            transition:0.3s;
        }

        .btn:hover{
            background:#333;
        }

        .grid{
            display:grid;
            grid-template-columns:repeat(auto-fill,minmax(280px,1fr));
            gap:25px;
        }

        .card{
            background:#fff;
            border-radius:12px;
            box-shadow:0 10px 25px rgba(0,0,0,0.05);
            overflow:hidden;
            transition:0.3s;
        }

        .card:hover{
            transform:translateY(-4px);
        }

        .card img{
            width:100%;
            height:200px;
            object-fit:cover;
        }

        .card-content{
            padding:18px;
        }

        .card-content h3{
            margin:0;
            font-size:18px;
        }

        .price{
            margin:10px 0;
            font-weight:600;
            color:#0a7;
        }

        .actions{
            display:flex;
            gap:10px;
        }

        .btn-edit{
            background:#0a7;
        }

        .btn-edit:hover{
            background:#086;
        }
    </style>
</head>

<body>
<div class="container">

    <header>
        <h1>Chiens disponibles</h1>
        <a href="{{ route('chiens.create') }}" class="btn">+ Ajouter un chien</a>
    </header>

    <div class="grid">
        @foreach($chiens as $chien)
        <div class="card">
            <img src="{{ asset('storage/'.$chien->image) }}" alt="chien">

            <div class="card-content">
                <h3>{{ $chien->nom }}</h3>
                <p>{{ $chien->race }} • {{ $chien->age }} ans</p>

                <div class="price">
                    {{ number_format($chien->prix,0,',',' ') }} FCFA
                </div>

                <div class="actions">
                    <a href="{{ route('chiens.edit',$chien) }}" class="btn btn-edit">Modifier</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
</body>
</html>
