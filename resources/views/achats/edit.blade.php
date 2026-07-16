<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<title>Modifier un achat</title>


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
color:white;
padding:12px 18px;
border-radius:8px;
text-decoration:none;

}



.card{

background:#111827;
padding:30px;
border-radius:15px;

box-shadow:0 10px 30px rgba(0,0,0,.4);

}



.form-group{

margin-bottom:20px;

}



label{

display:block;
margin-bottom:8px;
color:#94a3b8;
font-weight:bold;

}



input,
select,
textarea{

width:100%;

padding:12px;

border:none;

border-radius:8px;

background:#1f2937;

color:white;

font-size:15px;

}



textarea{

height:120px;

}



.row{

display:grid;

grid-template-columns:1fr 1fr;

gap:20px;

}



button{

background:#16a34a;

color:white;

padding:14px 25px;

border:none;

border-radius:8px;

cursor:pointer;

font-weight:bold;

font-size:16px;

}



button:hover{

background:#15803d;

}



.error{

background:#dc2626;

padding:15px;

border-radius:10px;

margin-bottom:20px;

}


</style>

</head>


<body>



<div class="container">



<div class="header">


<h1>
✏️ Modifier l'achat
</h1>



<a class="btn"
href="{{route('achats.index')}}">

⬅ Retour

</a>


</div>





<div class="card">



@if($errors->any())


<div class="error">

<ul>

@foreach($errors->all() as $error)

<li>
{{$error}}
</li>

@endforeach

</ul>

</div>


@endif





<form method="POST"
action="{{route('achats.update',$achat)}}">


@csrf

@method('PUT')





<div class="row">


<div class="form-group">


<label>
Produit
</label>


<select name="produit_id" required>


@foreach($produits as $produit)


<option value="{{$produit->id}}"

@if($achat->produit_id == $produit->id)

selected

@endif

>


{{$produit->nom}}

(Stock :
{{$produit->stock}}
)

</option>


@endforeach


</select>


</div>






<div class="form-group">


<label>
Quantité
</label>


<input

type="number"

name="quantite"

min="1"

value="{{$achat->quantite}}"

required

>


</div>


</div>







<div class="row">


<div class="form-group">


<label>
Prix unitaire
</label>


<input

type="number"

name="prix_unitaire"

step="0.01"

value="{{$achat->prix_unitaire}}"

required

>


</div>





<div class="form-group">


<label>
Date achat
</label>


<input

type="date"

name="date_achat"

value="{{$achat->date_achat}}"

required

>

</div>

</div>

<div class="form-group">

<label>
Fournisseur
</label>


<select name="fournisseur_id">


<option value="">
-- Choisir un fournisseur --
</option>



@foreach($fournisseurs as $fournisseur)


<option 

value="{{ $fournisseur->id }}"


@if($achat->fournisseur_id == $fournisseur->id)

selected

@endif

>


{{ $fournisseur->nom }}


</option>



@endforeach


</select>



@error('fournisseur_id')

<div class="field-error">

{{ $message }}

</div>

@enderror

</div>

<div class="form-group">


<label>
Observation
</label>


<textarea

name="observation"

>{{$achat->observation}}</textarea>

</div>

<button>

💾 Mettre à jour

</button>

</form>

</div>

</div>

</body>

</html>