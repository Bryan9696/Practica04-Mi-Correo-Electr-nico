<?php
session_start();
$nombresui = explode(" ", $_SESSION['nom']);
$apellidosui =  explode(" ", $_SESSION['ape']);
$usurol = $_SESSION['rol'];
if (!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE) {
    header("Location: /SistemaDeGestion/public/vista/login.html");
}
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Gestión de usuarios</title>
    <link href="../../../public/vista/css/stables.css" rel="stylesheet" type="text/css" />
    <link href="../../../public/vista/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body background="fondo.jpg">
    <header class="cabis">
        <h2> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        ADMINISTRADOR</h2>

        <nav class="navi">
            <ul id="menu">
                <li><a href="#"> <img id="imagen" src="../../../public/vista/images/usu.png"> <?php echo $nombresui[0] . ' ' . $apellidosui[0] ?></a>
                    <ul>
                        <li><a href="../../../config/cerrarSesion.php"> Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <nav class="naveg">
            <ul>
                <li> <a href="index.php">Inicio </a> </li>
                <li> <a href="listado.php">Usuarios</a> </li>
            </ul>
        </nav>
    </header>
    <table id="tbl">
        <caption>
            <h4>Mensajes Electrónicos </h4>
        </caption>
        <tr>
            <th>Fecha</th>
            <th>Remitente</th>
            <th>Destinatario</th>
            <th>Asunto</th>
            <th>Eliminar</th>
        </tr>
        <?php
        include '../../../config/conexionBD.php';
        $sql = "SELECT * FROM correos WHERE cor_eliminado='N' ORDER BY cor_fecha_hora DESC;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $codigo = $row["cor_codigo"];
                $fecha = $row["cor_fecha_hora"];
                $asunto = $row["cor_asunto"];
                $array = array(0 => $row["cor_usu_remitente"], 1 => $row["cor_usu_destinatario"]);
                $array2 = [];
                foreach ($array as $i => $value) {
                    $bus = "SELECT * FROM usuario WHERE usu_codigo=$array[$i];";
                    $resultb = $conn->query($bus);
                    if ($resultb->num_rows > 0) {
                        while ($row = $resultb->fetch_assoc()) {
                            $array2[] = $row["usu_correo"];
                        }
                    }
                }
                echo "<tr>";
                echo "   <td>" . $fecha . "</td>";
                echo "   <td>" . $array2[0] . "</td>";
                echo "   <td>" . $array2[1] . "</td>";
                echo "   <td>" . $asunto . "</td>";
                echo "   <td> <a href='eliminarmen.php?codigo=$codigo'> Ir </a> </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo "   <td colspan='7'> No existen correos registrados al usuario </td>";
            echo "</tr>";
        }
        $conn->close();
        ?>
    </table>

    <footer>
    <div>   
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br>
        <a href="mailto:bpintadoy@est.ups.edu.ec?subject=Questions">Correo de Contacto </a>
        <a>&nbsp;</a>
        <a href="tel:072801706">Telefono </a>
        </div> 
    <div  id="copyright">Copyrigth Bryan Pintado- <br /> 
            Universidad Politécnica Salesiana &#169; Todos los derechos reservados </div>
            </footer>
</body>

</html>