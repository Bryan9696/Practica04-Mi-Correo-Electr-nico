<?php
session_start();
$codigoui = $_SESSION['cod'];
$nombresui = explode(" ", $_SESSION['nom']);
$apellidosui =  explode(" ", $_SESSION['ape']);
$correoui = $_SESSION['cor'];
$usurol = $_SESSION['rol'];
if (!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE) {
    header("Location: /SistemaDeGestion/public/vista/login.html");
}
?>

<?php
include '../../../config/conexionBD.php';
 $sql = "SELECT usu_foto from usuario WHERE usu_codigo='$codigoui';";
 $result = $conn->query($sql);
 if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
       
        $datos = $row["usu_foto"];
        $datos2 = base64_decode($datos);
    }
    }

   
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Sistema de Gestion de Usuarios</title>
    <link href="../../../public/vista/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body background="fondo.jpg">
    <header class="cabis">
        <h2>
            Nuevo Mensaje
        </h2>
        <nav class="navi">
            <ul id="menu">
            <li><a href="#"> <img id="imagen" src="../../../<?php echo $datos2?>"> <?php echo $nombresui[0] . ' ' . $apellidosui[0] ?></a>
                       
                    <ul>
                        <li><a href="../../../config/cerrarSesion.php"> Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <nav class='naveg'>
            <ul>
            <li> <a href="index.php">Inicio </a> </li>
                <li> <a href="mensajenu.php"> Mensaje Nuevo</a> </li>
                <li> <a href="mensajesen.php">Elementos Enviados</a> </li>
                <li> <a href="cuenta.php">Mi Cuenta</a> </li>
            </ul>
        </nav>
    </header>
    <form id="formulario01" method="POST" action="../../controladores/user/crearCorreo.php">
        <label for="destinatario">Correo Destinatario
            (*)</label>
        <input type="text" id="destinatario" name="destinatario" value="" placeholder="Ingrese el correo del destinatario
                    ..." required />
        <br>
        <label for="asunto"> Asunto (*)</label>
        <input type="text" id="asunto" name="asunto" value="" placeholder="Ingrese el asunto
                        ..." required />
        <br>
        <label for="mensaje">Mensaje (*)</label>
        <textarea id="mensaje" name="mensaje" placeholder="Ingrese el mensaje..." required></textarea>
        <br>
        <input type="submit" id="crear" name="crear" value="Enviar" />
        <input type="reset" id="cancelar" name="cancelar" value="Cancelar" />
</body>

</html>