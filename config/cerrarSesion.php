<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cerrar Sesión</title>
</head>

<body>
    <?php
    session_start();
    $_SESSION['isLogged'] = FALSE;
    session_destroy();
    header("Location: /PRACTICA04/public/vista/login.html");  ?>
    ?>
</body>

</html>