<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Modifier utilisateur | CURSAGE</title>


<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">


<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}


body{

    min-height:100vh;
    background:#182433;
    display:flex;
    justify-content:center;
    align-items:center;
    color:white;

}



.container{

    width:450px;
    background:#243447;
    padding:30px;
    border-radius:18px;
    box-shadow:0 15px 40px rgba(0,0,0,.4);

}



h1{

    text-align:center;
    color:#00d4ff;
    margin-bottom:25px;
    font-size:26px;

}



label{

    display:block;
    margin-top:15px;
    margin-bottom:6px;
    font-weight:600;

}



input,
select{

    width:100%;
    padding:12px;
    border:none;
    border-radius:8px;
    background:#182433;
    color:white;

}



select option{

    background:#243447;

}



.btn{

    margin-top:25px;
    width:100%;
    padding:14px;
    border:none;
    border-radius:10px;
    background:#00d4ff;
    color:#182433;
    font-weight:bold;
    cursor:pointer;
    font-size:15px;

}


.btn:hover{

    background:#00a8cc;

}




.alert{

    padding:12px;
    border-radius:8px;
    margin-bottom:15px;

}



.alert-danger{

    background:#e74c3c;

}


.alert-success{

    background:#2ecc71;

}




.partner-box{

    background:#182433;
    padding:15px;
    border-radius:12px;
    margin-top:20px;

}



.partner-title{

    color:#00d4ff;
    font-weight:bold;
    margin-bottom:10px;

}



.current{

    background:#243447;
    padding:10px;
    border-radius:8px;
    margin-bottom:10px;
    font-size:14px;

}


small{

    color:#b8c1ca;

}


</style>


</head>


<body>



<div class="container">


<h1>
✏ Modifier utilisateur
</h1>



@if(session('success'))

<div class="alert alert-success">

{{session('success')}}

</div>

@endif



@if($errors->any())

<div class="alert alert-danger">

@foreach($errors->all() as $error)

{{ $error }} <br>

@endforeach

</div>

@endif





<form action="{{route('users.update',$user->id)}}" method="POST">


@csrf

@method('PUT')




<label>

Nom

</label>


<input

type="text"

name="name"

value="{{old('name',$user->name)}}"

required>



<label>

Email

</label>


<input

type="email"

name="email"

value="{{old('email',$user->email)}}"

required>





<label>

Rôle

</label>


<select name="role">


<option value="user"

@if($user->role=='user')

selected

@endif

>

Utilisateur

</option>



<option value="admin"

@if($user->role=='admin')

selected

@endif

>

Administrateur

</option>


</select>





<label>

Niveau administrateur

</label>


<select name="niveau_admin">


<option value="">

Aucun

</option>


<option value="1"

@if($user->niveau_admin==1)

selected

@endif

>

Admin Niveau 1

</option>


<option value="2"

@if($user->niveau_admin==2)

selected

@endif

>

Admin Niveau 2

</option>



<option value="3"

@if($user->niveau_admin==3)

selected

@endif

>

Super Admin

</option>

</select>

<div class="partner-box">


<div class="partner-title">

🤝 Partenaire associé

</div>



@if($user->partenaire)


<div class="current">

Actuellement :

<br>


<strong>
@if($user->partenaire)

<div class="partner">

    <strong>{{ $user->partenaire->nom }}</strong>

    <small>

        @if($user->partenaire->type_partenaire == 'vendeur')
            🟢 Vendeur
        @elseif($user->partenaire->type_partenaire == 'apporteur_affaires')
            🔵 Apporteur d'affaires
        @elseif($user->partenaire->type_partenaire == 'chenil')
            🐶 Chenil
        @endif

    </small>

</div>

@else

Aucun partenaire

@endif

</strong>


<br>


<small>

{{$user->partenaire->nom}}

</small>


</div>


@else


<div class="current">

Aucun partenaire actuellement

</div>


@endif




<select name="partenaire_id">


<option value="">

❌ Aucun partenaire

</option>



@foreach($partenaires as $partenaire)


<option value="{{$partenaire->id}}"


@if($user->partenaire_id == $partenaire->id)

selected

@endif


>

@if($user->partenaire)

<div class="partner">

    <strong>{{ $user->partenaire->nom }}</strong>

    <small>

        @if($user->partenaire->type_partenaire == 'vendeur')
            🟢 Vendeur
        @elseif($user->partenaire->type_partenaire == 'apporteur_affaires')
            🔵 Apporteur d'affaires
        @elseif($user->partenaire->type_partenaire == 'chenil')
            🐶 Chenil
        @endif

    </small>

</div>

@else

Aucun partenaire

@endif

{{$partenaire->nom}}


</option>



@endforeach


</select>



</div>






<label>

Nouveau mot de passe

</label>


<small>

Laisser vide pour conserver l'ancien mot de passe

</small>


<input

type="password"

name="password"

placeholder="Nouveau mot de passe">





<label>

Confirmation du nouveau mot de passe

</label>


<input

type="password"

name="password_confirmation"

placeholder="Confirmer">




<button class="btn">

💾 Enregistrer les modifications

</button>



</form>


</div>


</body>

</html>