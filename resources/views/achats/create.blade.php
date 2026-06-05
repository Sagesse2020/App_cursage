<form
method="POST"
action="{{ route('achats.store') }}"
>

@csrf

<select name="produit_id">

@foreach($produits as $produit)

<option value="{{ $produit->id }}">
{{ $produit->nom }}
</option>

@endforeach

</select>

<input
type="number"
name="quantite"
>

<input
type="number"
step="0.01"
name="prix_unitaire"
>

<input
type="text"
name="fournisseur"
>

<input
type="date"
name="date_achat"
>

<textarea
name="observation"
></textarea>

<button>

Enregistrer

</button>

</form>