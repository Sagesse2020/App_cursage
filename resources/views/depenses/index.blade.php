<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Liste des dépenses</title>

<style>

body{
    font-family:Segoe UI,Arial,sans-serif;
    background:#f1f5f9;
    margin:0;
    padding:30px;
}

.container{
    max-width:1400px;
    margin:auto;
}

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

h1{
    margin:0;
    color:#0f172a;
}

.btn{
    padding:10px 16px;
    border-radius:8px;
    text-decoration:none;
    color:white;
    border:none;
    cursor:pointer;
    font-size:14px;
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
}

.filters{

    display:grid;
    grid-template-columns:
        repeat(auto-fit,minmax(220px,1fr));

    gap:15px;

    background:white;

    padding:20px;

    border-radius:12px;

    margin-bottom:25px;

    box-shadow:0 5px 15px rgba(0,0,0,.05);

}

.filters input,
.filters select{

    padding:12px;

    border:1px solid #ddd;

    border-radius:8px;

}

.filter-btn{

    background:#2563eb;

    color:white;

}

.reset{

    background:#64748b;

}

table{

    width:100%;

    background:white;

    border-collapse:collapse;

    border-radius:10px;

    overflow:hidden;

    box-shadow:0 5px 15px rgba(0,0,0,.05);

}

th{

    background:#0f172a;

    color:white;

    padding:15px;

}

td{

    padding:15px;

    border-bottom:1px solid #eee;

    text-align:center;

}

tr:hover{

    background:#f8fafc;

}

.badge{

    padding:6px 12px;

    border-radius:20px;

    color:white;

    font-size:13px;

}

.achat{background:#2563eb;}
.salaire{background:#16a34a;}
.transport{background:#f59e0b;}
.entretien{background:#8b5cf6;}
.autre{background:#64748b;}

.actions{

    display:flex;

    justify-content:center;

    gap:8px;

    flex-wrap:wrap;

}

.pagination{

    margin-top:25px;

}

</style>

</head>

<body>

<div class="container">

<div class="header">

<h1>💸 Liste des dépenses</h1>

<a href="{{ route('depenses.create') }}" class="btn add">
+ Nouvelle dépense
</a>

</div>

<form method="GET" class="filters">

<input
type="text"
name="search"
placeholder="Rechercher..."
value="{{ request('search') }}">

<select name="categorie">

<option value="">Toutes les catégories</option>

<option value="Achat">Achat</option>
<option value="Salaire">Salaire</option>
<option value="Transport">Transport</option>
<option value="Entretien">Entretien</option>
<option value="Autre">Autre</option>

</select>

<select name="user">

<option value="">Tous les utilisateurs</option>

@foreach($users as $user)

<option
value="{{ $user->id }}"
{{ request('user')==$user->id ? 'selected' : '' }}>
{{ $user->name }}
</option>

@endforeach

</select>

<input
type="date"
name="debut"
value="{{ request('debut') }}">

<input
type="date"
name="fin"
value="{{ request('fin') }}">

<button class="btn filter-btn">
Filtrer
</button>

<a href="{{ route('depenses.index') }}" class="btn reset">
Réinitialiser
</a>

</form>

<table>

<thead>

<tr>

<th>ID</th>
<th>Libellé</th>
<th>Montant</th>
<th>Catégorie</th>
<th>Date</th>
<th>Utilisateur</th>
<th>Actions</th>

</tr>

</thead>

<tbody>

@forelse($depenses as $depense)

<tr>

<td>{{ $depense->id }}</td>

<td>{{ $depense->libelle }}</td>

<td>
<strong>
{{ number_format($depense->montant,0,',',' ') }}
FCFA
</strong>
</td>

<td>

<span class="badge {{ strtolower($depense->categorie) }}">

{{ $depense->categorie }}

</span>

</td>

<td>{{ $depense->date_depense }}</td>

<td>{{ $depense->user->name ?? '-' }}</td>

<td>

<div class="actions">

<a
href="{{ route('depenses.show',$depense) }}"
class="btn show">

Voir

</a>

@if(auth()->id()==$depense->user_id || auth()->user()->niveau_admin>=2)

<a
href="{{ route('depenses.edit',$depense) }}"
class="btn edit">

Modifier

</a>

<form
method="POST"
action="{{ route('depenses.destroy',$depense) }}"
onsubmit="return confirm('Supprimer cette dépense ?')">

@csrf
@method('DELETE')

<button class="btn delete">

Supprimer

</button>

</form>

@endif

</div>

</td>

</tr>

@empty

<tr>

<td colspan="7">

Aucune dépense trouvée.

</td>

</tr>

@endforelse

</tbody>

</table>

<div class="pagination">

{{ $depenses->links() }}

</div>

</div>

</body>
</html>