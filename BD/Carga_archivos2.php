<?php
// session_start();
// $varSesion = $_SESSION['User2']['id'];
include ("conexion.php");
$salida="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$user=$_POST['User'];

}

$query="SELECT * FROM archivos WHERE Usuario='$user'";

// if(isset($_POST['consulta'])){
//     $q=$conexion->real_escape_string($_POST['consulta']);
//     $query="SELECT * FROM usuarios WHERE Nombre LIKE '%".$q."%' OR
//     ID_usuario LIKE '%".$q."%' OR Grupo LIKE '%".$q."%'";
// }
    $result= $conexion->query($query);

     //extencion
     function getExtension($file, $tolower = true)
     {
         $file = basename($file);
         $pos = strrpos($file, '.');
         if ($file == '' || $pos === false) {
             return '';
         }
         $extension = substr($file, $pos + 1);
         if ($tolower) {
             $extension = strtolower($extension);
         }
         return $extension;
     }

    if($result->num_rows >0){
        $salida.="
                <table class='Table__Users' id='Table__Users'>
                <thead>
                    <tr>
                        <th>Archivo</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>";

                while($fila=$result->fetch_assoc()){

                    $tipo=getExtension($fila['Nombre']);

                    if($tipo=="pdf"){
                        $salida.="<tr>
                <td><a href='pdfView.php?archivo=".$fila['Nombre']."' target='_blank'>".$fila['Nombre']."</a></td>
                <td>".$fila["Descripcion"]."</td>
                <td>".$fila["Fecha"]."</td>
                <td><a class='Table__Button' id='".$fila['Nombre']."'>Eliminar</a>
                </td>
                </tr>";
                    }else{
                        $salida.="<tr> 
                <td><a href='../Archivos_Usuarios/".$fila['Nombre']."' 'download/Download File'>".$fila['Nombre']."</a></td>
                <td>".$fila["Descripcion"]."</td>
                <td>".$fila["Fecha"]."</td>
                <td><a class='Table__Button' id='".$fila['Nombre']."'>Eliminar</a>
                </td>
                </tr>";
                    }

                    // <a href='pdfview.php?archivo=".$fila["Nombre"]"' target='_blank'>.$fila["Nombre"]</a>

                    
                }
                $salida.="</tbody></table>";
                }else{
                    $salida.="<div class='Table__Alert'>
                    <h2>No se encontraron archivos</h2>
                    <div class='Img__error'>
                <img src='../assets/images/Sin_datos.png' alt='' class='Img__Get'>
            </div>
                </div>";
                }
                echo $salida;

?>