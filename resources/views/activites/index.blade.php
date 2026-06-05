<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Historique activités</title>

<style>

body{
font-family:Arial;
background:#f1f5f9;
padding:30px;
}

.title{
margin-bottom:25px;
}

.filters{
display:flex;
gap:15px;
margin-bottom:20px;
flex-wrap:wrap;
}

.filters select,
.filters button{
padding:12px;
border-radius:10px;
border:1px solid #ddd;
}

.filters button{
background:#2563eb;
color:white;
cursor:pointer;
}

.table-container{
overflow:auto;
background:white;
border-radius:15px;
box-shadow:0 5px 20px rgba(0,0,0,.08);
}

table{
width:100%;
border-collapse:collapse;
min-width:1200px;
}

th{
background:#0f172a;
color:white;
padding:15px;
font-size:14px;
}

td{
padding:15px;
border-bottom:1px solid #eee;
font-size:14px;
vertical-align:top;
}

tr:hover{
background:#f8fafc;
}

.badge{
padding:6px 12px;
border-radius:30px;
color:white;
font-size:12px;
font-weight:bold;
}

.create{
background:#16a34a;
}

.update{
background:#f59e0b;
}

.delete{
background:#dc2626;
}

.login{
background:#2563eb;
}

.logout{
background:#7c3aed;
}

.info{
background:#0ea5e9;
}

.warning{
background:#f59e0b;
}

.critical{
background:#dc2626;
}

.code{
background:#f1f5f9;
padding:10px;
border-radius:10px;
font-size:12px;
max-width:350px;
overflow:auto;
white-space:pre-wrap;
}

.pagination{
margin-top:20px;
}

</style>

</head>

<body>

<h1 class="title">
📜 Historique des activités
</h1>

<form class="filters">

<select name="module">

<option value="">Tous modules</option>

<option value="Produit">Produit</option> 
<option value="Commande">Commande</option>
<option value="Employee">Employé</option>
<option value="Transaction">TRansaction</option>
<option value="Race">Race</option>
<option value="Chien">Chien</option>

</select>

<select name="action">

<option value="">Toutes actions</option>

<option value="CREATE">CREATE</option>
<option value="UPDATE">UPDATE</option>
<option value="DELETE">DELETE</option>
<option value="LOGIN">LOGIN</option>
<option value="LOGOUT">LOGOUT</option>

</select>

<button>
Filtrer
</button>

</form>

<div class="table-container">

<table>

<tr>

<th>Utilisateur</th>
<th>Action</th>
<th>Module</th>
<th>ID</th>
<th>Sévérité</th>
<th>IP</th>
<th>Ancien état</th>
<th>Nouveau état</th>
<th>Date</th>

</tr>

@foreach($activites as $log)

<tr>

<td>
{{ $log->user->name ?? 'SYSTEME' }}
</td>

<td>

<span class="badge {{ strtolower($log->action) }}">

{{ $log->action }}

</span>

</td>

<td>
{{ $log->module }}
</td>

<td>
{{ $log->reference_id }}
</td>

<td>

<span class="badge {{ $log->severity }}">

{{ $log->severity }}

</span>

</td>

<td>
{{ $log->ip }}
</td>

<td>
<pre class="code">{{ $log->ancien_etat }}</pre>
</td>

<td>
<pre class="code">{{ $log->nouvel_etat }}</pre>
</td>

</tr>

@endforeach

</table>

</div>

<div class="pagination">

{{ $activites->links() }}

</div>

</body>
</html>