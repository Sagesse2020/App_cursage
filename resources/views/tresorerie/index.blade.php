<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Trésorerie CURSAGE</title>

<link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:"Segoe UI",Tahoma,sans-serif;
}

body{
    background:#0b1020;
    color:#f5f6fa;
    min-height:100vh;
    display:flex;
    flex-direction:column;
}

/*******************
NAVBAR
********************/

nav{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px 30px;
    background:#020617;
    flex-wrap:wrap;
    gap:20px;
}

.logo{
    width:180px;
    max-width:100%;
    height:auto;
}

nav ul{
    display:flex;
    list-style:none;
    gap:15px;
    flex-wrap:wrap;
}

nav ul li a{
    padding:10px 15px;
    border-radius:8px;
    text-decoration:none;
    color:#f5f6fa;
    transition:.3s;
}

nav ul li a:hover{
    background:#00e6ff20;
    color:#00e6ff;
}

/*******************
HEADER
********************/

.admin-header{
    padding:60px 20px;
    text-align:center;
}

.admin-header h1{
    color:#00e6ff;
    font-size:40px;
}

.admin-header p{
    margin-top:10px;
    color:#cbd5e1;
}

/*******************
CARDS
********************/

.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
    gap:25px;
    padding:30px;
}

.card{
    background:#111827;
    padding:25px;
    border-radius:15px;
    text-align:center;
    transition:.3s;
}

.card:hover{
    transform:translateY(-5px);
}

.card i{
    font-size:40px;
    color:#00e6ff;
    margin-bottom:15px;
}

.card h3{
    margin-bottom:10px;
}

.card p{
    font-size:18px;
}

/*******************
GRAPHIQUE
********************/

.chart-container{
    padding:30px;
}

#soldeChart{
    width:100% !important;
    max-height:450px;
}

/*******************
TABLEAU
********************/

.table-container{
    padding:30px;
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
    min-width:700px;
}

th,
td{
    padding:14px;
    text-align:left;
}

th{
    background:#1f2937;
}

td{
    background:#111827;
}

tr:nth-child(even){
    background:#1e293b;
}

/*******************
FOOTER
********************/

footer{
    margin-top:auto;
    padding:20px;
    text-align:center;
    background:#020617;
}

/*******************
TABLETTE
********************/

@media(max-width:992px){

    .admin-header h1{
        font-size:32px;
    }

}

/*******************
MOBILE
********************/

@media(max-width:768px){

    nav{
        flex-direction:column;
        text-align:center;
    }

    nav ul{
        justify-content:center;
    }

    .logo{
        width:140px;
    }

    .admin-header{
        padding:40px 15px;
    }

    .admin-header h1{
        font-size:28px;
    }

    .cards{
        padding:20px;
        grid-template-columns:1fr;
    }

    .chart-container,
    .table-container{
        padding:15px;
    }

}

/*******************
PETITS TELEPHONES
********************/

@media(max-width:480px){

    .admin-header h1{
        font-size:24px;
    }

    .card{
        padding:20px;
    }

    .card i{
        font-size:30px;
    }

    th,
    td{
        padding:10px;
        font-size:13px;
    }

}
</style>
</head>

<body>

<nav>
<img src="{{ asset('images/logo.png') }}" class="logo">
<ul>
<section class="admin-header">
<h1>Trésorerie CURSAGE</h1>
<p>Suivi financier global</p>
</section>

<!-- CARTES -->
<section class="cards">

<div class="card">
<i class="fas fa-wallet"></i>
<h3>Solde actuel</h3>
<p>{{ number_format($solde,0,',',' ') }} FCFA</p>
</div>

<div class="card">
<i class="fas fa-arrow-down"></i>
<h3>Total Entrées</h3>
<p>{{ number_format($totalEntrees,0,',',' ') }} FCFA</p>
</div>

<div class="card">
<i class="fas fa-arrow-up"></i>
<h3>Total Sorties</h3>
<p>{{ number_format($totalSorties,0,',',' ') }} FCFA</p>
</div>

</section>

<!-- GRAPHIQUE -->
<div class="chart-container">
<canvas id="soldeChart"></canvas>
</div>

<!-- TABLEAU -->
<div class="table-container">
<table>
<thead>
<tr>
<th>Date</th>
<th>Type</th>
<th>Montant</th>
<th>Description</th>
</tr>
</thead>

<tbody>
@foreach($transactions as $t)
<tr>
<td>{{ $t->date_transaction->format('d/m/Y') }}</td>

<td>
@if(in_array($t->type,['paiement_client','versement_cursage']))
Entrée
@else
Sortie
@endif
</td>

<td>{{ number_format($t->montant,0,',',' ') }} FCFA</td>
<td>{{ $t->notes }}</td>

</tr>
@endforeach
</tbody>
</table>
</div>

<footer style="text-align:center; padding:20px;">
<p>© 2026 CURSAGE</p>
</footer>

<script>
const ctx = document.getElementById('soldeChart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($labels) !!},
        datasets: [{
            label: 'Solde',
            data: {!! json_encode($cumulData) !!},
            borderColor:'#00e6ff',
            backgroundColor:'rgba(0,230,255,0.2)',
            tension:0.4,
            fill:true
        }]
    }
});
</script>
</body>
</html>
