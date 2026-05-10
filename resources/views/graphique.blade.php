<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Graphique CURSAGE</title>

<style>
body {
    background:#0b1020;
    color:#e5e7eb;
    font-family:Segoe UI;
    margin:0;
}

.container {
    padding:40px;
}

h1 {
    margin-bottom:20px;
}

canvas {
    background:#111827;
    border-radius:12px;
    width:100%;
    max-width:900px;
    height:400px;
    display:block;
}
</style>
</head>

<body>

<div class="container">
    <h1>📈 Évolution mensuelle des transactions</h1>
    <canvas id="graph"></canvas>
</div>

<script>
const data = @json($donnees ?? []);
const labels = @json($labels ?? []);

// 🔥 sécurité
if (!Array.isArray(data) || data.length !== 12) {
    console.error("Données invalides :", data);
}

// 🖥️ canvas
const canvas = document.getElementById("graph");
const ctx = canvas.getContext("2d");

// 🎯 résolution propre (évite bug flou)
const dpr = window.devicePixelRatio || 1;
canvas.width = 900 * dpr;
canvas.height = 400 * dpr;
ctx.scale(dpr, dpr);

const width = 900;
const height = 400;

// 📊 max valeur
const max = Math.max(...data, 1);

// 📏 espacement
const stepX = width / (data.length - 1);

// 🎨 style ligne
ctx.strokeStyle = "#00e6ff";
ctx.lineWidth = 3;

ctx.beginPath();

data.forEach((v, i) => {

    const x = i * stepX;
    const y = height - (v / max) * (height - 60);

    if (i === 0) ctx.moveTo(x, y);
    else ctx.lineTo(x, y);
});

ctx.stroke();

// 🔵 points
data.forEach((v, i) => {

    const x = i * stepX;
    const y = height - (v / max) * (height - 60);

    ctx.fillStyle = "#00e6ff";
    ctx.beginPath();
    ctx.arc(x, y, 4, 0, Math.PI * 2);
    ctx.fill();
});

// 🧠 labels mois
ctx.fillStyle = "#94a3b8";
ctx.font = "12px Segoe UI";

labels.forEach((label, i) => {
    const x = i * stepX;
    ctx.fillText(label, x, height - 10);
});
</script>

</body>
</html>