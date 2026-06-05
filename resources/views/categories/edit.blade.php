<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier catégorie</title>

<style>
body {
    font-family: Arial;
    background: #f4f6f9;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.card {
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    width: 400px;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

input, textarea {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    border-radius: 6px;
    border: 1px solid #ddd;
}

button {
    width: 100%;
    margin-top: 15px;
    padding: 10px;
    background: #4CAF50;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

button:hover {
    background: #45a049;
}
</style>

</head>

<body>

<div class="card">

<h2>Modifier catégorie</h2>

<form action="{{ route('categories.update', $categorie->id) }}" method="POST">

@csrf
@method('PUT')

<label>Nom</label>
<input type="text" name="nom" value="{{ $categorie->nom }}">

<label>Description</label>
<textarea name="description">{{ $categorie->description }}</textarea>

<button>Modifier</button>

</form>

</div>

</body>
</html>