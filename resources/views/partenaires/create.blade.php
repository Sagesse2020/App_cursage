<!-- resources/views/partners/create.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer Partenaire</title>
</head>
<body>
    <h1>Créer un Partenaire</h1>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <form action="{{ route('partners.store') }}" method="POST">
        @csrf
        <label>Nom</label>
        <input type="text" name="name" required><br>

        <label>Email</label>
        <input type="email" name="email"><br>

        <label>Téléphone</label>
        <input type="text" name="telephone"><br>

        <label>Adresse</label>
        <input type="text" name="adresse"><br>

        <label>Commission %</label>
        <input type="number" name="commission_percent" step="0.01"><br>

        <label>Status</label>
        <select name="status">
            <option value="actif">Actif</option>
            <option value="inactif">Inactif</option>
        </select><br><br>

        <button type="submit">Ajouter Partenaire</button>
    </form>
</body>
</html>
