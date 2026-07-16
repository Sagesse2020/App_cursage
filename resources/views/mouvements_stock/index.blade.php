<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Mouvements stock</title>


<style>


*{
    box-sizing:border-box;
    font-family:Segoe UI,Arial,sans-serif;
}



body{

    margin:0;
    padding:25px;

    background:#f1f5f9;

    color:#0f172a;

}



.container{

    max-width:1300px;

    margin:auto;

}



/* HEADER */

.header{

    display:flex;

    justify-content:space-between;

    align-items:center;

    flex-wrap:wrap;

    margin-bottom:25px;

}



h1{

    color:#0f172a;

}



/* BUTTON */

.btn{

    padding:10px 15px;

    border-radius:8px;

    text-decoration:none;

    color:white;

    display:inline-block;

    margin:3px;

}



.create{

    background:#2563eb;

}



.edit{

    background:#16a34a;

}



.delete{

    background:#dc2626;

    border:none;

    cursor:pointer;

}





/* ALERT */

.alert{

    padding:15px;

    border-radius:10px;

    margin-bottom:20px;

}


.success{

    background:#16a34a;

    color:white;

}


.error{

    background:#dc2626;

    color:white;

}



/* FILTRE */


.filters{

    background:white;

    padding:20px;

    border-radius:15px;

    margin-bottom:25px;

    display:flex;

    gap:10px;

    flex-wrap:wrap;

}



.filters input,
.filters select{

    padding:12px;

    border-radius:8px;

    border:1px solid #ddd;

    flex:1;

    min-width:180px;

}



.filters button{

    background:#2563eb;

    color:white;

    border:none;

    padding:12px 20px;

    border-radius:8px;

}





/* TABLE */


.table-container{

    overflow-x:auto;

}



table{

    width:100%;

    border-collapse:collapse;

    background:white;

    border-radius:15px;

    overflow:hidden;

}



th{

    background:#0f172a;

    color:white;

    padding:15px;

}



td{

    padding:12px;

    border-bottom:1px solid #e5e7eb;

}





tr:hover{

    background:#f8fafc;

}





/* BADGES */


.entree{

    background:#16a34a;

    color:white;

    padding:6px 12px;

    border-radius:20px;

}



.sortie{

    background:#dc2626;

    color:white;

    padding:6px 12px;

    border-radius:20px;

}





.actions{

    white-space:nowrap;

}



/* MOBILE */


@media(max-width:700px){


body{

padding:15px;

}


h1{

font-size:22px;

}



.filters{

flex-direction:column;

}



table{

font-size:13px;

}



.btn{

width:100%;

text-align:center;

}



}



</style>


</head>



<body>


<div class="container">



<div class="header">


<h1>
📦 Gestion des mouvements de stock
</h1>



<a href="{{route('mouvements_stock.create')}}" 
class="btn create">

+ Nouveau mouvement

</a>


</div>





@if(session('success'))

<div class="alert success">

{{session('success')}}

</div>

@endif




@if($errors->any())

<div class="alert error">

@foreach($errors->all() as $error)

{{ $error }}

@endforeach

</div>

@endif







<!-- FILTRES -->


<form method="GET" 
action="{{route('mouvements_stock.index')}}"
class="filters">



<input

type="text"

name="produit"

placeholder="Rechercher produit..."

value="{{request('produit')}}"

>



<select name="type">


<option value="">
Tous les mouvements
</option>


<option value="entree"
{{request('type')=='entree'?'selected':''}}>
Entrées
</option>



<option value="sortie"
{{request('type')=='sortie'?'selected':''}}>
Sorties
</option>



</select>





<input

type="date"

name="date_debut"

value="{{request('date_debut')}}"

>



<input

type="date"

name="date_fin"

value="{{request('date_fin')}}"

>



<button>

Filtrer

</button>




</form>








<div class="table-container">


<table>


<thead>


<tr>

<th>Produit</th>

<th>Type</th>

<th>Quantité</th>

<th>Motif</th>

<th>Utilisateur</th>

<th>Date</th>

<th>Actions</th>


</tr>


</thead>




<tbody>



@forelse($mouvements as $mouvement)



<tr>



<td>

{{ $mouvement->produit->nom ?? 'Produit supprimé'}}

</td>





<td>


<span class="{{$mouvement->type}}">

{{$mouvement->type}}

</span>


</td>





<td>

{{$mouvement->quantite}}

</td>





<td>

{{$mouvement->motif ?? '-'}}

</td>





<td>

{{$mouvement->user->name ?? 'Système'}}

</td>





<td>

{{$mouvement->created_at->format('d/m/Y H:i')}}

</td>






<td class="actions">



@if(
auth()->id()==$mouvement->user_id 
||
auth()->user()->niveau_admin>=2
)



<a 

href="{{route('mouvements_stock.edit',$mouvement)}}"

class="btn edit">

Modifier

</a>





<form

method="POST"

action="{{route('mouvements_stock.destroy',$mouvement)}}"

style="display:inline"

onsubmit="return confirm('Supprimer ce mouvement ?')">


@csrf

@method('DELETE')


<button class="btn delete">

Supprimer

</button>


</form>



@endif




</td>





</tr>



@empty


<tr>

<td colspan="7">

Aucun mouvement trouvé

</td>

</tr>



@endforelse





</tbody>


</table>


</div>






<div style="margin-top:20px">


{{$mouvements->links()}}

</div>

</div>


</body>

</html>