```php
<?php

require 'conexion.php';

$mensaje = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

    $sql = "INSERT INTO usuarios
            (nombre,email,password)
            VALUES (?,?,?)";

    $stmt = $conexion->prepare($sql);

    try{

        $stmt->execute([
            $nombre,
            $email,
            $password
        ]);

        $mensaje = "Usuario registrado correctamente";

    }catch(PDOException $e){

        $mensaje = "El email ya existe";

    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Registro</title>

<style>

body{
    font-family:Arial;
    background:#f5f7fa;
}

.card{
    width:400px;
    margin:80px auto;
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 0 15px rgba(0,0,0,.1);
}

input{
    width:100%;
    padding:12px;
    margin-bottom:15px;
}

button{
    width:100%;
    padding:12px;
    border:none;
    background:#2563eb;
    color:white;
    cursor:pointer;
}

.msg{
    margin-top:15px;
    text-align:center;
}

</style>

</head>
<body>

<div class="card">

<h2>Registro</h2>

<form method="POST">

<input
type="text"
name="nombre"
placeholder="Nombre"
required
>

<input
type="email"
name="email"
placeholder="Email"
required
>

<input
type="password"
name="password"
placeholder="Contraseña"
required
>

<button type="submit">
Registrarse
</button>

</form>

<div class="msg">
<?= $mensaje ?>
</div>

<p>
¿Ya tienes cuenta?
<a href="login.php">Ingresar</a>
</p>

</div>

</body>
</html>
```
