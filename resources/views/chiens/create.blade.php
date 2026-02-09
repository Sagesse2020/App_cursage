<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un chien</title>

    <style>
        body{
            font-family: 'Segoe UI', sans-serif;
            background:#f4f6f8;
            padding:40px;
        }

        .form-box{
            max-width:600px;
            background:#fff;
            margin:auto;
            padding:30px;
            border-radius:14px;
            box-shadow:0 15px 40px rgba(0,0,0,0.08);
        }

        h1{
            text-align:center;
            margin-bottom:25px;
        }

        input, textarea{
            width:100%;
            padding:14px;
            margin-bottom:15px;
            border-radius:8px;
            border:1px solid #ccc;
            font-size:14px;
        }

        textarea{
            resize:none;
            height:100px;
        }

        button{
            width:100%;
            padding:14px;
            background:#111;
            color:#fff;
            border:none;
            border-radius:8px;
            font-size:15px;
            cursor:pointer;
            transition:0.3s;
        }

        button:hover{
            background:#333;
        }
    </style>
</head>

<body>

<div class="form-box">
    <h1>Ajouter un chien</h1>

    <form action="{{ route('chiens.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="nom" placeholder="Nom du chien" required>
        <input type="text" name="race" placeholder="Race" required>
        <input type="number" name="age" placeholder="Âge (ans)">
        <input type="number" name="prix" placeholder="Prix (FCFA)">

        <input type="file" name="image">

        <textarea name="description" placeholder="Description du chien"></textarea>

        <button type="submit">Enregistrer le chien</button>
    </form>
</div>

</body>
</html>
