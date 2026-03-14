<!-- resources/views/partners/create.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer Partenaire</title>
</head>
<style>
    body{font-family:Segoe UI;background:#f4f6f8;padding:40px}
form{
    max-width:700px;
    margin:auto;
    background:#fff;
    padding:30px;
    border-radius:18px;
}
input,textarea{
    width:100%;
    padding:12px;
    margin-top:10px;
}
button{
    margin-top:20px;
    background:#0a7;
    color:#fff;
    border:none;
    padding:14px;
    border-radius:8px;
    width:100%;
}
</style>
<body>
    <h1>Créer un Partenaire</h1>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <form action="{{ route('partenaires.store') }}" method="POST">
        @csrf

       @foreach($users as $user)

       <option value="{{ $user->id }}">
       {{ $user->nom }}
       </option>

        @endforeach
        <label>Nom</label>
        <input type="text" name="nom" required><br>

        <label>Téléphone</label>
        <input type="text" name="telephone"><br>

        <label>Email</label>
        <input type="email" name="email"><br>

        <label>Adresse</label>
        <input type="text" name="adresse"><br>

        <label>Commission %</label>
        <input type="number" name="pourcentage_commission" step="0.01"><br>

         <label>Notes</label>
        <input type="text" name="notes" ><br>

        <button type="submit">Ajouter Partenaire</button>
    </form>
</body>
</html>
