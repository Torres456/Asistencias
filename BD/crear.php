<?php
sleep(1);
session_start();
$varSesion = $_SESSION["Id_Responsable"];
if ($varSesion == '' || $varSesion == null) {
    header("location:login.php");
} else {
    include "conexion.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $Matricula = $_POST['Matricula'];

        $action = $_POST['accion'];
        if ($action == 1) {

            $consult = "SELECT * FROM responsables WHERE ID_responsable='$Matricula'";
            $res = mysqli_query($conexion, $consult);
            $num_rows = mysqli_num_rows($res);
            if ($num_rows) {
                echo 202;
            } else {

                $Contraseña = $_POST['Contrasena'];

                function cifrar($mensaje)
                {
                    $mensajeCifrado = "";
                    $crifado = base64_encode($mensaje);
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


                $NewContraseña = cifrar($Contraseña);
                $Nombre = $_POST['Nombre'];
                $A_paterno = $_POST['A_paterno'];
                $A_materno = $_POST['A_materno'];
                $Usuario = $_POST['Usuario'];

                $insert2 = "INSERT INTO responsables(ID_responsable,Nombre,A_paterno,A_materno,No_usuario,Contrasena) VALUES ('$Matricula','$Nombre','$A_paterno','$A_materno','$Usuario','$NewContraseña')";
                $respuesta3 = mysqli_query($conexion, $insert2);
                if ($respuesta3) {
                    echo 200;
                } else {
                    echo 300;
                }
            }
        }
    }
}
