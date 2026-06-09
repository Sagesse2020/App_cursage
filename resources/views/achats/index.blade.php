<!DOCTYPE html>
<html>
<head>
<title>Achats</title>
</head>

<body>

<h1>Liste des achats</h1>

<table border="1">

<tr>

<th>Référence</th>
<th>Produit</th>
<th>Qté</th>
<th>Total</th>
<th>Date</th>
<th>Action</th>

</tr>

@foreach($achats as $achat)

<tr>

<td>{{ $achat->reference }}</td>

<td>{{ $achat->produit->nom }}</td>

<td>{{ $achat->quantite }}</td>

<td>{{ $achat->montant_total }}</td>

<td>{{ $achat->date_achat }}</td>

<td>

<a href="{{ route('achats.show',$achat) }}">
Voir
</a>

@if(auth()->id() === $achat->user_id || auth()->user()->niveau == 3)
              <a href="{{ route('achats.edit',$achat) }}"> Modifier</a>
              <a href="{{ route('achats.destroy',$achat->id) }}" class="btn"> supprimer </a>
            @endif
            @if(auth()->id() === $achat->user_id || auth()->user()->niveau == 3)
             <a href="{{ route('achats.create') }}"> Ajouter </a>
            @endif

</td>

</tr>

@endforeach

</table>

{{ $achats->links() }}

</body>
</html>