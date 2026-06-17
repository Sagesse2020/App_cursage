<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Centre de notifications</title>

<link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:"Segoe UI",sans-serif;
}

body{
background:#f1f5f9;
padding:30px;
}

.container{
max-width:1400px;
margin:auto;
}

/* ===== HEADER ===== */

.header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:30px;
flex-wrap:wrap;
gap:15px;
}

.header h1{
color:#0f172a;
font-size:32px;
}

/* ===== STATS ===== */

.stats{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:20px;
margin-bottom:30px;
}

.stat-box{
background:white;
padding:25px;
border-radius:15px;
box-shadow:0 5px 15px rgba(0,0,0,.05);
}

.stat-box h3{
font-size:14px;
color:#64748b;
margin-bottom:10px;
}

.stat-box p{
font-size:30px;
font-weight:bold;
color:#0f172a;
}

/* ===== FILTRE ===== */

.filters{
display:flex;
gap:15px;
flex-wrap:wrap;
margin-bottom:25px;
background:white;
padding:20px;
border-radius:15px;
box-shadow:0 5px 15px rgba(0,0,0,.05);
}

.filters input,
.filters select{
padding:12px;
border:1px solid #ddd;
border-radius:10px;
min-width:220px;
}

.filters button{
padding:12px 20px;
border:none;
border-radius:10px;
cursor:pointer;
font-weight:bold;
}

.btn-filter{
background:#2563eb;
color:white;
}

/* ===== ACTIONS ===== */

.top-actions{
margin-bottom:20px;
}

.btn-all{
background:#16a34a;
color:white;
padding:12px 18px;
border:none;
border-radius:10px;
cursor:pointer;
}

/* ===== CARD ===== */

.notification{
background:white;
border-radius:15px;
padding:20px;
margin-bottom:15px;
box-shadow:0 5px 15px rgba(0,0,0,.05);
transition:.3s;
}

.notification:hover{
transform:translateY(-3px);
}

.notification.non-lue{
border-left:6px solid #dc2626;
}

.notification.lue{
border-left:6px solid #16a34a;
}

.top{
display:flex;
justify-content:space-between;
align-items:center;
flex-wrap:wrap;
gap:10px;
}

.title{
font-size:20px;
font-weight:bold;
color:#0f172a;
}

.message{
margin:15px 0;
color:#475569;
line-height:1.7;
}

.meta{
display:flex;
gap:10px;
flex-wrap:wrap;
margin-bottom:15px;
}

.badge{
padding:6px 12px;
border-radius:30px;
font-size:12px;
font-weight:bold;
color:white;
}

.info{
background:#0ea5e9;
}

.success{
background:#16a34a;
}

.warning{
background:#f59e0b;
}

.danger{
background:#dc2626;
}

.lu{
background:#16a34a;
}

.nonlu{
background:#dc2626;
}

/* ===== BUTTONS ===== */

.actions{
display:flex;
gap:10px;
flex-wrap:wrap;
}

.btn{
padding:10px 15px;
border:none;
border-radius:8px;
text-decoration:none;
cursor:pointer;
color:white;
font-size:14px;
}

.btn-read{
background:#16a34a;
}

.btn-delete{
background:#dc2626;
}

/* ===== EMPTY ===== */

.empty{
text-align:center;
padding:50px;
background:white;
border-radius:15px;
}

.empty i{
font-size:60px;
color:#94a3b8;
margin-bottom:20px;
}

.empty p{
font-size:18px;
color:#64748b;
}

.pagination{
margin-top:25px;
}

</style>
</head>

<body>

<div class="container">

<div class="header">

<h1>
<i class="fas fa-bell"></i>
 Centre de notifications
</h1>

</div>

{{-- STATISTIQUES --}}

<div class="stats">

<div class="stat-box">
<h3>Total notifications</h3>
<p>{{ $notifications->total() }}</p>
</div>

<div class="stat-box">
<h3>Notifications non lues</h3>
<p>{{ $notifications->where('lu',false)->count() }}</p>
</div>

<div class="stat-box">
<h3>Notifications lues</h3>
<p>{{ $notifications->where('lu',true)->count() }}</p>
</div>

</div>

{{-- FILTRE --}}

<form method="GET" class="filters">

<input
type="text"
name="search"
value="{{ request('search') }}"
placeholder="Titre ou message">

<select name="type">

<option value="">Tous les types</option>

<option value="info"
{{ request('type')=='info' ? 'selected' : '' }}>
Info
</option>

<option value="success"
{{ request('type')=='success' ? 'selected' : '' }}>
Succès
</option>

<option value="warning"
{{ request('type')=='warning' ? 'selected' : '' }}>
Avertissement
</option>

<option value="danger"
{{ request('type')=='danger' ? 'selected' : '' }}>
Danger
</option>

</select>

<select name="lu">

<option value="">Tous</option>

<option value="1"
{{ request('lu')==='1' ? 'selected' : '' }}>
Lues
</option>

<option value="0"
{{ request('lu')==='0' ? 'selected' : '' }}>
Non lues
</option>

</select>

<button class="btn-filter">
<i class="fas fa-search"></i>
 Filtrer
</button>

</form>

<div class="top-actions">

<form action="{{ route('notifications.read', $notification) }}" method="POST">
@csrf
@method('PUT')

<button class="btn-all">

<i class="fas fa-check-double"></i>

Tout marquer comme lu

</button>

</form>

</div>

@if($notifications->count())

@foreach($notifications as $n)

<div class="notification {{ $n->lu ? 'lue' : 'non-lue' }}">

<div class="top">

<div class="title">

{{ $n->titre }}

</div>

</div>

<div class="message">

{{ $n->message }}

</div>

<div class="meta">

<span class="badge {{ $n->type }}">
{{ strtoupper($n->type) }}
</span>

<span class="badge {{ $n->lu ? 'lu' : 'nonlu' }}">

{{ $n->lu ? 'LUE' : 'NON LUE' }}

</span>

@if($n->module)

<span class="badge info">

{{ strtoupper($n->module) }}

</span>

@endif

</div>

<div class="actions">

@if(!$n->lu)

<form method="POST"
action="{{ route('notifications.read',$n) }}">

@csrf
@method('PUT')

<button class="btn btn-read">

<i class="fas fa-check"></i>

Marquer comme lu

</button>

</form>

@endif

<form method="POST"
action="{{ route('notifications.destroy',$n->id) }}"
onsubmit="return confirm('Supprimer cette notification ?');">

@csrf
@method('DELETE')

<button class="btn btn-delete">

<i class="fas fa-trash"></i>

Supprimer

</button>

</form>

</div>

</div>

@endforeach

<div class="pagination">

{{ $notifications->links() }}

</div>

@else

<div class="empty">

<i class="fas fa-bell-slash"></i>

<p>Aucune notification disponible.</p>

</div>

@endif

</div>

</body>
</html>