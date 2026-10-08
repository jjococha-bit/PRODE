```php
<?php

session_start();

if(!isset($_SESSION['usuario_id'])){
    header("Location: ../login.php");
    exit;
}

require '../conexion.php';

$usuario_id = $_SESSION['usuario_id'];

foreach($_POST['local'] as $partido_id => $goles_local){

    $goles_visitante =
        $_POST['visitante'][$partido_id];

    /*
    Verifica si ya existe pronóstico
    */

    $sql = "
    SELECT id
    FROM pronosticos
    WHERE usuario_id = ?
    AND partido_id = ?
    ";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        $usuario_id,
        $partido_id
    ]);

    if($stmt->rowCount() > 0){

        $sql = "
        UPDATE pronosticos
        SET
            goles_local = ?,
            goles_visitante = ?
        WHERE usuario_id = ?
        AND partido_id = ?
        ";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            $goles_local,
            $goles_visitante,
            $usuario_id,
            $partido_id
        ]);

    }else{

        $sql = "
        INSERT INTO pronosticos
        (
            usuario_id,
            partido_id,
            goles_local,
            goles_visitante
        )
        VALUES
        (
            ?, ?, ?, ?
        )
        ";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            $usuario_id,
            $partido_id,
            $goles_local,
            $goles_visitante
        ]);

    }

}

echo "
<h2>Pronósticos guardados correctamente</h2>
<br>
<a href='pronosticar.php'>
Volver
</a>
";
```
