<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Clôture Mensuelle</title>

<style>
body { background:#0b1020; color:#e5e7eb; font-family:Segoe UI; }
.container { padding:40px; }
.card {
    background:#111827;
    padding:30px;
    border-radius:16px;
    max-width:600px;
    margin:auto;
}
button {
    background:#00e6ff;
    border:none;
    padding:12px 20px;
    border-radius:8px;
    cursor:pointer;
    font-weight:bold;
}
</style>
</head>

<body>
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card p-4">
        <h1>📆 Clôture mensuelle</h1>
        <p>Mois : <strong>{{ $mois }}</strong></p>

        <p>Total entrées : {{ number_format($entrees, 2, ',', ' ') }} FCFA</p>
        <p>Total sorties : {{ number_format($sorties, 2, ',', ' ') }} FCFA</p>
        <p><strong>Résultat : {{ number_format($resultat, 2, ',', ' ') }} FCFA</strong></p>

        <form method="POST" action="{{ route('cloture.valider') }}">
            @csrf
            <button class="btn btn-primary mt-3">Valider la clôture</button>
        </form>
    </div>

    <h2 class="mt-5">Transactions du mois</h2>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Montant</th>
                <th>Destinataire</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $t)
            <tr>
                <td>{{ \Carbon\Carbon::parse($t->date_transaction)->format('d/m/Y') }}</td>
                <td>{{ $t->type }}</td>
                <td>{{ number_format($t->montant, 2, ',', ' ') }}</td>
                <td>{{ $t->destinataire }}</td>
                <td>{{ $t->notes }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
