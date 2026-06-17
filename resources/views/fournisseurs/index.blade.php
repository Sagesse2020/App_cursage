<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Fournisseurs</title>

<style>

body{
    margin:0;
    font-family:Segoe UI;
    background:#f1f5f9;
    padding:25px;
    color:#0f172a;
}

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:10px;
    margin-bottom:20px;
}

h1{
    font-size:30px;
}

.btn{
    padding:10px 15px;
    background:#2563eb;
    color:white;
    border-radius:10px;
    text-decoration:none;
}

.btn:hover{
    background:#1d4ed8;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
}

th,td{
    padding:12px;
    border-bottom:1px solid #e5e7eb;
    text-align:left;
}

th{
    background:#0f172a;
    color:white;
}

tr:hover{
    background:#f8fafc;
}

.actions{
    display:flex;
    gap:10px;
}

.btn-edit{
    background:#16a34a;
    padding:6px 10px;
    border-radius:8px;
    color:white;
    text-decoration:none;
}

.btn-delete{
    background:#dc2626;
    padding:6px 10px;
    border:none;
    color:white;
    border-radius:8px;
    cursor:pointer;
}

.search{
    padding:10px;
    border:1px solid #ddd;
    border-radius:10px;
    width:250px;
}

</style>
</head>

<body>

<div class="header">
    <h1>📦 Fournisseurs</h1>

    <form method="GET">
        <input class="search" type="text" name="search" placeholder="Rechercher...">
    </form>

    <a href="{{ route('fournisseurs.create') }}" class="btn">+ Ajouter</a>
</div>

@if(session('success'))
<p style="color:green">{{ session('success') }}</p>
@endif

<table>
<tr>
<th>Nom</th>
<th>Email</th>
<th>Téléphone</th>
<th>Adresse</th>
<th>Actions</th>
</tr>

@foreach($fournisseurs as $f)
<tr>
<td>{{ $f->nom }}</td>
<td>{{ $f->email }}</td>
<td>{{ $f->telephone }}</td>
<td>{{ $f->adresse }}</td>

<td>
<div class="actions">
    <a class="btn-edit" href="{{ route('fournisseurs.edit',$f) }}">Modifier</a>

    <form method="POST" action="{{ route('fournisseurs.destroy',$f) }}">
        @csrf
        @method('DELETE')
        <button class="btn-delete">Supprimer</button>
    </form>
</div>
</td>

</tr>
@endforeach

</table>

<div style="margin-top:20px;">
{{ $fournisseurs->links() }}
</div>

</body>
</html>