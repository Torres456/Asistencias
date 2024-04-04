<?php

include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $ruta_destino = "../Img_Invitados/";

    if (!file_exists($ruta_destino)) {
        mkdir($ruta_destino);
        sleep(0.5);

        $file_src = $_FILES['capturedImage']['tmp_name'];
        $nombre_archivo = $_FILES['capturedImage']['name'];

        if (move_uploaded_file($file_src, $ruta_destino . $nombre_archivo)) {
            echo '200';
        } else {
            echo '300';
        }
    } else {
        $file_src = $_FILES['capturedImage']['tmp_name'];
        $nombre_archivo = $_FILES['capturedImage']['name'];


        if (move_uploaded_file($file_src, $ruta_destino . $nombre_archivo)) {
            echo '200';
        } else {
            echo '300';
        }
    }
}
