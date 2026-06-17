<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Ajouter employé</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:Arial,sans-serif;
    background:#f1f5f9;
    padding:40px;
}

.container{
    max-width:850px;
    margin:auto;
}

.card{
    background:white;
    padding:35px;
    border-radius:18px;
    box-shadow:0 10px 30px rgba(0,0,0,.1);
}

h1{
    margin-bottom:25px;
    color:#0f172a;
}

.grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}

.input-group{
    margin-bottom:18px;
}

label{
    display:block;
    margin-bottom:8px;
    font-weight:bold;
    color:#334155;
}

input,
select,
textarea{
    width:100%;
    padding:13px;
    border:1px solid #cbd5e1;
    border-radius:10px;
    outline:none;
    font-size:15px;
}

input:focus,
select:focus,
textarea:focus{
    border-color:#2563eb;
}

textarea{
    resize:none;
    height:120px;
}

button{
    width:100%;
    padding:15px;
    border:none;
    border-radius:12px;
    background:#2563eb;
    color:white;
    font-size:16px;
    cursor:pointer;
    transition:.3s;
}

button:hover{
    background:#1d4ed8;
}

@media(max-width:700px){

    .grid{
        grid-template-columns:1fr;
    }

    body{
        padding:15px;
    }

}

</style>

</head>

<body>

<div class="container">

<div class="card">

<h1>👨‍💼 Ajouter un employé</h1>

<form
method="POST"
action="{{ route('employees.store') }}"
enctype="multipart/form-data"
>

@csrf

<div class="grid">

<div class="input-group">
<label>Nom</label>
<input type="text" name="nom">
</div>

<div class="input-group">
<label>Prénom</label>
<input type="text" name="prenom">
</div>

<div class="input-group">
<label>Téléphone</label>
<input type="text" name="telephone">
</div>

<div class="input-group">
<label>Email</label>
<input type="email" name="email">
</div>

<div class="input-group">
<label>Poste</label>
<input type="text" name="poste">
</div>

<div class="input-group">
<label>Salaire</label>
<input type="number" name="salaire">
</div>

<div class="input-group">
<label>Date embauche</label>
<input type="date" name="date_embauche">
</div>

<div class="input-group">
<label>Statut</label>

<select name="statut">

<option value="actif">
Actif
</option>

<option value="suspendu">
Suspendu
</option>

<option value="demission">
Démission
</option>

</select>

</div>

</div>

<div class="input-group">
<label>Photo</label>
<input type="file" name="photo">
</div>

<div class="input-group">
<label>Adresse</label>
<textarea name="adresse"></textarea>
</div>

<button type="submit">
Ajouter employé
</button>

</form>

</div>

</div>

</body>
</html>