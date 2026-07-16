<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Nouveau mouvement stock</title>


<style>

*{
    box-sizing:border-box;
}


body{

    font-family:'Arial',sans-serif;
    background:#0f172a;
    min-height:100vh;
    padding:30px;
    color:white;

}



.container{

    max-width:650px;
    margin:auto;

}



.card{

    background:#111827;
    padding:30px;
    border-radius:18px;
    box-shadow:0 10px 30px rgba(0,0,0,.4);

}



h1{

    text-align:center;
    margin-bottom:25px;
    color:#00e6ff;

}



label{

    display:block;
    margin-bottom:8px;
    font-weight:bold;

}



.form-group{

    margin-bottom:20px;

}



input,
select,
textarea{


    width:100%;
    padding:13px;

    border-radius:10px;

    border:none;

    outline:none;

    background:#1f2937;

    color:white;

    font-size:15px;

}



textarea{

    resize:none;
    height:100px;

}



select option{

    color:black;

}



button{


    width:100%;

    padding:14px;

    background:#00e6ff;

    color:#0f172a;

    border:none;

    border-radius:10px;

    font-size:16px;

    font-weight:bold;

    cursor:pointer;

    transition:.3s;


}



button:hover{

    background:white;

}



.stock{


    background:#1e293b;

    padding:10px;

    border-radius:8px;

    margin-top:8px;

    font-size:14px;


}



.back{


    display:block;

    margin-top:20px;

    text-align:center;

    color:#00e6ff;

    text-decoration:none;

}



.alert{


    background:#dc2626;

    padding:12px;

    border-radius:8px;

    margin-bottom:15px;

}


.success{


    background:#16a34a;

    padding:12px;

    border-radius:8px;

}



@media(max-width:600px){

body{

padding:15px;

}


.card{

padding:20px;

}


}


</style>


</head>



<body>


<div class="container">


<div class="card">


<h1>
📦 Nouveau mouvement stock
</h1>



@if($errors->any())

<div class="alert">

<ul>

@foreach($errors->all() as $error)

<li>
{{ $error }}
</li>

@endforeach

</ul>

</div>

@endif





<form action="{{ route('mouvements_stock.store') }}" method="POST">

@csrf




<div class="form-group">


<label>
Produit
</label>


<select name="produit_id" required>


<option value="">
-- Choisir un produit --
</option>


@foreach($produits as $p)


<option 
value="{{ $p->id }}"
{{ old('produit_id')==$p->id ? 'selected':'' }}
>


{{ $p->nom }}


</option>


@endforeach


</select>



@if(old('produit_id'))

<div class="stock">

Stock actuel :
@php

$produitSelectionne=$produits->find(old('produit_id'));

@endphp


{{ $produitSelectionne->stock ?? 0 }}

unités


</div>

@endif



</div>





<div class="form-group">


<label>
Type de mouvement
</label>



<select name="type" required>


<option value="entree"
{{ old('type')=='entree'?'selected':'' }}
>

⬆ Entrée stock

</option>


<option value="sortie"
{{ old('type')=='sortie'?'selected':'' }}
>

⬇ Sortie stock

</option>


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

value="{{old('quantite')}}"

placeholder="Exemple : 10"

required

>


</div>






<div class="form-group">


<label>
Motif
</label>


<textarea

name="motif"

placeholder="Exemple : achat fournisseur, vente, perte..."

>{{old('motif')}}</textarea>



</div>






<button type="submit">

✅ Enregistrer le mouvement

</button>




</form>



<a href="{{route('mouvements_stock.index')}}" class="back">

⬅ Retour aux mouvements

</a>

</div>

</div>

</body>

</html>