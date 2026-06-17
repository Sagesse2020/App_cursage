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
max-width:1200px;
margin:auto;
}

.header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:25px;
}

.header h1{
font-size:28px;
color:#0f172a;
}

/* STATS */
.stats{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
gap:15px;
margin-bottom:25px;
}

.stat-box{
background:#fff;
padding:20px;
border-radius:12px;
box-shadow:0 2px 10px rgba(0,0,0,0.05);
}

.stat-box p{
font-size:24px;
font-weight:bold;
}

/* FILTER */
.filters{
display:flex;
gap:10px;
flex-wrap:wrap;
margin-bottom:20px;
}

.filters input, .filters select{
padding:10px;
border:1px solid #ddd;
border-radius:8px;
}

/* BUTTONS */
.btn-all{
background:#16a34a;
color:#fff;
padding:10px 15px;
border:none;
border-radius:8px;
cursor:pointer;
}

.btn-read{
background:#2563eb;
color:#fff;
padding:8px 12px;
border:none;
border-radius:6px;
cursor:pointer;
}

.btn-delete{
background:#dc2626;
color:#fff;
padding:8px 12px;
border:none;
border-radius:6px;
cursor:pointer;
}

/* NOTIFICATIONS */
.notification{
background:#fff;
padding:15px;
border-radius:10px;
margin-bottom:12px;
box-shadow:0 2px 8px rgba(0,0,0,0.05);
border-left:5px solid transparent;
}

.notification.lue{
border-left-color:#16a34a;
}

.notification.non-lue{
border-left-color:#dc2626;
}

.title{
font-weight:bold;
font-size:18px;
}

.message{
margin:10px 0;
color:#475569;
}

.meta{
display:flex;
gap:10px;
font-size:12px;
}

.badge{
padding:4px 10px;
border-radius:20px;
color:#fff;
}

.info{background:#0ea5e9;}
.success{background:#16a34a;}
.warning{background:#f59e0b;}
.danger{background:#dc2626;}

.pagination{
margin-top:20px;
}
</style>
</head>

<body>

<div class="container">

<div class="header">
    <h1><i class="fas fa-bell"></i> Notifications</h1>
</div>

{{-- STATS --}}
<div class="stats">
    <div class="stat-box">
        <p>{{ $notifications->total() }}</p>
        <span>Total</span>
    </div>

    <div class="stat-box">
        <p>{{ $notifications->where('lu', false)->count() }}</p>
        <span>Non lues</span>
    </div>

    <div class="stat-box">
        <p>{{ $notifications->where('lu', true)->count() }}</p>
        <span>Lues</span>
    </div>
</div>

{{-- FILTRES --}}
<form method="GET" class="filters">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher...">

    <select name="type">
        <option value="">Tous types</option>
        <option value="info">Info</option>
        <option value="success">Succès</option>
        <option value="warning">Warning</option>
        <option value="danger">Danger</option>
    </select>

    <select name="lu">
        <option value="">Tous</option>
        <option value="1">Lues</option>
        <option value="0">Non lues</option>
    </select>

    <button class="btn-all" type="submit">
        <i class="fas fa-search"></i> Filtrer
    </button>
</form>

{{-- ACTION GLOBALE --}}
<div style="margin-bottom:15px;">
    <form method="POST" action="{{ route('notifications.readAll') }}">
        @csrf
        @method('PATCH')

        <button class="btn-all">
            <i class="fas fa-check-double"></i>
            Tout marquer comme lu
        </button>
    </form>
</div>

{{-- LISTE --}}
@if($notifications->count())

@foreach($notifications as $n)

<div class="notification {{ $n->lu ? 'lue' : 'non-lue' }}">

    <div class="title">{{ $n->titre }}</div>

    <div class="message">{{ $n->message }}</div>

    <div class="meta">

        <span class="badge {{ $n->type }}">
            {{ strtoupper($n->type) }}
        </span>

        <span class="badge {{ $n->lu ? 'success' : 'danger' }}">
            {{ $n->lu ? 'LUE' : 'NON LUE' }}
        </span>

        @if($n->module)
        <span class="badge info">
            {{ strtoupper($n->module) }}
        </span>
        @endif

    </div>

    <div style="margin-top:10px; display:flex; gap:10px;">

        @if(!$n->lu)
        <form method="POST" action="{{ route('notifications.read', $n) }}">
            @csrf
            @method('PATCH')

            <button class="btn-read">
                Marquer comme lu
            </button>
        </form>
        @endif

        <form method="POST" action="{{ route('notifications.destroy', $n) }}">
            @csrf
            @method('DELETE')

            <button class="btn-delete">
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

<p style="text-align:center;">Aucune notification.</p>

@endif

</div>

</body>
</html>