```php
<?php

session_start();

require 'conexion.php';

$error = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios
            WHERE email = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([$email]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if(
        $usuario &&
        password_verify(
            $password,
            $usuario['password']
        )
    ){

        $_SESSION['usuario_id'] =
            $usuario['id'];

        $_SESSION['usuario_nombre'] =
            $usuario['nombre'];

        header("Location: index.php");
        exit;

    }else{

        $error = "Usuario o contraseña incorrectos";

    }

}
?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Login</title>

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

.error{
    color:red;
    margin-top:10px;
}

</style>

</head>
<body>

<div class="card">

<h2>Iniciar Sesión</h2>

<form method="POST">

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
Ingresar
</button>

</form>

<div class="error">
<?= $error ?>
</div>

<p>
¿No tienes cuenta?
<a href="registro.php">Registrarse</a>
</p>

</div>

</body>
</html>
```
