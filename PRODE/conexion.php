<?php

$host = "localhost";
$bd   = "pronosticos";
$user = "root";
$pass = "";

try{

    $conexion = new PDO(
        "mysql:host=$host;dbname=$bd;charset=utf8",
        $user,
        $pass
    );

}catch(PDOException $e){

    die($e->getMessage());

}