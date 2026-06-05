<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Liste employés</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Segoe UI',sans-serif;
    background:#f1f5f9;
    color:#1e293b;
    padding:25px;
}

/* ================= HEADER ================= */

.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:35px;
    flex-wrap:wrap;
    gap:15px;
}

.topbar h1{
    font-size:32px;
    color:#0f172a;
}

a{
    text-decoration:none;
}

.btn{
    background:#2563eb;
    color:white;
    padding:12px 18px;
    border-radius:12px;
    transition:.3s;
    display:inline-block;
    font-weight:600;
}

.btn:hover{
    background:#1d4ed8;
    transform:translateY(-2px);
}

/* ================= GRID ================= */

.grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
    gap:25px;
}

/* ================= CARD ================= */

.card{
    background:white;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
    transition:.3s;
}

.card:hover{
    transform:translateY(-5px);
    box-shadow:0 15px 35px rgba(0,0,0,.12);
}

/* ================= IMAGE ================= */

.image-box{
    width:100%;
    height:280px;
    background:#e2e8f0;
    display:flex;
    justify-content:center;
    align-items:center;
    overflow:hidden;
}

.image-box img{
    width:100%;
    height:100%;
    object-fit:contain;
    background:white;
}

/* ================= CONTENT ================= */

.content{
    padding:22px;
}

.employee-name{
    font-size:23px;
    font-weight:bold;
    margin-bottom:10px;
    color:#0f172a;
}

.info{
    margin-bottom:8px;
    color:#475569;
    font-size:15px;
}

.salary{
    margin-top:15px;
    font-size:22px;
    font-weight:bold;
    color:#2563eb;
}

/* ================= BADGE ================= */

.badge{
    display:inline-block;
    margin-top:15px;
    padding:7px 14px;
    border-radius:30px;
    font-size:13px;
    font-weight:bold;
    text-transform:uppercase;
}

.badge.actif{
    background:#dcfce7;
    color:#166534;
}

.badge.suspendu{
    background:#fee2e2;
    color:#991b1b;
}

.badge.demission{
    background:#e2e8f0;
    color:#334155;
}

/* ================= ACTIONS ================= */

.actions{
    margin-top:20px;
    display:flex;
    gap:10px;
    flex-wrap:wrap;
}

.btn-secondary{
    background:#0f172a;
}

.btn-secondary:hover{
    background:#020617;
}

/* ================= RESPONSIVE ================= */

@media(max-width:768px){

    body{
        padding:15px;
    }

    .topbar h1{
        font-size:25px;
    }

    .image-box{
        height:230px;
    }

}

</style>

</head>

<body>

<div class="topbar">

<h1>👨‍💼 Employés</h1>

<a
href="{{ route('employees.create') }}"
class="btn"
>

+ Ajouter un employé

</a>

</div>

<div class="grid">

@foreach($employees as $employee)

<div class="card">

<div class="image-box">

@if($employee->photo)

<img
src="{{ asset('storage/'.$employee->photo) }}"
alt="Photo employé"
>

@else

<img
src="{{ asset('default-user.png') }}"
alt="Photo par défaut"
>

@endif

</div>

<div class="content">

<div class="employee-name">

{{ $employee->nom }}
{{ $employee->prenom }}

</div>

<div class="info">
📞 {{ $employee->telephone }}
</div>

<div class="info">
📧 {{ $employee->email }}
</div>

<div class="info">
💼 {{ $employee->poste }}
</div>

<div class="info">
📅 {{ $employee->date_embauche }}
</div>

<div class="salary">
💰 {{ number_format($employee->salaire,0,',',' ') }} FCFA
</div>

<span class="badge {{ $employee->statut }}">
{{ $employee->statut }}
</span>

<div class="actions">

<a
href="{{ route('employees.show',$employee) }}"
class="btn"
>

Voir

</a>

@if(auth()->user()->niveau_admin == 3)

<a
href="{{ route('employees.edit',$employee) }}"
class="btn btn-secondary"
>
Modifier
</a>

@endif

</div>

</div>

</div>

@endforeach

</div>

</body>
</html>