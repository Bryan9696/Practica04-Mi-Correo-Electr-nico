<?php
session_start();
if (!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE) {
    header("Location: /PRACTICA04/public/vista/login.html");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Sistema de Gestion de Usuarios</title>
    <link href="../../../public/vista/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body background="fondo.jpg">
    <header class="cab">
        <h1>Cambiar Contraseña Usuario</h1>
    </header>
    <form id="formulario01" method="POST" action="../../controladores/cambiarContrasena.php">
        <input type="hidden" id="codigo" name="codigo" value=" <?php echo $_GET["codigo"]; ?>" />
        <label for="contrasenaActual">Contraseña Actual (*)</label>
        <input type="password" id="contrasenaActual" name="contrasenaActual" value="" />
        <br>
        <label for="contrasenaNueva">Contraseña Nueva (*)</label>
        <input type="password" id="contrasenaNueva" name="contrasenaNueva" value="" />
        <br>
        <br>
        <input type="submit" id="cambiarContrasena" name="cambiarContrasena" value="Cambiar Contraseña" />
        <input type="reset" id="cancelar " name="cancelar" value="Cancelar" />
        <a href="cuenta.php"> Regresar </a>
    </form>
</body>

</html>