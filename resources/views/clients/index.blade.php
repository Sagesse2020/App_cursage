<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des Clients</title>
   <style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:"Segoe UI",Tahoma,sans-serif;
}

body{
background:#f4f7fa;
padding:20px;
color:#333;
}

.container{
max-width:1400px;
margin:auto;
background:#fff;
padding:25px;
border-radius:15px;
box-shadow:0 5px 20px rgba(0,0,0,.08);
}

h1{
text-align:center;
margin-bottom:25px;
color:#0d6efd;
font-size:2rem;
}

.empty-message{
text-align:center;
padding:30px;
color:#dc3545;
font-size:18px;
font-weight:600;
}

.table-responsive{
overflow-x:auto;
}

table{
width:100%;
border-collapse:collapse;
min-width:900px;
}

thead{
background:#0d6efd;
color:white;
}

th{
padding:15px;
text-align:left;
font-weight:600;
}

td{
padding:15px;
border-bottom:1px solid #e5e7eb;
}

tbody tr:nth-child(even){
background:#f8fafc;
}

tbody tr:hover{
background:#eaf3ff;
transition:.3s;
}

.actions{
display:flex;
gap:8px;
align-items:center;
}

.actions a,
.actions button{
width:40px;
height:40px;
display:flex;
justify-content:center;
align-items:center;
border:none;
border-radius:8px;
cursor:pointer;
text-decoration:none;
transition:.3s;
}

.actions a{
background:#0d6efd;
color:white;
}

.btn-edit{
background:#f59e0b !important;
color:white;
}

.btn-delete{
background:#dc3545;
color:white;
}

.actions a:hover,
.actions button:hover{
transform:translateY(-2px);
opacity:.9;
}

.pagination{
display:flex;
justify-content:center;
margin-top:25px;
gap:10px;
}

.pagination a{
padding:10px 15px;
background:#0d6efd;
color:white;
text-decoration:none;
border-radius:8px;
}

.pagination a:hover{
background:#0b5ed7;
}

@media(max-width:768px){

.container{
padding:15px;
}

h1{
font-size:1.6rem;
}

th,
td{
padding:10px;
font-size:14px;
}

.actions{
flex-wrap:wrap;
}

}

.filters{
display:flex;
gap:15px;
margin:20px 0;
flex-wrap:wrap;
}

.filters input,
.filters select{
padding:12px;
border:none;
border-radius:8px;
background:#1f2937;
color:white;
min-width:220px;
}

.filters button{
padding:12px 18px;
background:#00e6ff;
color:black;
border:none;
border-radius:8px;
font-weight:bold;
cursor:pointer;
}
    </style>
</head>

<body>
    <div class="container">
        <h1>Liste des Clients</h1>
        
        <form method="GET" class="filters">

        <input type="text" name="search" placeholder="Nom, email, téléphone...">

        <button type="submit">Rechercher</button>
        </form>
        
        @if($clients->isEmpty())
        <p>Aucun client disponible.</p>
        @else
       <table>

<thead>
<tr>
<th>Nom</th>
<th>Email</th>
<th>Téléphone</th>
<th>Adresse</th>
<th>Actions</th>
</tr>
</thead>

<tbody>

@foreach($clients as $client)

<tr>

<td>{{ $client->nom }}</td>
<td>{{ $client->email }}</td>
<td>{{ $client->telephone }}</td>
<td>{{ $client->adresse }}</td>

<td class="actions">

<a href="{{ route('clients.show',$client) }}">
<i class="fas fa-eye"></i> Voir
</a>

@if(auth()->user()->niveau_admin >= 2)

<a href="{{ route('clients.edit',$client) }}" class="btn-edit">
<i class="fas fa-edit"></i> Modifier
</a>

<form action="{{ route('clients.destroy',$client) }}" method="POST" style="display:inline" "
      onsubmit="return confirm('Voulez-vous vraiment supprimer ce client ?');">
@csrf
@method('DELETE')

<button class="btn-delete">
<i class="fas fa-trash"></i> Supprimer
</button>

</form>

@endif

</td>

</tr>

@endforeach

</tbody>

</table>
        @endif
        <script>
    document.addEventListener('DOMContentLoaded', function () {
        const contextMenu = document.getElementById('contextMenu');
        let selectedClientId = null;

        // Fonction pour masquer le menu contextuel
        const hideContextMenu = () => {
            contextMenu.style.display = 'none';
        };

        // Afficher le menu contextuel au clic droit sur une ligne
        document.querySelectorAll('tbody tr').forEach(row => {
            row.addEventListener('contextmenu', function (e) {
                e.preventDefault();
                selectedClientId = this.querySelector('td:first-child').textContent.trim();

                // Positionner le menu contextuel
                contextMenu.style.top = `${e.pageY}px`;
                contextMenu.style.left = `${e.pageX}px`;
                contextMenu.style.display = 'block';
            });
        });

        // Cacher le menu contextuel lors d'un clic à l'extérieur
        document.addEventListener('click', hideContextMenu);

        // Actions pour chaque option du menu
        document.getElementById('edit').addEventListener('click', () => {
            if (selectedClientId) {
                window.location.href = `/clients/${selectedClientId}/edit`;
            }
        });

        document.getElementById('copy').addEventListener('click', () => {
            if (selectedClientId) {
                alert(`Copie du client ID ${selectedClientId} effectuée.`);
                // Ajoutez ici votre logique pour copier les informations
            }
        });

        document.getElementById('paste').addEventListener('click', () => {
            if (selectedClientId) {
                alert(`Données collées pour le client ID ${selectedClientId}.`);
                // Ajoutez ici votre logique pour coller les informations
            }
        });
    });
</script>
    </div>
</body>
</html>
