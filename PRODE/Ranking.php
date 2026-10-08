```php
<?php

session_start();

if(!isset($_SESSION['usuario_id'])){
    header("Location: login.php");
    exit;
}

require 'conexion.php';

$sql = "
SELECT
    u.id,
    u.nombre,
    COALESCE(SUM(p.puntos_obtenidos),0) AS puntos
FROM usuarios u
LEFT JOIN pronosticos p
    ON u.id = p.usuario_id
GROUP BY u.id, u.nombre
ORDER BY puntos DESC, u.nombre ASC
";

$stmt = $conexion->prepare($sql);
$stmt->execute();

$ranking = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Ranking General</title>

<style>

body{
    margin:0;
    font-family:Arial, sans-serif;
    background:#f5f7fa;
}

.container{
    max-width:1000px;
    margin:40px auto;
    padding:20px;
}

.card{
    background:white;
    border-radius:15px;
    padding:25px;
    box-shadow:0 4px 15px rgba(0,0,0,.08);
}

h1{
    text-align:center;
    margin-bottom:25px;
    color:#1f2937;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#2563eb;
    color:white;
    padding:15px;
}

td{
    padding:15px;
    text-align:center;
    border-bottom:1px solid #eee;
}

tr:hover{
    background:#f9fafb;
}

.posicion{
    font-weight:bold;
}

.oro{
    background:#fff8dc;
}

.plata{
    background:#f3f4f6;
}

.bronce{
    background:#fdf2e9;
}

.volver{
    text-align:center;
    margin-top:25px;
}

.boton{
    display:inline-block;
    text-decoration:none;
    background:#2563eb;
    color:white;
    padding:12px 25px;
    border-radius:10px;
}

</style>

</head>

<body>

<div class="container">

<div class="card">

<h1>🏆 Ranking General</h1>

<table>

<tr>
    <th>Posición</th>
    <th>Usuario</th>
    <th>Puntos</th>
</tr>

<?php

$posicion = 1;

foreach($ranking as $usuario):

$clase = '';

if($posicion == 1){
    $clase = 'oro';
}
elseif($posicion == 2){
    $clase = 'plata';
}
elseif($posicion == 3){
    $clase = 'bronce';
}

?>

<tr class="<?= $clase ?>">

<td class="posicion">
<?= $posicion ?>
</td>

<td>
<?= htmlspecialchars($usuario['nombre']) ?>
</td>

<td>
<?= $usuario['puntos'] ?>
</td>

</tr>

<?php

$posicion++;

endforeach;

?>

</table>

<div class="volver">

<a class="boton" href="index.php">
Volver al Inicio
</a>

</div>

</div>

</div>

</body>
</html>
```
