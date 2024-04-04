<?php
include "conexion.php";
$salida="";
// $query=" SELECT * FROM asistencia where Fecha=CURDATE() AND No_horas='0'";
$query="SELECT a.Usuario, a.H_entrada, a.Recurso, a.Fecha,a.No_horas, u.Registro, u.Nombre FROM asistencia AS a INNER JOIN usuarios AS u ON a.Usuario = u.ID_usuario WHERE a.Fecha=CURDATE() AND a.No_horas='0'";

if(isset($_POST['consulta'])){
    $q=$conexion->real_escape_string($_POST['consulta']);
    $query="SELECT * FROM asistencia WHERE usuario LIKE '%".$q."%' OR H_entrada LIKE '%".$q."%' AND Fecha=CURDATE()";
}
    $result= $conexion->query($query);

    if($result->num_rows >0){
        $salida.="
                <table class='Table__Users' id='Table__Users'>
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Entrada</th>
                        <th>Computadora</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody>";

                while($fila=$result->fetch_assoc()){

                $salida.="<tr>
                <td>".$fila["Usuario"]."</td>
                <td>".$fila["Nombre"]."</td>
                <td>".$fila["H_entrada"]."</td>
                <td>".$fila["Recurso"]."</td>
                <td>".$fila["Registro"]."</td>
                </tr>";
                    
                }
                $salida.="</tbody></table>";
                }else{
                    $salida.="<div class='Table__Anuncio'>
                    <h2>No se encontraron asistencias el dia de hoy</h2>
                </div>";
                }
                echo $salida;
?>