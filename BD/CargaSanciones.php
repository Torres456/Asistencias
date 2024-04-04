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
        $query = "SELECT Id_sancion, Fecha, No_horas, Observacion, Responsable FROM sanciones WHERE Id_alumno='$user'";
    }

    $result = $conexion->query($query);
    if ($result->num_rows > 0) {
        $salida .= "
             <table class='Table__Users' id='Table__Users'>
             <thead>
                 <tr>
                     <th>Id</th>
                     <th>Fecha</th>
                     <th>Horas eliminadas</th>
                     <th>Observaciones</th>
                 </tr>
             </thead>
             <tbody>";

        while ($fila = $result->fetch_assoc()) {

            $salida .= "<tr>
             <td>" . $fila["Id_sancion"] . "</td>
             <td>" . $fila["Fecha"] . "</td>
             <td>" . $fila["No_horas"] . "</td>
             <td>" . $fila["Observacion"] . "</td>
             </tr>";
        }
        $salida .= "</tbody></table>";
    } else {
        $salida .= "<div class='Table__Alert'>
                 <h2>sin sanciones</h2>
                 <div class='Img__error'>
                <img src='../assets/images/Sin_datos.png' alt='' class='Img__Get'>
            </div>
             </div>";
    }
    echo $salida;

}



?>