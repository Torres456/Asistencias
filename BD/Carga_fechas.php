<?php
session_start();
$varSesion = $_SESSION["Id_Responsable"];
if ($varSesion == '' || $varSesion == null) {
    header("location:login.php");
} else {
    include 'conexion.php';
    $salida = "";


    if (isset($_POST['User'])) {
        $user = $_POST['User'];
        $query = "SELECT a.ID_asistencia, a.H_entrada, a.H_salida, a.Fecha, a.No_horas, s.Responsable FROM asistencia AS a INNER JOIN ssrp AS s ON a.Usuario = s.Usuario WHERE s.Responsable='$varSesion' AND a.Usuario='$user'";
    }

    if (isset($_POST['User']) && isset($_POST['Tipo'])) {
        $user = $_POST['User'];
        $tipo = $_POST['Tipo'];

        if ($tipo == 0) {
            $query = "SELECT a.ID_asistencia, a.H_entrada, a.H_salida, a.Fecha, a.No_horas, s.Responsable FROM asistencia AS a INNER JOIN ssrp AS s ON a.Usuario = s.Usuario WHERE s.Responsable='$varSesion' AND a.Usuario='$user'";
        } else if ($tipo == 1) {
            $query = "SELECT a.ID_asistencia, a.H_entrada, a.H_salida, a.Fecha, a.No_horas, s.Responsable FROM asistencia AS a INNER JOIN ssrp AS s ON a.Usuario = s.Usuario WHERE NOT a.H_salida='Sin salida' AND s.Responsable='$varSesion' AND a.Usuario='$user'";
        } else if ($tipo == 2) {
            $query = "SELECT a.ID_asistencia, a.H_entrada, a.H_salida, a.Fecha, a.No_horas, s.Responsable FROM asistencia AS a INNER JOIN ssrp AS s ON a.Usuario = s.Usuario WHERE s.Responsable='$varSesion' AND a.Usuario='$user' AND a.H_salida='Sin salida'";
        }
    }

    if (isset($_POST['User']) && isset($_POST['Tipo']) && isset($_POST['FechaA'])) {

        $user = $_POST['User'];
        $tipo = $_POST['Tipo'];
        $fechaA = $_POST['FechaA'];

        if ($tipo == 0) {
            $query = "SELECT a.ID_asistencia, a.H_entrada, a.H_salida, a.Fecha, a.No_horas, s.Responsable FROM asistencia AS a INNER JOIN ssrp AS s ON a.Usuario = s.Usuario WHERE s.Responsable='$varSesion' AND a.Usuario='$user' AND a.fecha='$fechaA'";
        } else if ($tipo == 1) {
            $query = "SELECT a.ID_asistencia, a.H_entrada, a.H_salida, a.Fecha, a.No_horas, s.Responsable FROM asistencia AS a INNER JOIN ssrp AS s ON a.Usuario = s.Usuario WHERE NOT a.H_salida='Sin salida' AND s.Responsable='$varSesion' AND a.Usuario='$user' AND a.fecha='$fechaA'";
        } else if ($tipo == 2) {
            $query = "SELECT a.ID_asistencia, a.H_entrada, a.H_salida, a.Fecha, a.No_horas, s.Responsable FROM asistencia AS a INNER JOIN ssrp AS s ON a.Usuario = s.Usuario WHERE s.Responsable='$varSesion' AND a.Usuario='$user' AND a.H_salida='Sin salida' AND a.fecha='$fechaA'";
        }
    }


    if (isset($_POST['User']) && isset($_POST['Tipo']) && isset($_POST['FechaA']) && isset($_POST['FechaB'])) {

        $user = $_POST['User'];
        $tipo = $_POST['Tipo'];
        $fechaA = $_POST['FechaA'];
        $fechaB = $_POST['FechaB'];

        if ($tipo == 0) {
            $query = "SELECT a.ID_asistencia, a.H_entrada, a.H_salida, a.Fecha, a.No_horas, s.Responsable FROM asistencia AS a INNER JOIN ssrp AS s ON a.Usuario = s.Usuario WHERE s.Responsable='$varSesion' AND a.Usuario='$user' AND a.Fecha BETWEEN '$fechaA' AND '$fechaB'";
        } else if ($tipo == 1) {
            $query = "SELECT a.ID_asistencia, a.H_entrada, a.H_salida, a.Fecha, a.No_horas, s.Responsable FROM asistencia AS a INNER JOIN ssrp AS s ON a.Usuario = s.Usuario WHERE NOT a.H_salida='Sin salida' AND s.Responsable='$varSesion' AND a.Usuario='$user' AND a.Fecha BETWEEN '$fechaA' AND '$fechaB'";
        } else if ($tipo == 2) {
            $query = "SELECT a.ID_asistencia, a.H_entrada, a.H_salida, a.Fecha, a.No_horas, s.Responsable FROM asistencia AS a INNER JOIN ssrp AS s ON a.Usuario = s.Usuario WHERE s.Responsable='$varSesion' AND a.Usuario='$user' AND a.H_salida='Sin salida' AND a.Fecha BETWEEN '$fechaA' AND '$fechaB'";
        }
    }

    $result = $conexion->query($query);
    if ($result->num_rows > 0) {
        $salida .= "
             <table class='Table__Users' id='Table__Users'>
             <thead>
                 <tr>
                     <th>ID asistencia</th>
                     <th>Hora de entrada</th>
                     <th>Hora de salida</th>
                     <th>Fecha</th>
                     <th>Numero de horas</th>
                 </tr>
             </thead>
             <tbody>";

        while ($fila = $result->fetch_assoc()) {

            $salida .= "<tr>
             <td>" . $fila["ID_asistencia"] . "</td>
             <td>" . $fila["H_entrada"] . "</td>
             <td>" . $fila["H_salida"] . "</td>
             <td>" . $fila["Fecha"] . "</td>
             <td>" . $fila["No_horas"] . "</td>
             </tr>";
        }
        $salida .= "</tbody></table>";
    } else {
        $salida .= "<div class='Table__Alert'>
                 <h2>sin asistencias</h2>
                 <div class='Img__error'>
                <img src='../assets/images/Sin_datos.png' alt='' class='Img__Get'>
            </div>
             </div>";
    }
    echo $salida;
}
