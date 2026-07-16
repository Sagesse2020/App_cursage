<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<title>Gestion des pertes</title>


<style>

body{

font-family:Arial;
background:#f1f5f9;
padding:30px;

}


.container{

max-width:1400px;
margin:auto;

}


.card{

background:white;
padding:20px;
border-radius:12px;
box-shadow:0 5px 20px #ddd;
margin-bottom:25px;

}


.stats{

display:grid;
grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
gap:20px;

}


h2{

color:#111827;

}



table{

width:100%;
border-collapse:collapse;
background:white;

}


th{

background:#111827;
color:white;
padding:15px;

}


td{

padding:12px;
border-bottom:1px solid #ddd;

}


.badge{

padding:6px 12px;
border-radius:20px;
color:white;

}


.deces{
background:#dc2626;
}

.perime{
background:#f59e0b;
}

.casse{
background:#7c3aed;
}

.vol{
background:#991b1b;
}


button{

background:#dc2626;
color:white;
border:none;
padding:8px 15px;
border-radius:6px;

}


input,select{

padding:10px;
border-radius:8px;
border:1px solid #ccc;

}


</style>


</head>


<body>


<div class="container">


<h1>
⚠️ Gestion des pertes
</h1>



<div class="stats">


<div class="card">
<h3>Total pertes</h3>
<h2>
{{ number_format($total,0,',',' ') }} FCFA
</h2>
</div>



<div class="card">
<h3>Nombre</h3>
<h2>
{{ $nombre }}
</h2>
</div>



<div class="card">
<h3>Décès</h3>
<h2>
{{ $deces }}
</h2>
</div>



<div class="card">
<h3>Périmés</h3>
<h2>
{{ $perimes }}
</h2>
</div>



</div>




<div class="card">


<form method="GET">


<input 
name="search"
placeholder="Recherche..."
value="{{request('search')}}"
>


<select name="type">


<option value="">
Tous
</option>


<option value="Décès">
Décès
</option>


<option value="Produit périmé">
Produit périmé
</option>


<option value="Produit cassé">
Produit cassé
</option>


<option value="Vol">
Vol
</option>


</select>


<input 
type="date"
name="debut"
value="{{request('debut')}}"
>


<input 
type="date"
name="fin"
value="{{request('fin')}}"
>


<button>
Filtrer
</button>


</form>


</div>





<table>


<thead>

<tr>

<th>Date</th>

<th>Type</th>

<th>Libellé</th>

<th>Montant</th>

<th>Description</th>

<th>Utilisateur</th>

<th>Action</th>

</tr>

</thead>



<tbody>



@forelse($pertes as $perte)


<tr>


<td>

{{ $perte->created_at->format('d/m/Y') }}

</td>



<td>

<span class="badge 
@if($perte->type=='Décès')
deces

@elseif($perte->type=='Produit périmé')
perime

@elseif($perte->type=='Produit cassé')
casse

@else
vol

@endif
">

{{$perte->type}}

</span>


</td>



<td>

{{$perte->libelle}}

</td>



<td>

{{number_format($perte->montant,0,',',' ')}} FCFA

</td>



<td>

{{$perte->description ?? '-'}}

</td>



<td>

{{$perte->user->name ?? 'Système'}}

</td>



<td>


<form method="POST"
action="{{route('pertes.destroy',$perte)}}">


@csrf

@method('DELETE')


<button onclick="return confirm('Supprimer ?')">

🗑

</button>


</form>


</td>



</tr>


@empty


<tr>

<td colspan="7">

Aucune perte enregistrée

</td>

</tr>


@endforelse



</tbody>


</table>


<br>


{{ $pertes->links() }}



</div>


</body>


</html>