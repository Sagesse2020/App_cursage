<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Détail chien</title>
</head>

<body>

<h1>
{{ $chien->nom }}
</h1>

@if($chien->photo)

<img
src="{{ asset('storage/'.$chien->photo) }}"
width="350"
>

@endif

<p><strong>Référence :</strong> {{ $chien->reference }}</p>

<p><strong>Race :</strong> {{ $chien->race->nom }}</p>

<p><strong>Sexe :</strong> {{ $chien->sexe }}</p>

<p><strong>Date naissance :</strong> {{ $chien->date_naissance }}</p>

<p><strong>Poids :</strong> {{ $chien->poids }} Kg</p>

<p><strong>Couleur :</strong> {{ $chien->couleur }}</p>

<p><strong>Puce :</strong> {{ $chien->numero_puce }}</p>

<p><strong>Pedigree :</strong> {{ $chien->numero_pedigree }}</p>

<p><strong>Vacciné :</strong>
{{ $chien->vacciné ? 'Oui' : 'Non' }}
</p>

<p><strong>Dressé :</strong>
{{ $chien->dresse ? 'Oui' : 'Non' }}
</p>

<p><strong>Statut :</strong>
{{ $chien->statut }}
</p>

<p><strong>Prix :</strong>
{{ number_format($chien->prix_base,0,',',' ') }}
FCFA
</p>

<p><strong>Notes :</strong>
{{ $chien->notes }}
</p>

</body>
</html>