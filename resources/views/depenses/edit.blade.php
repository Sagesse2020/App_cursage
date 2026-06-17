<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Facture</title>

    <style>
        body{
            margin:0;
            padding:0;
            background:#0f172a;
            color:white;
            font-family:'Segoe UI',sans-serif;
        }

        .container{
            max-width:1300px;
            margin:40px auto;
            padding:20px;
        }

        /* HEADER */
        .header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:25px;
        }

        .title{
            font-size:32px;
            font-weight:700;
            background:linear-gradient(90deg,#00e6ff,#4facfe);
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
        }

        /* GRID */
        .grid{
            display:grid;
            grid-template-columns:2fr 1fr;
            gap:20px;
        }

        /* CARD */
        .card{
            background:rgba(17,24,39,.9);
            border:1px solid rgba(255,255,255,.05);
            border-radius:20px;
            padding:25px;
            box-shadow:0 15px 35px rgba(0,0,0,.35);
        }

        label{
            display:block;
            margin-bottom:8px;
            color:#94a3b8;
            font-size:14px;
        }

        input, select{
            width:100%;
            padding:12px;
            border-radius:12px;
            border:none;
            margin-bottom:18px;
            background:#1e293b;
            color:white;
            outline:none;
        }

        input:focus, select:focus{
            border:1px solid #00e6ff;
        }

        /* BUTTONS */
        .actions{
            display:flex;
            gap:10px;
            margin-top:20px;
            flex-wrap:wrap;
        }

        .btn{
            padding:12px 18px;
            border-radius:12px;
            border:none;
            cursor:pointer;
            font-weight:bold;
            text-decoration:none;
            display:inline-block;
        }

        .btn-save{
            background:#00e6ff;
            color:#0f172a;
        }

        .btn-back{
            background:#334155;
            color:white;
        }

        /* PREVIEW */
        .preview{
            font-size:14px;
            line-height:1.6;
            color:#cbd5e1;
        }

        .total-box{
            margin-top:20px;
            padding:20px;
            background:#020617;
            border-radius:15px;
            text-align:right;
        }

        .total-box h2{
            color:#00e6ff;
        }

        .badge{
            display:inline-block;
            padding:6px 12px;
            background:#16a34a;
            border-radius:20px;
            font-size:12px;
            margin-top:10px;
        }

        @media(max-width:900px){
            .grid{
                grid-template-columns:1fr;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <div class="title">Modifier Facture</div>
        <div class="badge">CURSAGE ERP</div>
    </div>

    <form method="POST" action="{{ route('factures.update',$facture->id) }}">
        @csrf
        @method('PUT')

        <div class="grid">

            <!-- FORM -->
            <div class="card">

                <label>Client</label>
                <select id="client" name="client_id">
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}"
                            {{ $facture->client_id == $client->id ? 'selected' : '' }}>
                            {{ $client->nom }}
                        </option>
                    @endforeach
                </select>

                <label>Vente liée</label>
                <select id="vente" name="vente_id">
                    @foreach($ventes as $vente)
                        <option value="{{ $vente->id }}"
                            data-montant="{{ $vente->total }}"
                            {{ $facture->vente_id == $vente->id ? 'selected' : '' }}>
                            Vente #{{ $vente->id }} - {{ number_format($vente->total,0,',',' ') }} FCFA
                        </option>
                    @endforeach
                </select>

                <label>Date</label>
                <input type="date" name="date" value="{{ $facture->date->format('Y-m-d') }}">

                <label>Total</label>
                <input type="text" id="total" name="total" readonly>

                <div class="actions">
                    <button class="btn btn-save" type="submit">💾 Enregistrer</button>
                    <a href="{{ route('factures.index') }}" class="btn btn-back">⬅ Retour</a>
                </div>

            </div>

            <!-- PREVIEW -->
            <div class="card preview">

                <h3 style="color:#00e6ff;">Aperçu Facture</h3>

                <p><strong>N° :</strong> {{ $facture->numero }}</p>

                <p><strong>Client :</strong>
                    <span id="p-client">{{ $facture->client->nom }}</span>
                </p>

                <p><strong>Vente :</strong>
                    <span id="p-vente">#{{ $facture->vente_id }}</span>
                </p>

                <p><strong>Date :</strong>
                    <span>{{ $facture->date->format('d/m/Y') }}</span>
                </p>

                <div class="total-box">
                    <h2 id="p-total">{{ number_format($facture->total,0,',',' ') }} FCFA</h2>
                </div>

                <div class="badge">✔ Modification active</div>

            </div>

        </div>
    </form>

</div>

<script>
const vente = document.getElementById('vente');
const total = document.getElementById('total');

const pTotal = document.getElementById('p-total');
const pVente = document.getElementById('p-vente');

function update(){
    let opt = vente.options[vente.selectedIndex];
    let montant = opt.getAttribute('data-montant');

    total.value = montant;
    pTotal.innerText = new Intl.NumberFormat().format(montant) + " FCFA";
    pVente.innerText = opt.text;
}

vente.addEventListener('change', update);

// init
update();
</script>

</body>
</html>