@extends('layouts.app')

@section('content')

<style>
body{
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
    flex-wrap:wrap;
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

/* FORM */
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

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    margin-top:15px;
}

th{
    background:#020617;
    padding:12px;
    text-align:left;
    font-size:14px;
}

td{
    padding:12px;
    border-bottom:1px solid rgba(255,255,255,.08);
}

tr:hover{
    background:#172036;
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

.btn-danger{
    background:#ef4444;
    color:white;
}

/* TOTAL BOX */
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

/* PREVIEW */
.preview{
    font-size:14px;
    line-height:1.6;
    color:#cbd5e1;
}

.badge{
    display:inline-block;
    padding:6px 12px;
    background:#16a34a;
    border-radius:20px;
    font-size:12px;
    margin-top:10px;
}

/* RESPONSIVE */
@media(max-width:900px){
    .grid{
        grid-template-columns:1fr;
    }
}
</style>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <div>
            <div class="title">Modifier Facture</div>
            <small style="color:#94a3b8;">Mise à jour de la facture N° {{ $facture->numero }}</small>
        </div>

        <div class="badge">FACTURE</div>
    </div>

    <form method="POST" action="{{ route('factures.update',$facture->id) }}">
        @csrf
        @method('PUT')

        <div class="grid">

            <!-- LEFT FORM -->
            <div class="card">

                <label>Client</label>
                <select name="client_id" id="client">
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}"
                            {{ $facture->client_id == $client->id ? 'selected' : '' }}>
                            {{ $client->nom }}
                        </option>
                    @endforeach
                </select>

                <label>Vente liée</label>
                <select name="vente_id" id="vente">
                    @foreach($ventes as $vente)
                        <option value="{{ $vente->id }}"
                            data-montant="{{ $vente->total }}"
                            {{ $facture->vente_id == $vente->id ? 'selected' : '' }}>
                            Vente #{{ $vente->id }} - {{ number_format($vente->total,0,',',' ') }} FCFA
                        </option>
                    @endforeach
                </select>

                <label>Date facture</label>
                <input type="date" name="date" value="{{ $facture->date->format('Y-m-d') }}">

                <label>Montant total</label>
                <input type="text" name="total" id="total" value="{{ $facture->total }}" readonly>

                <div class="actions">
                    <button type="submit" class="btn btn-save">💾 Enregistrer</button>
                    <a href="{{ route('factures.index') }}" class="btn btn-back">⬅ Retour</a>
                </div>

            </div>

            <!-- RIGHT PREVIEW -->
            <div class="card preview">

                <h3 style="color:#00e6ff;">Aperçu Facture</h3>
                <hr style="border:1px solid rgba(255,255,255,.1);">

                <p><strong>N° :</strong> {{ $facture->numero }}</p>
                <p><strong>Client :</strong> <span id="preview-client">{{ $facture->client->nom }}</span></p>
                <p><strong>Vente :</strong> <span id="preview-vente">#{{ $facture->vente_id }}</span></p>
                <p><strong>Date :</strong> <span id="preview-date">{{ $facture->date->format('d/m/Y') }}</span></p>

                <div class="total-box">
                    <h2 id="preview-total">{{ number_format($facture->total,0,',',' ') }} FCFA</h2>
                </div>

                <div class="badge">✔ En cours de modification</div>

            </div>

        </div>
    </form>
</div>

<!-- JS AUTO UPDATE -->
<script>
const venteSelect = document.getElementById('vente');
const totalInput = document.getElementById('total');

const previewClient = document.getElementById('preview-client');
const previewVente = document.getElementById('preview-vente');
const previewTotal = document.getElementById('preview-total');

const clientSelect = document.getElementById('client');

function updateTotal(){
    let option = venteSelect.options[venteSelect.selectedIndex];
    let montant = option.getAttribute('data-montant');

    totalInput.value = montant;
    previewTotal.innerText = new Intl.NumberFormat().format(montant) + " FCFA";
    previewVente.innerText = option.text;
}

venteSelect.addEventListener('change', updateTotal);

clientSelect.addEventListener('change', function(){
    previewClient.innerText = clientSelect.options[clientSelect.selectedIndex].text;
});

// init
updateTotal();
</script>

@endsection