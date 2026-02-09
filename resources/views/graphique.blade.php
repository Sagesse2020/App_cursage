<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Statistiques CURSAGE</title>

<style>
body {
    background:#0b1020; color:#e5e7eb;
    font-family:Segoe UI;
 }
.container {
    padding:40px;
}
canvas {
    background:#111827; border-radius:12px;
     }
</style>
</head>

<body>
<div class="container">
<h1>📈 Évolution mensuelle</h1>
<canvas id="graph" width="800" height="300"></canvas>
</div>

<script>
const data = @json($donnees); // [1000, 2000, 1500...]

const ctx = document.getElementById("graph").getContext("2d");
ctx.strokeStyle = "#00e6ff";
ctx.lineWidth = 3;

ctx.beginPath();
data.forEach((v,i)=>{
    let x = i * 100 + 50;
    let y = 250 - v/10;
    if(i===0) ctx.moveTo(x,y);
    else ctx.lineTo(x,y);
});
ctx.stroke();
</script>
</body>
</html>
