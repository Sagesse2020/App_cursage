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
    <canvas id="graph" width="900" height="400"></canvas>
</div>

<script>
// 📦 données Laravel
const data = @json(array_values($donnees));

// 🧠 Canvas
const canvas = document.getElementById("graph");
const ctx = canvas.getContext("2d");

const width = canvas.width;
const height = canvas.height;

// 🔥 sécurité anti crash
const max = Math.max(...data, 1);

// 📏 espacement dynamique
const stepX = width / (data.length - 1);

// 🎨 style ligne
ctx.strokeStyle = "#00e6ff";
ctx.lineWidth = 3;

ctx.beginPath();

// 📊 tracé de la courbe
data.forEach((v, i) => {

    const x = i * stepX;
    const y = height - (v / max) * (height - 60);

    if (i === 0) {
        ctx.moveTo(x, y);
    } else {
        ctx.lineTo(x, y);
    }
});

ctx.stroke();


// 🔵 points visibles (effet pro)
data.forEach((v, i) => {

    const x = i * stepX;
    const y = height - (v / max) * (height - 60);

    ctx.fillStyle = "#00e6ff";
    ctx.beginPath();
    ctx.arc(x, y, 4, 0, Math.PI * 2);
    ctx.fill();
});
dd($donnees)
console.log(@json($donnees));
</script>

</body>
</html>