<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<title>Facture {{ $facture->numero }}</title>

<style>
body{
    margin:0;
    padding:0;
    font-family:'Segoe UI',sans-serif;
    background:#0f172a;
    color:white;
}

/* CONTAINER */
.page{
    max-width:900px;
    margin:40px auto;
    padding:20px;
}

/* FACTURE CARD */
.facture{
    background:rgba(17,24,39,.92);
    border:1px solid rgba(255,255,255,.06);
    border-radius:22px;
    padding:30px;
    box-shadow:0 20px 50px rgba(0,0,0,.4);
}

/* HEADER */
.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    margin-bottom:30px;
}

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
    background:rgba(0,230,255,.1);
    padding:5px;
    box-shadow:0 10px 25px rgba(0,230,255,.2);
}

.title-box h1{
    margin:0;
    font-size:22px;
    background:linear-gradient(90deg,#00e6ff,#4facfe);
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}

.title-box small{
    color:#94a3b8;
}

/* COMPANY */
.company{
    text-align:right;
    font-size:13px;
    color:#cbd5e1;
    line-height:1.5;
}

/* BADGE */
.badge{
    display:inline-block;
    margin-top:10px;
    padding:6px 12px;
    background:#16a34a;
    border-radius:20px;
    font-size:12px;
}

/* INFO */
.info{
    margin-top:20px;
    padding:15px;
    background:#1e293b;
    border-radius:14px;
}

.info strong{
    color:#00e6ff;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    margin-top:25px;
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
    color:#e2e8f0;
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

.total-card h3{
    margin:0;
    color:#00e6ff;
}

.total-line{
    display:flex;
    justify-content:space-between;
    margin-top:10px;
    font-size:14px;
}

/* PRINT BUTTON */
.actions{
    margin-bottom:20px;
}

.print-btn{
    padding:12px 18px;
    border:none;
    border-radius:12px;
    background:#00e6ff;
    color:#0f172a;
    font-weight:bold;
    cursor:pointer;
    transition:.2s;
}

.print-btn:hover{
    transform:scale(1.03);
}

/* FOOTER */
.footer{
    margin-top:25px;
    text-align:center;
    font-size:12px;
    color:#64748b;
}

/* RESPONSIVE */
@media(max-width:768px){

    .header{
        flex-direction:column;
        align-items:flex-start;
        gap:15px;
    }

    .company{
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

    .page{
        margin:0;
        padding:0;
    }

    .facture{
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

<div class="page">

    <div class="actions">
        <button class="print-btn" onclick="window.print()">
            🖨 Imprimer / PDF
        </button>
    </div>

    <div class="facture">

        <!-- HEADER -->
        <div class="header">

            <div class="logo-container">
                <img src="{{ asset('images/logo.png') }}" class="logo-img">

                <div class="title-box">
                    <h1>CURSAGE</h1>
                    <small>Plateforme intelligente de gestion</small>
                </div>
            </div>

            <div class="company">
                <strong>Cursage Solutions</strong><br>
                Gestion & Services numériques<br>
                Pointe-Noire - Congo
                <div class="badge">FACTURE OFFICIELLE</div>
            </div>

        </div>

        <!-- FACTURE INFO -->
        <h2 style="margin:0;">Facture N° {{ $facture->numero }}</h2>
        <p style="color:#94a3b8;">
            Date : {{ $facture->date->format('d/m/Y') }}
        </p>

        <div class="info">
            <strong>Client :</strong>
            {{ $facture->client->nom ?? 'Client inconnu' }}
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

                <h3>Total Facture</h3>

                <div class="total-line">
                    <span>Sous-total</span>
                    <span>{{ number_format($facture->total,0,',',' ') }} FCFA</span>
                </div>

                <div class="total-line" style="font-weight:bold;font-size:16px;">
                    <span>Total à payer</span>
                    <span style="color:#00e6ff;">
                        {{ number_format($facture->total,0,',',' ') }} FCFA
                    </span>
                </div>

            </div>

        </div>

        <!-- FOOTER -->
        <div class="footer">
            Merci pour votre confiance — CURSAGE ERP © {{ date('Y') }}
        </div>

    </div>

</div>

</body>
</html>