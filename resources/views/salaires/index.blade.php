<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Salaires</title>

<style>
body{
      font-family:'Segoe UI';background:#f1f5f9;padding:25px;
}
.topbar{
      display:flex;justify-content:space-between;margin-bottom:20px;
}
.btn{
      background:#2563eb;color:#fff;padding:10px 15px;border-radius:10px;text-decoration:none;
}
.grid{
      display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:20px;
}
.card{
      background:white;padding:20px;border-radius:15px;
}
.amount{
      font-size:22px;font-weight:bold;color:#2563eb;
      }
</style>

</head>
<body>

<div class="topbar">
<h1>💼 Salaires</h1>
<a href="{{ route('salaires.create') }}" class="btn">+ Ajouter</a>
</div>

<div class="grid">

@foreach($salaires as $salaire)

<div class="card">

<h2>{{ $salaire->employee->nom ?? 'Employé' }}</h2>

<p>Mois : {{ $salaire->mois }}</p>

<p class="amount">
{{ number_format($salaire->montant_net,0,',',' ') }} FCFA
</p>

<a href="{{ route('salaires.show',$salaire) }}" class="btn">Voir</a>

</div>

@endforeach

</div>

{{ $salaires->links() }}

</body>
</html>