<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Historique activités</title>

<style>

/* ================= BASE ================= */
*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:"Segoe UI",Tahoma,sans-serif;
}

body{
background:#f4f7fa;
padding:20px;
color:#1f2937;
}

/* ================= TITLE ================= */
.title{
margin-bottom:25px;
color:#0d6efd;
font-size:2rem;
font-weight:700;
}

/* ================= FILTERS ================= */
.filters{
display:flex;
gap:12px;
flex-wrap:wrap;
align-items:center;
margin-bottom:25px;
}

.filters select,
.filters input{
padding:12px;
border:1px solid #d1d5db;
border-radius:10px;
background:white;
min-width:160px;
outline:none;
}

.filters input:focus,
.filters select:focus{
border-color:#0d6efd;
box-shadow:0 0 0 3px rgba(13,110,253,.15);
}

.filters button{
padding:12px 18px;
background:#0d6efd;
border:none;
border-radius:10px;
color:white;
cursor:pointer;
font-weight:600;
transition:.3s;
}

.filters button:hover{
background:#0b5ed7;
transform:translateY(-2px);
}

/* ================= TABLE ================= */
.table-container{
background:white;
border-radius:16px;
overflow:auto;
box-shadow:0 10px 25px rgba(0,0,0,.08);
}

table{
width:100%;
border-collapse:collapse;
min-width:1200px;
}

th{
background:#0d6efd;
color:white;
padding:15px;
font-size:14px;
text-align:left;
}

td{
padding:14px;
border-bottom:1px solid #eee;
font-size:14px;
vertical-align:top;
}

tr:nth-child(even){
background:#f8fafc;
}

tr:hover{
background:#eef6ff;
}

/* ================= BADGES ================= */
.badge{
padding:6px 12px;
border-radius:30px;
color:white;
font-size:12px;
font-weight:600;
display:inline-block;
text-transform:uppercase;
}

.create{background:#198754;}
.update{background:#ffc107;color:#000;}
.delete{background:#dc3545;}
.login{background:#0d6efd;}
.logout{background:#6f42c1;}
.info{background:#0dcaf0;}
.warning{background:#fd7e14;}
.critical{background:#dc3545;}

/* ================= CODE BOX ================= */
.code{
background:#f8fafc;
padding:10px;
border-radius:10px;
font-size:12px;
max-width:320px;
overflow:auto;
border:1px solid #e5e7eb;
white-space:pre-wrap;
}

/* ================= PAGINATION ================= */
.pagination{
margin-top:20px;
display:flex;
justify-content:center;
}

/* ================= RESPONSIVE ================= */
@media(max-width:768px){

body{padding:10px;}

.title{
font-size:1.5rem;
text-align:center;
}

.filters{
flex-direction:column;
align-items:stretch;
}

.filters input,
.filters select,
.filters button{
width:100%;
}

th,td{
font-size:12px;
padding:10px;
}
}

</style>
</head>

<body>

<h1 class="title">📜 Historique des activités</h1>

<!-- ================= FILTRES ================= -->
<form class="filters" method="GET">

<select name="module">
<option value="">Tous modules</option>
<option value="Produit">Produit</option>
<option value="Commande">Commande</option>
<option value="Employee">Employé</option>
<option value="Transaction">Transaction</option>
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

<!-- ✅ FILTRE DATE AJOUTÉ -->
<input type="date" name="date_debut">
<input type="date" name="date_fin">

<button type="submit">Filtrer</button>

</form>

<!-- ================= TABLE ================= -->
<div class="table-container">

<table>

<thead>
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
</thead>

<tbody>

@foreach($activites as $log)

<tr>

<td>{{ $log->user->name ?? 'SYSTEME' }}</td>

<td>
<span class="badge {{ strtolower($log->action) }}">
{{ $log->action }}
</span>
</td>

<td>{{ $log->module }}</td>
<td>{{ $log->reference_id }}</td>

<td>
<span class="badge {{ $log->severity }}">
{{ $log->severity }}
</span>
</td>

<td>{{ $log->ip }}</td>

<td><pre class="code">{{ $log->ancien_etat }}</pre></td>
<td><pre class="code">{{ $log->nouvel_etat }}</pre></td>

<td>{{ $log->created_at }}</td>

</tr>

@endforeach

</tbody>

</table>

</div>

<!-- ================= PAGINATION ================= -->
<div class="pagination">
{{ $activites->links() }}
</div>

</body>
</html>