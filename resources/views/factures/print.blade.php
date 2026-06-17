<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<title>Facture {{ $facture->numero }}</title>

<style>

/* GLOBAL */
body{
    margin:0;
    padding:0;
    font-family:'Segoe UI',sans-serif;
    background:#0f172a;
    color:#e2e8f0;
}

/* CONTAINER */
.facture{
    max-width:900px;
    margin:40px auto;
    padding:25px;
}

/* CARD */
.card{
    background:rgba(17,24,39,.92);
    border:1px solid rgba(255,255,255,.06);
    border-radius:22px;
    padding:30px;
    box-shadow:0 20px 50px rgba(0,0,0,.4);
}

/* BUTTON */
.print-btn{
    margin-bottom:20px;
    padding:12px 18px;
    background:#00e6ff;
    color:#0f172a;
    border:none;
    border-radius:12px;
    cursor:pointer;
    font-weight:bold;
    transition:.2s;
}

.print-btn:hover{
    transform:scale(1.03);
}

/* HEADER */
.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    margin-bottom:25px;
}

/* LOGO */
.logo-container{
    display:flex;
    align-items:center;
    gap:12px;
}

.logo-img{
    width:65px;
    height:65px;
    border-radius:14px;
    object-fit:cover;
    background:rgba(0,230,255,.15);
    padding:4px;
    box-shadow:0 10px 25px rgba(0,230,255,.25);
}

/* TITLE */
.title{
    font-size:22px;
    font-weight:bold;
    background:linear-gradient(90deg,#00e6ff,#4facfe);
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}

.subtitle{
    font-size:12px;
    color:#94a3b8;
}

/* ENTREPRISE */
.entreprise{
    text-align:right;
    font-size:13px;
    color:#cbd5e1;
    line-height:1.5;
}

/* BADGE */
.badge{
    display:inline-block;
    margin-top:8px;
    padding:6px 12px;
    background:#16a34a;
    border-radius:20px;
    font-size:11px;
}

/* FACTURE INFOS */
h2{
    margin:0;
    font-size:20px;
}

.date{
    color:#94a3b8;
    margin-bottom:15px;
}

/* CLIENT */
.client-box{
    margin-top:15px;
    padding:15px;
    background:#1e293b;
    border-radius:14px;
}

.client-box strong{
    color:#00e6ff;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
    overflow:hidden;
    border-radius:12px;
}

thead{
    background:#020617;
}

th{
    padding:14px;
    text-align:left;
    font-size:13px;
    color:#94a3b8;
}

td{
    padding:14px;
    border-bottom:1px solid rgba(255,255,255,.06);
}

tr:hover{
    background:#172036;
}

/* TOTAL BOX */
.total-box{
    margin-top:25px;
    display:flex;
    justify-content:flex-end;
}

.total-card{
    background:#020617;
    padding:20px;
    border-radius:15px;
    min-width:280px;
    border:1px solid rgba(255,255,255,.08);
}

.total-line{
    display:flex;
    justify-content:space-between;
    margin-top:8px;
    font-size:14px;
}

.total-title{
    color:#00e6ff;
    font-weight:bold;
}

/* RESPONSIVE */
@media(max-width:768px){

    .header{
        flex-direction:column;
        align-items:flex-start;
        gap:15px;
    }

    .entreprise{
        text-align:left;
    }

    .total-box{
        justify-content:center;
    }
}

/* PRINT */
@media print{

    body{
        background:white;
        color:black;
    }

    .facture{
        margin:0;
        padding:0;
    }

    .card{
        box-shadow:none;
        border:none;
        background:white;
        color:black;
    }

    .print-btn{
        display:none;
    }
}

</style>

</head>

<body>

<div class="facture">

    <button class="print-btn" onclick="window.print()">
        🖨 Imprimer / PDF
    </button>

    <div class="card">

        <!-- HEADER -->
        <div class="header">

            <div class="logo-container">

                <img src="{{ asset('images/logo.png') }}" class="logo-img">

                <div>
                    <div class="title">CURSAGE</div>
                    <div class="subtitle">Plateforme intelligente</div>
                </div>

            </div>

            <div class="entreprise">
                <strong>Cursage Solutions</strong><br>
                Gestion & Services numériques<br>
                Pointe-Noire - Congo
                <div class="badge">FACTURE OFFICIELLE</div>
            </div>

        </div>

        <!-- FACTURE INFO -->
        <h2>Facture N° {{ $facture->numero }}</h2>

        <div class="date">
            Date : {{ $facture->date->format('d/m/Y') }}
        </div>

        <!-- CLIENT -->
        <div class="client-box">
            <strong>Client :</strong><br>
            {{ $facture->client->nom ?? 'Client' }}
        </div>

        <!-- TABLE -->
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Montant</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Vente #{{ $facture->vente_id ?? '-' }}</td>
                    <td>{{ number_format($facture->total,0,',',' ') }} FCFA</td>
                </tr>
            </tbody>
        </table>

        <!-- TOTAL -->
        <div class="total-box">

            <div class="total-card">

                <div class="total-line">
                    <span>Sous-total</span>
                    <span>{{ number_format($facture->total,0,',',' ') }} FCFA</span>
                </div>

                <div class="total-line total-title">
                    <span>TOTAL À PAYER</span>
                    <span>{{ number_format($facture->total,0,',',' ') }} FCFA</span>
                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>