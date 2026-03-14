<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Créer un service</title>
<style>

.form-container{
max-width:600px;
margin:auto;
padding:30px;
}

input,select,textarea{
width:100%;
padding:10px;
margin:10px 0;
background:#111827;
border:none;
color:white;
border-radius:6px;
}

button{
background:#00e6ff;
padding:12px;
border:none;
border-radius:6px;
cursor:pointer;
}


.cards{

display:grid;

grid-template-columns:repeat(auto-fit,minmax(250px,1fr));

gap:20px;

margin-top:30px
}
</style>
</head>
<body>
 <h1>Ajouter service</h1>

<form method="POST" action="{{ route('services.store') }}"  enctype="multipart/form-data">

@csrf

<label>Nom</label>
<input type="text" name="nom" required>

<label>Description</label>
<textarea name="description"></textarea>

<label>Prix (FCFA)</label>
<input type="number" name="prix_vente">

<label>Statut</label>

<select name="statut">

<option value="en_cours">En cours</option>
<option value="termine">Terminé</option>

</select>

<button>Enregistrer</button>

</form>
</body>
</html>
