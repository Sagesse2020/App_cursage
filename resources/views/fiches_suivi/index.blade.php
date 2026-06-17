<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<title>Fiches de suivi</title>

<style>

/* GLOBAL */
body{
    margin:0;
    font-family:'Segoe UI',sans-serif;
    background:#0f172a;
    color:#e2e8f0;
}

/* CONTAINER */
.container{
    max-width:1200px;
    margin:40px auto;
    padding:20px;
}

/* HEADER */
h1{
    font-size:28px;
    margin-bottom:20px;
    background:linear-gradient(90deg,#00e6ff,#4facfe);
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}

/* TOP BAR */
.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    margin-bottom:20px;
}

.btn-add{
    padding:10px 15px;
    background:#00e6ff;
    color:#0f172a;
    border:none;
    border-radius:10px;
    font-weight:bold;
    text-decoration:none;
}

/* TABLE CARD */
.table-card{
    background:rgba(17,24,39,.92);
    border-radius:18px;
    padding:15px;
    box-shadow:0 20px 50px rgba(0,0,0,.35);
    border:1px solid rgba(255,255,255,.06);
    overflow-x:auto;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    min-width:800px;
}

thead{
    background:#020617;
}

th{
    padding:14px;
    text-align:left;
    color:#94a3b8;
    font-size:13px;
}

td{
    padding:14px;
    border-bottom:1px solid rgba(255,255,255,.06);
}

tr:hover{
    background:#172036;
}

/* BADGES */
.badge-entree{
    background:#16a34a;
    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
}

.badge-sortie{
    background:#ef4444;
    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
}

/* ACTIONS */
.btn{
    padding:6px 10px;
    border-radius:8px;
    text-decoration:none;
    font-size:12px;
    margin-right:5px;
    display:inline-block;
    font-weight:bold;
}

.btn-view{
    background:#334155;
    color:white;
}

.btn-edit{
    background:#f59e0b;
    color:white;
}

.btn-del{
    background:#ef4444;
    color:white;
}

/* ALERT */
.success{
    background:#16a34a;
    padding:10px;
    border-radius:10px;
    margin-bottom:15px;
}

/* PAGINATION */
.pagination{
    margin-top:15px;
}

/* RESPONSIVE */
@media(max-width:768px){
    table{
        min-width:600px;
    }
}

</style>
</head>

<body>

<div class="container">

    <div class="topbar">
        <h1>📊 Fiches de suivi</h1>
        <a href="{{ route('fiches_suivi.create') }}" class="btn-add">+ Ajouter fiche</a>
    </div>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <div class="table-card">

        <table>

            <thead>
                <tr>
                    <th>Chien</th>
                    <th>Poids</th>
                    <th>Température</th>
                    <th>État</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

            @foreach($fiches as $f)

                <tr>
                    <td>{{ $f->chien->nom ?? '-' }}</td>
                    <td>{{ $f->poids }} kg</td>
                    <td>{{ $f->temperature }} °C</td>
                    <td>
                        <span class="badge-entree">{{ $f->etat_general }}</span>
                    </td>
                    <td>{{ $f->date_suivi }}</td>

                    <td>

                        @if(auth()->id() === $f->user_id || auth()->user()->niveau_admin >= 2)

                            <a href="{{ route('fiches_suivi.edit',$f) }}" class="btn btn-edit">Modifier</a>

                            <form action="{{ route('fiches_suivi.destroy',$f) }}"
                                  method="POST"
                                  style="display:inline;"
                                  onsubmit="return confirm('Supprimer cette fiche ?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-del">Supprimer</button>
                            </form>

                        @endif

                        <a href="{{ route('fiches_suivi.show',$f) }}" class="btn btn-view">Voir</a>

                    </td>
                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

    {{ $fiches->links() }}

</div>

</body>
</html>