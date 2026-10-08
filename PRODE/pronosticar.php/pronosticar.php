```php
<?php

session_start();

if(!isset($_SESSION['usuario_id'])){
    header("Location: ../login.php");
    exit;
}

require '../conexion.php';

$sql = "
SELECT *
FROM partidos
ORDER BY fecha_partido ASC
LIMIT 10
";

$stmt = $conexion->prepare($sql);
$stmt->execute();

$partidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Pronósticos</title>

<style>

body{
    font-family:Arial, sans-serif;
    background:#f5f7fa;
    margin:0;
    padding:20px;
}

.container{
    max-width:1000px;
    margin:auto;
}

.card{
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 0 15px rgba(0,0,0,.08);
}

.match{
    display:grid;
    grid-template-columns:1fr 80px 80px 1fr;
    gap:10px;
    align-items:center;
    margin-bottom:15px;
    padding-bottom:15px;
    border-bottom:1px solid #eee;
}

.team-home{
    text-align:right;
    font-weight:bold;
}

.team-away{
    text-align:left;
    font-weight:bold;
}

input[type=number]{
    padding:10px;
    text-align:center;
    border:1px solid #ccc;
    border-radius:8px;
}

button{
    margin-top:20px;
    width:100%;
    padding:15px;
    background:#2563eb;
    color:white;
    border:none;
    border-radius:10px;
    font-size:16px;
    cursor:pointer;
}

button:hover{
    background:#1d4ed8;
}

.fecha{
    text-align:center;
    color:#777;
    margin-bottom:5px;
    font-size:13px;
}

</style>

</head>

<body>

<div class="container">

<div class="card">

<h2>Mis Pronósticos</h2>

<form action="guardar_pronosticos.php" method="POST">

<?php foreach($partidos as $partido): ?>

<div class="fecha">
<?= date('d/m/Y H:i', strtotime($partido['fecha_partido'])) ?>
</div>

<div class="match">

<div class="team-home">
<?= htmlspecialchars($partido['equipo_local']) ?>
</div>

<input
type="number"
min="0"
required
name="local[<?= $partido['id'] ?>]"
>

<input
type="number"
min="0"
required
name="visitante[<?= $partido['id'] ?>]"
>

<div class="team-away">
<?= htmlspecialchars($partido['equipo_visitante']) ?>
</div>

</div>

<?php endforeach; ?>

<button type="submit">
Guardar Pronósticos
</button>

</form>

</div>

</div>

</body>
</html>
```
