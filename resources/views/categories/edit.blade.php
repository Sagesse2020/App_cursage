<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier catégorie</title>
</head>

<body>

<form method="POST"
action="{{ route('categories.update',$categorie->id) }}">

@csrf
@method('PUT')

<input type="text"
name="nom"
value="{{ $categorie->nom }}">

<textarea name="description">
{{ $categorie->description }}
</textarea>

<button>
Modifier
</button>

</form>

</body>
</html>