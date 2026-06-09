<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Liste des dépenses</title>

<style>

body{
font-family:Segoe UI;
background:#f1f5f9;
padding:30px;
}

h1{
margin-bottom:20px;
}

.btn{
padding:10px 15px;
border-radius:8px;
text-decoration:none;
color:white;
}

.add{
background:#2563eb;
}

.show{
background:#16a34a;
}

.edit{
background:#f59e0b;
}

.delete{
background:#dc2626;
border:none;
cursor:pointer;
}

table{
width:100%;
background:white;
border-collapse:collapse;
}

th,td{
padding:15px;
border:1px solid #ddd;
text-align:center;
}

th{
background:#0f172a;
color:white;
}

</style>

</head>
<body>

<h1>💸 Liste des dépenses</h1>

<br><br>

<table>

<tr>

<th>ID</th>
<th>Libellé</th>
<th>Montant</th>
<th>Catégorie</th>
<th>Date</th>
<th>Utilisateur</th>
<th>Actions</th>

</tr>

@foreach($depenses as $depense)

<tr>

<td>{{ $depense->id }}</td>

<td>{{ $depense->libelle }}</td>

<td>{{ number_format($depense->montant,0,',',' ') }} FCFA</td>

<td>{{ $depense->categorie }}</td>

<td>{{ $depense->date_depense }}</td>

<td>{{ $depense->user->name ?? '' }}</td>

<td>

<a
href="{{ route('depenses.show',$depense) }}"
class="btn show"
>
Voir
</a>

@if(auth()->id() === $consultation->user_id || auth()->user()->niveau == 3)

<a
href="{{ route('depenses.edit',$depense) }}" class="btn edit">
Modifier
</a>

<a href="{{ route('depenses.destroy',$depense->id) }}" class="btn">
supprimer
</a>

<a href="{{ route('depenses.create') }}" class="btn add">
+ Nouvelle dépense
</a>

@endif

</form>

</td>

</tr>

@endforeach

</table>

<br>

{{ $depenses->links() }}

</body>
</html>