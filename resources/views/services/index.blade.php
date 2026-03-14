<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Liste des services</title>
<style>
/* Table globale */
.table-pro {
    width: 100%;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
    font-size: 14px;
}

.table-pro th, .table-pro td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.table-pro th {
    background-color: #f8f8f8;
    color: #333;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.table-pro tr:hover {
    background-color: #f1f1f1;
}

.table-pro .text-right {
    text-align: right;
}

.table-pro .text-center {
    text-align: center;
}

/* Boutons */
.btn {
    padding: 6px 12px;
    border-radius: 5px;
    text-decoration: none;
    color: white;
    background-color: #4CAF50; /* vert */
    font-size: 13px;
    transition: 0.3s;
}

.btn:hover {
    background-color: #45a049;
}
</style>
</head>
<body>
     <h2>Services CURSAGE</h2>
<table class="table-pro">
    <thead>
        <tr>
            <th>Nom du service</th>
            <th>Description</th>
            <th>Prix de vente (CFA)</th>
            <th>Statut</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($services as $service)
        <tr>
            <td>{{ $service->nom }}</td>
            <td>{{ $service->description }}</td>
            <td class="text-right">{{ number_format($service->prix_vente, 0, ',', ' ') }}</td>
            <td class="text-center">{{ $service->statut }}</td>
            <td class="text-center">
                <a href="{{ route('services.show', $service->id) }}" class="btn">Voir</a>
                <a href="{{ route('services.edit', $service->id) }}" class="btn">Modifier</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

</div>
</body>
</html>
