```php
<?php

session_start();

require '../conexion.php';

$sql = "SELECT * FROM partidos ORDER BY id";
$partidos = $conexion->query($sql)->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Administrar Partidos</title>

<style>

body{
    font-family:Arial, sans-serif;
    background:#f5f7fa;
    margin:0;
    padding:20px;
}

.card{
    max-width:1100px;
    margin:auto;
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 0 15px rgba(0,0,0,.1);
}

h1{
    margin-bottom:20px;
}

.fila{
    display:grid;
    grid-template-columns: 1fr 1fr 220px;
    gap:10px;
    margin-bottom:12px;
}

input{
    padding:12px;
    border:1px solid #ddd;
    border-radius:8px;
}

button{
    background:#2563eb;
    color:white;
    border:none;
    padding:12px 20px;
    border-radius:8px;
    cursor:pointer;
}

.nuevo{
    margin-top:30px;
    border-top:1px solid #eee;
    padding-top:20px;
}

</style>

</head>

<body>

<div class="card">

<h1>Administración de Partidos</h1>

<form method="POST" action="guardar_partidos.php">

<?php foreach($partidos as $partido): ?>

<div class="fila">

<input
type="hidden"
name="id[]"
value="<?= $partido['id'] ?>"
>

<input
type="text"
name="local[]"
value="<?= htmlspecialchars($partido['equipo_local']) ?>"
required
>

<input
type="text"
name="visitante[]"
value="<?= htmlspecialchars($partido['equipo_visitante']) ?>"
required
>

<input
type="datetime-local"
name="fecha[]"
value="<?= date('Y-m-d\TH:i', strtotime($partido['fecha_partido'])) ?>"
required
>

</div>

<?php endforeach; ?>

<div class="nuevo">

<h3>Agregar nuevos partidos</h3>

<?php for($i=1;$i<=10;$i++): ?>

<div class="fila">

<input
type="text"
name="nuevo_local[]"
placeholder="Equipo local"
>

<input
type="text"
name="nuevo_visitante[]"
placeholder="Equipo visitante"
>

<input
type="datetime-local"
name="nueva_fecha[]"
>

</div>

<?php endfor; ?>

</div>

<button type="submit">
Guardar Cambios
</button>

</form>

</div>

</body>

</html>
```
