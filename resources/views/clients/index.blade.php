<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des Clients</title>
    <style>
        /* Général : corps de la page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Conteneur principal */
        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Titre principal */
        h1 {
            text-align: center;
            font-size: 2.2em;
            margin-bottom: 20px;
            color: #007bff;
        }

        /* Style du message "Aucun client disponible" */
        p {
            text-align: center;
            font-size: 1.2em;
            color: #d9534f;
        }

        /* Table de clients */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #ddd;
        }

        table th {
            background-color: #007bff;
            color: white;
            font-size: 1em;
        }

        table td {
            background-color: #f9f9f9;
            font-size: 1em;
        }

        table tr:nth-child(even) td {
            background-color: #f1f1f1;
        }

        /* Améliorer la visibilité des bordures lors du survol */
        table tr:hover td {
            background-color: #e9ecef;
        }

        /* Style de la pagination ou du bouton d'ajout, si nécessaire */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 10px 15px;
            margin: 0 5px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .pagination a:hover {
            background-color: #0056b3;
        }

         /* Style pour le menu contextuel */
    .context-menu {
        display: none;
        position: absolute;
        z-index: 1000;
        background-color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        padding: 10px 0;
        width: 150px;
    }

    .context-menu ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .context-menu li {
        padding: 10px 15px;
        cursor: pointer;
        font-size: 14px;
    }

    .context-menu li:hover {
        background-color: #f1f1f1;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Liste des Clients</h1>

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
<th>Password</th>
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
<td>{{ $client->password }}</td>

<td class="actions">

<a href="{{ route('clients.show',$client) }}">
<i class="fas fa-eye"></i>
</a>

@if(auth()->user()->niveau >= 2)

<a href="{{ route('clients.edit',$client) }}" class="btn-edit">
<i class="fas fa-edit"></i>
</a>

<form action="{{ route('clients.destroy',$client) }}" method="POST" style="display:inline">
@csrf
@method('DELETE')

<button class="btn-delete">
<i class="fas fa-trash"></i>
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
