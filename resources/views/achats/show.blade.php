<h1>Détail Achat</h1>

<p>
Référence :
{{ $achat->reference }}
</p>

<p>
Produit :
{{ $achat->produit->nom }}
</p>

<p>
Quantité :
{{ $achat->quantite }}
</p>

<p>
Prix unitaire :
{{ $achat->prix_unitaire }}
</p>

<p>
Montant total :
{{ $achat->montant_total }}
</p>

<p>
Fournisseur :
{{ $achat->fournisseur }}
</p>

<p>
Date :
{{ $achat->date_achat }}
</p>

<p>
Utilisateur :
{{ $achat->user->name }}
</p>