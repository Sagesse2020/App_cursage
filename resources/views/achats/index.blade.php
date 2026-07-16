<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<title>Gestion des achats</title>


<style>

body{
font-family:Segoe UI;
background:#0f172a;
color:white;
padding:30px;
}


.container{
max-width:1400px;
margin:auto;
}


.header{

display:flex;
justify-content:space-between;
margin-bottom:25px;

}


.btn{

background:#06b6d4;
color:white;
padding:10px 15px;
border-radius:8px;
text-decoration:none;

}


.filter{

background:#111827;
padding:20px;
border-radius:15px;
margin-bottom:20px;

}


input{

padding:10px;
border-radius:8px;
border:none;
margin:5px;

}



button{

padding:10px;
border:none;
border-radius:8px;
cursor:pointer;

}



table{

width:100%;
border-collapse:collapse;
background:#111827;

}


th{

background:#020617;
color:#00e6ff;

}


td,th{

padding:12px;
border-bottom:1px solid #374151;

}



.edit{

background:#16a34a;
color:white;
padding:7px;
border-radius:6px;

}



.delete{

background:#dc2626;
color:white;

}



</style>

</head>


<body>


<div class="container">


<div class="header">

<h1>🛒 Gestion des achats</h1>


<a class="btn"
href="{{route('achats.create')}}">
Ajouter achat
</a>


</div>



<form class="filter">


<input
name="search"
placeholder="Recherche..."
value="{{request('search')}}"
>


<input
type="date"
name="debut"
>


<input
type="date"
name="fin"
>


<button>
Filtrer
</button>


</form>





<table>


<tr>

<th>Référence</th>
<th>Produit</th>
<th>Quantité</th>
<th>Total</th>
<th>Fournisseur</th>
<th>Date</th>
<th>Action</th>

</tr>



@foreach($achats as $achat)


<tr>


<td>{{$achat->reference}}</td>


<td>{{$achat->produit->nom}}</td>


<td>{{$achat->quantite}}</td>


<td>
{{number_format($achat->montant_total,0,',',' ')}} FCFA
</td>

<td>
{{ $achat->fournisseur->nom ?? 'Aucun fournisseur' }}
</td>

<td>
{{ $achat->date_achat }}
</td>

<td>

<a class="edit"
href="{{route('achats.edit',$achat)}}">
Modifier
</a>



<form
style="display:inline"
method="POST"
action="{{route('achats.destroy',$achat)}}">

@csrf

@method('DELETE')


<button class="delete">
Supprimer
</button>


</form>



</td>


</tr>



@endforeach


</table>


{{$achats->links()}}


</div>


</body>

</html>