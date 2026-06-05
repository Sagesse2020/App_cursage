<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Paiements</title>

<style>
body{
    font-family:Arial;
    background:#f1f5f9;
    padding:25px;
}

.container{
    max-width:1200px;
    margin:auto;
}

h1{
    margin-bottom:20px;
}

/* FILTRES */
.filters{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
    margin-bottom:20px;
}

.filters input,
.filters select{
    padding:10px;
    border-radius:8px;
    border:1px solid #ccc;
}

.filters button{
    padding:10px 15px;
    background:#2563eb;
    color:white;
    border:none;
    border-radius:8px;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:10px;
    overflow:hidden;
}

th{
    background:#0f172a;
    color:white;
    padding:12px;
}

td{
    padding:12px;
    border-bottom:1px solid #eee;
}

/* BADGES */
.entree{background:#16a34a;color:white;padding:5px 10px;border-radius:20px;}
.sortie{background:#dc2626;color:white;padding:5px 10px;border-radius:20px;}

.pagination{
    margin-top:15px;
}
</style>
</head>

<body>

<div class="container">

<h2>Liste des Paiements</h2>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Montant</th>
            <th>Type</th>
            <th>Mode</th>
            <th>Statut</th>
            <th>Date</th>

            <th>Réservation</th>
            <th>Vente</th>
            <th>Commande</th>
            <th>Facture</th>
            <th>Achat</th>

            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($paiements as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->montant }}</td>
            <td>{{ $p->type }}</td>
            <td>{{ $p->mode_paiement }}</td>
            <td>{{ $p->statut }}</td>
            <td>{{ $p->date_paiement }}</td>

            <td>{{ $p->reservation?->id }}</td>
            <td>{{ $p->vente?->id }}</td>
            <td>{{ $p->commande?->id }}</td>
            <td>{{ $p->facture?->id }}</td>
            <td>{{ $p->achat?->id }}</td>

            <td>
                <a href="{{ route('paiements.edit', $p) }}">Edit</a>

                <form method="POST" action="{{ route('paiements.destroy', $p) }}">
                    @csrf
                    @method('DELETE')
                    <button>Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $paiements->links() }}

</div>

</body>
</html>