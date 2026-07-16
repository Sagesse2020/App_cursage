<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<title>Détail achat</title>


<style>


body{

font-family:Segoe UI;

background:#0f172a;

color:white;

padding:30px;

}



.container{

max-width:900px;

margin:auto;

}



.header{

display:flex;

justify-content:space-between;

align-items:center;

margin-bottom:30px;

}



h1{

color:#00e6ff;

}



.btn{

background:#374151;

padding:12px 18px;

border-radius:8px;

text-decoration:none;

color:white;

}



.card{

background:#111827;

padding:30px;

border-radius:15px;

box-shadow:0 10px 30px rgba(0,0,0,.4);

}



.info{

display:grid;

grid-template-columns:1fr 1fr;

gap:20px;

}



.box{

background:#1f2937;

padding:20px;

border-radius:10px;

}



.title{

color:#94a3b8;

font-size:14px;

margin-bottom:8px;

}



.value{

font-size:20px;

font-weight:bold;

color:#00e6ff;

}



.description{

margin-top:20px;

background:#1f2937;

padding:20px;

border-radius:10px;

}



</style>

</head>



<body>



<div class="container">



<div class="header">


<h1>
📦 Détail de l'achat
</h1>


<a class="btn"
href="{{route('achats.index')}}">

⬅ Retour

</a>


</div>






<div class="card">





<div class="info">



<div class="box">

<div class="title">
Référence
</div>

<div class="value">

{{$achat->reference}}

</div>

</div>





<div class="box">

<div class="title">
Produit
</div>

<div class="value">

{{$achat->produit->nom}}

</div>

</div>





<div class="box">

<div class="title">
Quantité
</div>

<div class="value">

{{$achat->quantite}}

</div>

</div>





<div class="box">

<div class="title">
Prix total
</div>

<div class="value">

{{number_format($achat->montant_total,0,',',' ')}} FCFA

</div>

</div>





<div class="box">

<div class="title">
Fournisseur
</div>

<div class="value">

{{$achat->fournisseur ?? 'Non défini'}}

</div>

</div>






<div class="box">

<div class="title">
Date achat
</div>

<div class="value">

{{$achat->date_achat}}

</div>

</div>




<div class="box">

<div class="title">
Enregistré par
</div>

<div class="value">

{{$achat->user->name ?? 'Système'}}

</div>

</div>




</div>






<div class="description">


<h3>
📝 Observation
</h3>


<p>

{{$achat->observation ?? 'Aucune observation'}}

</p>


</div>





</div>

</div>


</body>

</html>