<!DOCTYPE html>

<html lang="fr">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Partenaires</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
font-family:'Segoe UI',sans-serif;
background:#f1f5f9;
padding:25px;
color:#1e293b;
}

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
}

.btn{
background:#2563eb;
color:white;
padding:12px 18px;
border-radius:12px;
text-decoration:none;
font-weight:600;
}

.btn:hover{
background:#1d4ed8;
}

.grid{
display:grid;
grid-template-columns:
repeat(auto-fit,minmax(320px,1fr));
gap:25px;
}

.card{
background:white;
border-radius:20px;
overflow:hidden;
box-shadow:0 10px 30px rgba(0,0,0,.08);
transition:.3s;
}

.card:hover{
transform:translateY(-5px);
}

.image-box{
height:280px;
background:#e2e8f0;
}

.image-box img{
width:100%;
height:100%;
object-fit: contain ;
}

.content{
padding:22px;
}

.name{
font-size:24px;
font-weight:bold;
margin-bottom:10px;
}

.info{
margin-bottom:8px;
color:#475569;
}

.commission{
font-size:22px;
font-weight:bold;
color:#2563eb;
margin-top:15px;
}

.badge{
display:inline-block;
padding:7px 15px;
border-radius:30px;
margin-top:10px;
font-size:13px;
font-weight:bold;
}

.badge.vendeur{
background:#dbeafe;
color:#1d4ed8;
}

.badge.apporteur_affaires{
background:#dcfce7;
color:#166534;
}

.status{
display:inline-block;
padding:7px 15px;
border-radius:30px;
margin-top:10px;
font-size:13px;
font-weight:bold;
}

.status.actif{
background:#dcfce7;
color:#166534;
}

.status.suspendu{
background:#fee2e2;
color:#991b1b;
}

.status.inactif{
background:#e2e8f0;
color:#334155;
}

.actions{
margin-top:20px;
display:flex;
gap:10px;
flex-wrap:wrap;
}

.btn-dark{
background:#0f172a;
}

.btn-danger{
background:#dc2626;
border:none;
cursor:pointer;
color:white;
padding:12px 18px;
border-radius:12px;
}

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

<h1>🤝 Partenaires</h1>

<a
href="{{ route('partenaires.create') }}"
class="btn">

* Ajouter un partenaire

</a>

</div>

<div class="grid">

@foreach($partenaires as $partenaire)

<div class="card">

<div class="image-box">

@if($partenaire->photo)

<img
src="{{ asset('storage/'.$partenaire->photo) }}">

@else

<img
src="{{ asset('default-user.png') }}">

@endif

</div>

<div class="content">

<div class="name">

{{ $partenaire->nom }}
{{ $partenaire->prenom }}

</div>

<div class="info">
📞 {{ $partenaire->telephone }}
</div>

<div class="info">
📧 {{ $partenaire->email }}
</div>

<div class="info">
🏢 {{ $partenaire->entreprise }}
</div>

<div class="commission">
💰 {{ $partenaire->commission }} %
</div>

<span
class="badge {{ $partenaire->type_partenaire }}">

@if($partenaire->type_partenaire == 'vendeur')

Partenaire vendeur

@else

Apporteur d'affaires

@endif

</span>

<br>

<span
class="status {{ $partenaire->statut }}">

{{ $partenaire->statut }}

</span>

<div class="actions">

<a
href="{{ route('partenaires.show',$partenaire) }}"
class="btn">

Voir

</a>

@if(auth()->user()->niveau_admin >= 2)

<a
href="{{ route('partenaires.edit',$partenaire) }}"
class="btn-dark btn">

Modifier

</a>

<form
method="POST"
action="{{ route('partenaires.destroy',$partenaire) }}"
onsubmit="return confirm('Supprimer ce partenaire ?')">

@csrf
@method('DELETE')

<button
type="submit"
class="btn-danger">

Supprimer

</button>

</form>

@endif

</div>

</div>

</div>

@endforeach

</div>

<div style="margin-top:30px;">
{{ $partenaires->links() }}
</div>

</body>
</html>
