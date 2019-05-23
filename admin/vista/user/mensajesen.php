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
    <title>Gestión de usuarios</title>
    <link href="../../../public/vista/css/stables.css" rel="stylesheet" type="text/css" />
    <link href="../../../public/vista/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../../controladores/usuario/js/metodos.js"> </script>
</head>

<body background="fondo.jpg">
    <header class="cabis">
        <h2>
           MENSAJES ENVIADOS 
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
        <h4>Mensajes Enviados</h4>
    </header>
    <table id="tbl">
        <input type="text" id="correo" name="correo" value="" placeholder="Ingrese el correo del destinatario para buscar" required onkeyup="buscarPorCorreo()" />
        <img id="imagen2" src="../../../public/vista/imagenes/usu.png">
        <tr>
            <th>Fecha</th>
            <th>Destinatario</th>
            <th>Asunto</th>
            <th>Leer</th>
        </tr>
        <?php
        $url = $_SERVER['REQUEST_URI'];
        include '../../../config/conexionBD.php';
        $sql = "SELECT * FROM correos WHERE cor_eliminado='N' AND cor_usu_remitente=$codigoui ORDER BY cor_fecha_hora DESC;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $codigo = $row["cor_codigo"];
                $fecha = $row["cor_fecha_hora"];
                $asunto = $row["cor_asunto"];
                $correodes = "";
                $bus = "SELECT * FROM usuario WHERE usu_codigo='$row[cor_usu_destinatario]';";
                $resultb = $conn->query($bus);
                if ($resultb->num_rows > 0) {
                    while ($row = $resultb->fetch_assoc()) {
                        $correodes = $row["usu_correo"];
                    }
                }
                echo "<tr>";
                echo "   <td>" . $fecha . "</td>";
                echo "   <td>" . $correodes . "</td>";
                echo "   <td>" . $asunto . "</td>";
                echo "   <td> <a href='../../controladores/user/lecturamen.php?codigo=$codigo&url=$url'> Ir </a> </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo "   <td colspan=' 7'> No existen correos registrados al usuario </td>";
            echo "</tr>";
        }
        $conn->close();
        ?>
    </table>

    <footer>
   
    </footer>
</body>

</html>