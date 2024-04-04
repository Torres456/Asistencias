<?php
sleep(1);
session_start();
include "conexion.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $global = 0;
    $global2 = 0;
    //desencript
    function cifrar($valor)
    {
        $mensajeCifrado = "";
        $crifado = base64_encode($valor);
        for ($i = 0; $i < strlen($crifado); $i++) {
            $caracter = $crifado[$i];
            if (ctype_alpha($caracter)) {
                $mayuscula = ctype_upper($caracter);
                $caracter = strtoupper($caracter);
                $caracterCifrado = chr(((ord($caracter) - ord('A') + 3) % 26) + ord('A'));
                $mensajeCifrado .= ($mayuscula) ? $caracterCifrado : strtolower($caracterCifrado);
            } else {
                $mensajeCifrado .= $caracter;
            }
        }
        return $mensajeCifrado;
    }

    // -------------
    $action = $_POST['Action'];
    if ($action == 1) {
        $Usuario = $_POST['Usuario'];
        $signos = "';-/*._+";
        for ($i = 0; $i < strlen($Usuario); $i++) {
            for ($e = 0; $e < strlen($signos); $e++) {
                if (substr($Usuario, $i, 1) == substr($signos, $e, 1)) {
                    $global = $global + 1;
                } else { 
                }
            }
        }
        if ($global > 0) {
            echo 4;
        } else {

            $Password = $_POST['Password'];
            for ($i = 0; $i < strlen($Password); $i++) {
                for ($e = 0; $e < strlen($signos); $e++) {
                    if (substr($Password, $i, 1) == substr($signos, $e, 1)) {
    
                        $global2 = $global2 + 1;
                    } else {
                    }
                }
            }

            if($global2 > 0){
                echo 4;
            }else{
            $consult = "SELECT * FROM responsables WHERE ID_responsable='$Usuario'";
            $respuesta1 = mysqli_query($conexion, $consult);
            $num_rows = mysqli_num_rows($respuesta1);
            if ($num_rows) {
                $contra = cifrar($Password);
                $consult2 = "SELECT Contrasena FROM responsables WHERE ID_responsable='$Usuario';";
                $respuesta2 = mysqli_query($conexion, $consult2);
                $data = mysqli_fetch_array($respuesta2);

                if ($data['Contrasena'] == $contra) {

                    $consult3 = "SELECT ID_responsable,Nombre FROM responsables WHERE ID_responsable='$Usuario'";
                    $respuesta3 = mysqli_query($conexion, $consult3);
                    $data2 = mysqli_fetch_array($respuesta3);

                    $_SESSION["Id_Responsable"] = $data2["ID_responsable"];
                    $_SESSION["Nombre_Responsable"] = $data2["Nombre"];
                    echo 200;
                } else {
                    echo 4;

                }
            } else {
                echo 2;
            }
            }
            
        }//filtro-1




    } else {

        $Usuario = $_POST['Usuario'];

        $consultB = "SELECT * FROM usuariosSSRP WHERE ID_usuario='$Usuario'";
        $respuesta1B = mysqli_query($conexion, $consultB);
        $num_rowsB = mysqli_num_rows($respuesta1B);
        if ($num_rowsB) {
            $PasswordB = $_POST['Password'];
            $contraB = cifrar($PasswordB);
            $consult2B = "SELECT Contrasena FROM usuariosSSRP WHERE ID_usuario='$Usuario';";
            $respuesta2B = mysqli_query($conexion, $consult2B);
            $dataB = mysqli_fetch_array($respuesta2B);
            if ($dataB['Contrasena'] == $contraB) {
                $consult3B = "SELECT ID_usuario FROM usuariosSSRP WHERE ID_usuario='$Usuario';";
                $respuesta3B = mysqli_query($conexion, $consult3B);
                $data2B = mysqli_fetch_array($respuesta3B);
                $_SESSION['User2']['id'] = $data2B["ID_usuario"];

                echo 200;
            } else {
                echo 4;
            }
        } else {
            echo 2;
        }
    }
}
