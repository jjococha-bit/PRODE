```php
<?php

session_start();

require '../conexion.php';

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    exit;
}

/*
|--------------------------------------------------------------------------
| ACTUALIZAR PARTIDOS EXISTENTES
|--------------------------------------------------------------------------
*/

if(isset($_POST['id'])){

    foreach($_POST['id'] as $i => $id){

        $local = trim($_POST['local'][$i]);
        $visitante = trim($_POST['visitante'][$i]);
        $fecha = $_POST['fecha'][$i];

        $sql = "
        UPDATE partidos
        SET
            equipo_local = ?,
            equipo_visitante = ?,
            fecha_partido = ?
        WHERE id = ?
        ";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            $local,
            $visitante,
            $fecha,
            $id
        ]);
    }
}

/*
|--------------------------------------------------------------------------
| AGREGAR NUEVOS PARTIDOS
|--------------------------------------------------------------------------
*/

if(isset($_POST['nuevo_local'])){

    foreach($_POST['nuevo_local'] as $i => $local){

        $local = trim($local);
        $visitante = trim($_POST['nuevo_visitante'][$i]);
        $fecha = $_POST['nueva_fecha'][$i];

        if(
            $local != '' &&
            $visitante != '' &&
            $fecha != ''
        ){

            $sql = "
            INSERT INTO partidos
            (
                equipo_local,
                equipo_visitante,
                fecha_partido
            )
            VALUES
            (
                ?, ?, ?
            )
            ";

            $stmt = $conexion->prepare($sql);

            $stmt->execute([
                $local,
                $visitante,
                $fecha
            ]);
        }
    }
}

header("Location: partidos.php");
exit;

