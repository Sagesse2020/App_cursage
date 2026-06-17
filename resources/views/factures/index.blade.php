<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<title>Liste des factures</title>

<style>

body{
    margin:0;
    font-family:'Segoe UI',sans-serif;
    background:#0f172a;
    color:#e2e8f0;
}

.container{
    max-width:1200px;
    margin:40px auto;
    padding:20px;
}

/* TITLE */
h2{
    font-size:28px;
    margin-bottom:20px;
    background:linear-gradient(90deg,#00e6ff,#4facfe);
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}

/* CARD */
.card{
    background:rgba(17,24,39,.92);
    border-radius:18px;
    padding:15px;
    border:1px solid rgba(255,255,255,.06);
    box-shadow:0 20px 50px rgba(0,0,0,.35);
    overflow-x:auto;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    min-width:800px;
}

thead{
    background:#020617;
}

th{
    text-align:left;
    padding:14px;
    color:#94a3b8;
    font-size:13px;
}

td{
    padding:14px;
    border-bottom:1px solid rgba(255,255,255,.06);
}

tr:hover{
    background:#172036;
}

/* BADGES */
.badge{
    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
    display:inline-block;
}

.paid{
    background:#16a34a;
}

.pending{
    background:#f59e0b;
}

.danger{
    background:#ef4444;
}

/* BUTTONS */
.btn{
    padding:6px 10px;
    border-radius:8px;
    text-decoration:none;
    font-size:12px;
    margin-right:5px;
    display:inline-block;
    font-weight:bold;
}

.btn-view{
    background:#334155;
    color:white;
}

.btn-edit{
    background:#f59e0b;
    color:white;
}

.btn-del{
    background:#ef4444;
    color:white;
}

.btn-add{
    background:#00e6ff;
    color:#0f172a;
    padding:10px 15px;
    border-radius:10px;
    text-decoration:none;
    font-weight:bold;
    display:inline-block;
    margin-bottom:15px;
}

/* RESPONSIVE */
@media(max-width:768px){
    table{
        min-width:600px;
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

    <h2>📄 Gestion des factures</h2>

    <form method="GET" style="margin-bottom:20px;display:flex;gap:10px;flex-wrap:wrap;">

    <input type="text" name="numero" placeholder="N° facture"
        style="padding:10px;border-radius:10px;border:none;background:#1e293b;color:white;">

    <select name="client"
        style="padding:10px;border-radius:10px;border:none;background:#1e293b;color:white;">
        <option value="">Tous clients</option>
        @foreach($clients as $client)
            <option value="{{ $client->id }}">{{ $client->nom }}</option>
        @endforeach
    </select>

    <select name="statut"
        style="padding:10px;border-radius:10px;border:none;background:#1e293b;color:white;">
        <option value="">Statut</option>
        <option value="payée">Payée</option>
        <option value="impayée">Impayée</option>
    </select>

    <input type="date" name="date"
        style="padding:10px;border-radius:10px;border:none;background:#1e293b;color:white;">

    <button type="submit"
        style="padding:10px 15px;background:#00e6ff;border:none;border-radius:10px;font-weight:bold;">
        🔎 Filtrer
    </button>

</form>

    <a href="{{ route('factures.create') }}" class="btn-add">+ Nouvelle facture</a>

    <div class="card">

        <table>

            <thead>
                <tr>
                    <th>N°</th>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Total</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

            @foreach($factures as $facture)

                <tr>
                    <td>{{ $facture->numero }}</td>
                    <td>{{ $facture->date->format('d/m/Y') }}</td>
                    <td>{{ $facture->client->nom ?? '-' }}</td>
                    <td>{{ number_format($facture->total,0,',',' ') }} FCFA</td>

                    <td>
                        <span class="badge {{ $facture->statut == 'payée' ? 'paid' : 'pending' }}">
                            {{ $facture->statut }}
                        </span>
                    </td>

                    <td>

                        <a href="{{ route('factures.show',$facture->id)}}" class="btn btn-view">Voir</a>

                        @if(auth()->id() === $facture->user_id || auth()->user()->niveau_admin >= 2)

                            <a href="{{ route('factures.edit',$facture->id) }}" class="btn btn-edit">Modifier</a>

                            <form method="POST"
                                  action="{{ route('factures.destroy',$facture->id) }}"
                                  style="display:inline;"
                                  onsubmit="return confirm('Supprimer cette facture ?');">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-del">Supprimer</button>

                            </form>

                        @endif

                        <a href="{{ route('factures.print',$facture->id)}}" class="btn btn-view">Imprimer</a>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

</body>
</html>