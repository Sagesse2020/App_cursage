<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<title>Analyse financière</title>


<style>

body{

font-family:Segoe UI;
background:#0b1220;
color:white;
padding:30px;

}


h1{

margin-bottom:25px;

}



.filter{

background:#111827;
padding:20px;
border-radius:15px;
margin-bottom:25px;

display:flex;
gap:15px;
flex-wrap:wrap;

}


input,button{

padding:10px;
border-radius:8px;
border:none;

}


button{

background:#00e6ff;
cursor:pointer;

}



.cards{

display:grid;

grid-template-columns:
repeat(auto-fit,minmax(220px,1fr));

gap:20px;

}



.card{

background:#111827;
padding:25px;
border-radius:15px;

}



.card h3{

color:#94a3b8;

}



.value{

font-size:25px;
font-weight:bold;

}


.green{

color:#22c55e;

}


.red{

color:#ef4444;

}


.blue{

color:#38bdf8;

}



table{

width:100%;
margin-top:30px;
background:#111827;
border-collapse:collapse;

}



th,td{

padding:15px;
border-bottom:1px solid #374151;

}


th{

background:#020617;

}


</style>

</head>


<body>


<h1>
📊 Analyse financière CURSAGE
</h1>



<form class="filter">


<input 
type="date"
name="debut"
value="{{request('debut')}}">


<input 
type="date"
name="fin"
value="{{request('fin')}}">


<button>
Filtrer
</button>


</form>




<div class="cards">


<div class="card">

<h3>💰 Revenus</h3>

<div class="value green">

{{number_format($recettesTotal,0,',',' ')}} FCFA

</div>

</div>



<div class="card">

<h3>📦 Achats</h3>

<div class="value red">

{{number_format($achatsTotal,0,',',' ')}} FCFA

</div>

</div>



<div class="card">

<h3>💸 Dépenses</h3>

<div class="value red">

{{number_format($depensesTotal,0,',',' ')}} FCFA

</div>

</div>




<div class="card">

<h3>⚠️ Pertes</h3>

<div class="value red">

{{number_format($pertesTotal,0,',',' ')}} FCFA

</div>

</div>



<div class="card">

<h3>📈 Bénéfice net</h3>

<div class="value blue">

{{number_format($beneficeTotal,0,',',' ')}} FCFA

</div>

</div>


</div>





<h2 style="margin-top:40px">

Historique

</h2>



<table>


<tr>

<th>Période</th>

<th>Recettes</th>

<th>Achats</th>

<th>Dépenses</th>

<th>Pertes</th>

<th>Bénéfice</th>

</tr>



@foreach($stats as $stat)

<tr>

<td>{{$stat['periode']}}</td>

<td>{{number_format($stat['recettes'],0,',',' ')}}</td>

<td>{{number_format($stat['achats'],0,',',' ')}}</td>

<td>{{number_format($stat['depenses'],0,',',' ')}}</td>

<td>{{number_format($stat['pertes'],0,',',' ')}}</td>

<td>
<strong>
{{number_format($stat['benefice'],0,',',' ')}}
</strong>
</td>

</tr>


@endforeach


</table>


</body>

</html>