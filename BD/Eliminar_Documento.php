<?php
// session_start();
// $varSesion = $_SESSION['User2']['id'];

include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $archivo = $_POST['Archivo'];
    $user=$_POST['User'];
    $ruta_archivo = "../Archivos_Usuarios/$archivo";
    if (file_exists($ruta_archivo)) {
       $sql="DELETE FROM archivos WHERE Usuario='$user' AND Nombre='$archivo'";
       $result = mysqli_query($conexion,$sql);
        unlink($ruta_archivo);
        echo 200;
    } else {
        $sql="DELETE FROM archivos WHERE Usuario='$user' AND Nombre='$archivo'";
       $result = mysqli_query($conexion,$sql);

        echo 300;
    }
}
