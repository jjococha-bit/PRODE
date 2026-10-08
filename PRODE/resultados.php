<?php

session_start();
require '../conexion.php';

$sql = "SELECT * FROM partidos ORDER BY fecha_partido";
$partidos = $conexion->query($sql)->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html lang="es">
<head>
<meta charset="UTF-8">
<title>Cargar Resultados</title>

<style>

body{
    font-family:Arial;
    background:#f5f7fa;
}

.card{
    width:1000px;
    margin:30px auto;
    background:white;
    padding:25px;
    border-radius:12px;
    box-shadow:0 0 15px rgba(0,0,0,.08);
}

.fila{
    display:grid;
    grid-template-columns:1fr 80px 80px 1fr;
    gap:10px;
    margin-bottom:12px;
    align-items:center;
}

input{
    padding:10px;
}

button{
    margin-top:20px;
    padding:12px 20px;
    background:#2563eb;
    color:white;
    border:none;
    border-radius:8px;
}

</style>

</head>

<body>

<div class="card">

<h2>Resultados Oficiales</h2>

<form action="guardar_resultados.php" method="POST">

<?php foreach($partidos as $partido): ?>

<div class="fila">

<div><?= htmlspecialchars($partido['equipo_local']) ?></div>

<input
type="hidden"
name="id[]"
value="<?= $partido['id'] ?>"

>

<input
type="number"
min="0"
name="goles_local[]"
value="<?= $partido['goles_local'] ?>"

>

<input
type="number"
min="0"
name="goles_visitante[]"
value="<?= $partido['goles_visitante'] ?>"

>

<div><?= htmlspecialchars($partido['equipo_visitante']) ?></div>

</div>

<?php endforeach; ?>

<button type="submit">
Guardar Resultados y Calcular Puntos
</button>

</form>

</div>

</body>
</html>
