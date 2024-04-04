<?php
session_start();
$varSesion = $_SESSION["Id_Responsable"];
if ($varSesion == '' || $varSesion == null) {
    header("location:login.php");
} else {

    include("conexion.php");
    $salida = "";


    

    
        // $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, s.Tipo, a.H_entrada, a.Recurso FROM usuarios As u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario INNER JOIN asistencia AS a ON u.ID_usuario = a.Usuario WHERE a.Fecha=CURDATE() AND a.No_horas='0' AND s.Responsable='$varSesion'";
        // $valor = 1;
   

    if (isset($_POST['Accion'])) {

     
            $accion = $_POST['Accion'];
            if ($accion == 0) {
                $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, s.Tipo, a.H_entrada, a.Recurso FROM usuarios As u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario INNER JOIN asistencia AS a ON u.ID_usuario = a.Usuario WHERE a.Fecha=CURDATE() AND a.No_horas='0' AND s.Responsable='$varSesion'";
               
            } else if ($accion == 1) {
                $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, s.Tipo, a.H_entrada, a.Recurso FROM usuarios As u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario INNER JOIN asistencia AS a ON u.ID_usuario = a.Usuario WHERE a.Fecha=CURDATE() AND a.No_horas='0' AND s.Responsable='$varSesion' AND s.Tipo='Servicio social'";
               
            } else if ($accion == 2) {
                $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, s.Tipo, a.H_entrada, a.Recurso FROM usuarios As u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario INNER JOIN asistencia AS a ON u.ID_usuario = a.Usuario WHERE a.Fecha=CURDATE() AND a.No_horas='0' AND s.Responsable='$varSesion' AND s.Tipo='Residencias profecionales'";
               
            }

        // $q=$conexion->real_escape_string($_POST['consulta']);
        // $query="SELECT * FROM usuarios WHERE Nombre LIKE '%".$q."%' OR
        // ID_usuario LIKE '%".$q."%' OR Grupo LIKE '%".$q."%'";
    }

    if (isset($_POST['consulta'])  && isset($_POST['Opcion']) ) {



        $accion2 = $_POST['Opcion'];
        if ($accion2 == 0) {
            $q = $conexion->real_escape_string($_POST['consulta']);
            $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, s.Tipo, a.H_entrada, a.Recurso FROM usuarios As u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario INNER JOIN asistencia AS a ON u.ID_usuario = a.Usuario WHERE s.Responsable='$varSesion' AND a.Fecha=CURDATE() AND u.ID_usuario LIKE '%" . $q . "%'";
        } else if ($accion2 == 1) {

            $q = $conexion->real_escape_string($_POST['consulta']);
            $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, s.Tipo, a.H_entrada, a.Recurso FROM usuarios As u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario INNER JOIN asistencia AS a ON u.ID_usuario = a.Usuario WHERE s.Responsable='$varSesion' AND a.Fecha=CURDATE() AND s.Tipo='Servicio social' AND u.ID_usuario LIKE '%" . $q . "%'";


        } else if ($accion2 == 2) {
            $q = $conexion->real_escape_string($_POST['consulta']);
            $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, s.Tipo, a.H_entrada, a.Recurso FROM usuarios As u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario INNER JOIN asistencia AS a ON u.ID_usuario = a.Usuario WHERE s.Responsable='$varSesion' AND a.Fecha=CURDATE() AND s.Tipo='Residencias profecionales' AND u.ID_usuario LIKE '%" . $q . "%'";

        } else {
        }
    }




    $result = $conexion->query($query);

    if ($result->num_rows > 0) {
        $salida .= "
                <table class='Table__Users' id='Table__Users'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Tipo</th>
                        <th>Entrada</th>
                        <th>Recurso</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>";

        while ($fila = $result->fetch_assoc()) {

            $salida .= "<tr>
            <td>" . $fila["ID_usuario"] . "</td>
            <td>" . $fila["TipoA"] . "</td>
            <td>" . $fila["Nombre"] . "</td>
            <td>" . $fila["Apellido_p"] . "</td>
            <td>" . $fila["Tipo"] . "</td>
            <td>" . $fila["H_entrada"] . "</td>
            <td>" . $fila["Recurso"] . "</td>
            <td>
            <a target='_top' class='Table__Button' href='View_User.php?Usuario=".$fila['ID_usuario']."'>Modificar</a>
            </td>
            </tr>";
            // <a href='pdfview.php?archivo=".$fila["Nombre"]"'target='_blank'>.$fila["Nombre"]</a>

        }
        $salida .= "</tbody></table>";
    } else {
        $salida .= "<div class='Table__Alert'>
                    <h2>Sin datos</h2>
                    <div class='Img__error'>
                <img src='../assets/images/Sin_datos.png' alt='' class='Img__Get'>
            </div>
                </div>";
    }
    echo $salida;
}
