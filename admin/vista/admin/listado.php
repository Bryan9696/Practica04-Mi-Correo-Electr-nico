<?php
session_start();
$codigoui = $_SESSION['cod'];
$nombresui = explode(" ", $_SESSION['nom']);
$apellidosui =  explode(" ", $_SESSION['ape']);
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
</head>

<body background="fondo.jpg">
    <header class="cabis">
        <h2>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Listado 
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
        <nav class="naveg">
            <ul>
                <li> <a href="index.php">Inicio </a> </li>
                <li> <a href="listado.php">Usuarios</a> </li>
            </ul>
        </nav>
    </header>
    <table id="tbl">
        <caption>
            <h4>Lista de Usuarios </h4>
        </caption>
        <tr>
            <th>Cedula</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Fecha Nacimiento</th>
            <th>Eliminar</th>
            <th>Modificar</th>
            <th>Cambiar Contraseña</th>
        </tr>
        <?php
        include '../../../config/conexionBD.php';
        $sql = "SELECT * FROM usuario WHERE usu_eliminado='N';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $codigo = $row["usu_codigo"];
                $cedula = $row["usu_cedula"];
                $nombres = $row["usu_nombres"];
                $apellidos = $row["usu_apellidos"];
                $direccion = $row["usu_direccion"];
                $telefono = $row["usu_telefono"];
                $correo = $row["usu_correo"];
                $fecha = $row["usu_fecha_nacimiento"];
                $contrasena = $row["usu_password"];
                echo "<tr>";
                echo "   <td>" . $cedula . "</td>";
                echo "   <td>" . $nombres . "</td>";
                echo "   <td>" . $apellidos . "</td>";
                echo "   <td>" . $direccion . "</td>";
                echo "   <td>" . $telefono . "</td>";
                echo "   <td>" . $correo . "</td>";
                echo "   <td>" . $fecha . "</td>";
                echo "   <td> <a href='eliminar.php?codigo=$codigo&cedula=$cedula&nombres=" . urlencode($nombres) . "&apellidos=" . urlencode($apellidos) . "&direccion=" . urlencode($direccion) . "&telefono=$telefono&correo=$correo&fecha=$fecha'> Ir </a> </td>";
                echo "   <td> <a href='actualizar.php?codigo=$codigo&cedula=$cedula&nombres=" . urlencode($nombres) . "&apellidos=" . urlencode($apellidos) . "&direccion=" . urlencode($direccion) . "&telefono=$telefono&correo=$correo&fecha=$fecha'>Ir </a> </td>";
                echo "   <td> <a href='cambiarContrasena.php?codigo=$codigo'>Ir </a> </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo "   <td colspan='7'> No existen usuarios registrados en el sistema </td>";
            echo "</tr>";
        }
        $conn->close();
        ?>
    </table>

    <footer>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br>
        <a href="mailto:bpintadoy@est.ups.edu.ec?subject=Questions">Correo de Contacto </a>
        <a>&nbsp;</a>
        <a href="tel:072801706">Telefono </a>
        </div> 
    <div  id="copyright">Copyrigth Bryan Pintado- <br /> 
            Universidad Politécnica Salesiana &#169; Todos los derechos reservados </div>
    </footer>
</body>

</html>