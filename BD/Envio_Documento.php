<?php

include "conexion.php";
$descripcion = $_POST["Descripcion"];
$Usuario = $_POST["Usuario"];


if (isset($_FILES["file-5"]["name"])) {
    $file_src = $_FILES['file-5']['tmp_name'];
    $nombreArchivo = $_FILES['file-5']['name'];
    $limite = 2000000;
    $tamaño = filesize($file_src);
    if ($tamaño > $limite) {
        echo 300;
    } else {
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
        $document = getExtension($nombreArchivo);
        if ($document != "pdf" && $document != 'png' && $document != 'jpeg' && $document != 'txt' && $document != 'doc' && $document != 'docx' && $document != 'jpg') {

            echo 300;
        } else {
            $newname = $Usuario.'_'.$nombreArchivo;
            $sql = "SELECT * FROM archivos WHERE Nombre='$newname' AND Usuario ='$Usuario'";
            $result = mysqli_query($conexion, $sql);
            $num_rows = mysqli_num_rows($result);

            if ($num_rows) {
                echo 3;
            } else {
                $ruta_destino = "../Archivos_Usuarios/";

                if (!file_exists($ruta_destino)) {
                    mkdir($ruta_destino);

                    sleep(0.5);

                    if (move_uploaded_file($_FILES['file-5']['tmp_name'], $ruta_destino . $newname)) {

                        $sql2 = "INSERT INTO archivos values ('','$newname','$descripcion',CURDATE(),'$Usuario')";
                        $result = mysqli_query($conexion, $sql2);
                        echo 200;
                    } else {

                        echo 302;
                    }
                } else {


                    if (move_uploaded_file($_FILES['file-5']['tmp_name'], $ruta_destino . $newname)) {
                        $sql2 = "INSERT INTO archivos values ('','$newname','$descripcion',CURDATE(),'$Usuario')";
                        $result = mysqli_query($conexion, $sql2);
                        echo 200;
                    }else{
                        
                        echo 303;
                    }
                }
            }
        }
    }
} else {
    echo 301;
}
