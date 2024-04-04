<?php
sleep(1);
session_start();
$varSesion = $_SESSION['User2']['id'];
if ($varSesion == '' || $varSesion == null) {
    header("location:Student_System.php.php");
} else {
    include "conexion.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $action = $_POST['accion'];
        if ($action == 1) {

            $matricula = $_POST['Matricula'];
            $Nombre = $_POST['Nombre'];
            $ApellidoP = $_POST['A_paterno'];
            $ApellidoM = $_POST['A_materno'];
            $Edad = $_POST['Edad'];
            $Genero = $_POST['Genero'];
            $Numero_cel = $_POST['N_celular'];
            $Numero_cas = $_POST['N_casa'];

            $insert1 = "UPDATE usuarios SET Nombre='$Nombre', Apellido_p='$ApellidoP', Apellido_m='$ApellidoM', Edad='$Edad', Genero='$Genero', Numero_cel='$Numero_cel', Numero_cas='$Numero_cas' WHERE ID_usuario='$matricula'";
            $respuesta1 = mysqli_query($conexion, $insert1);

            if ($respuesta1) {
                echo 200;
            } else {

                echo 300;
            }
        } else if ($action == 2) {
            $matriculaP = $_POST['MatriculaP'];
            $matricula = $_POST['Matricula'];
            $Tipo = $_POST['TipoU'];
            $Carrera = $_POST['Carrera'];
            $Grupo = $_POST['Grupo'];

            if ($matricula != $matriculaP) {

                $consult = "SELECT * FROM usuarios WHERE ID_usuario='$matricula'";
                $res = mysqli_query($conexion, $consult);
                $num_rows = mysqli_num_rows($res);
                if ($num_rows) {
                    echo 202;
                } else {

                    $consult = "SELECT * FROM usuarios WHERE ID_usuario='$matriculaP'";
                    $res2 = mysqli_query($conexion, $consult);
                    $data = mysqli_fetch_array($res2);
                    if ($data['Registro'] == 'SSRP') {
                        $result_transaccion = true;

                        $conexion->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

                        $checkOff = "SET FOREIGN_KEY_CHECKS=0";
                        $res1 = mysqli_query($conexion, $checkOff);

                        if (!$conexion->query("UPDATE usuarios SET ID_usuario='$matricula' WHERE ID_usuario='$matriculaP'")) {
                            $result_transaccion = false;
                        }

                        if (!$conexion->query("UPDATE ssrp SET Usuario='$matricula' WHERE Usuario='$matriculaP'")) {
                            $result_transaccion = false;
                        }

                        if (!$conexion->query("UPDATE usuariosssrp SET ID_usuario='$matricula' WHERE ID_usuario='$matriculaP'")) {
                            $result_transaccion = false;
                        }

                        if (!$conexion->query("UPDATE asistencia SET Usuario='$matricula' WHERE Usuario='$matriculaP'")) {
                            $result_transaccion = false;
                        }

                        if (!$conexion->query("UPDATE archivos SET Usuario='$matricula' WHERE Usuario='$matriculaP'")) {
                            $result_transaccion = false;
                        }

                        $checkOn = "SET FOREIGN_KEY_CHECKS=1";
                        $res3 = mysqli_query($conexion, $checkOn);


                        if ($result_transaccion) {
                            $conexion->commit();
                            $_SESSION['User2']['id'] = "";
                            echo 201;
                        } else {
                            $conexion->rollback();
                            echo 302;
                        }
                    }
                }
            } else {

                $insert2 = "UPDATE usuarios SET TipoA='$Tipo', Carrera='$Carrera', Grupo='$Grupo' WHERE ID_usuario='$matriculaP'";
                $respuesta2 = mysqli_query($conexion, $insert2);

                if ($respuesta2) {
                    echo 200;
                } else {
                    echo 300;
                }
            }
        } else if ($action == 3) {

            $matricula = $_POST['Matricula'];
            $Servicio = $_POST['Servicio'];
            $FechaI = $_POST['Fecha_I'];
            $FechaT = $_POST['Fecha_T'];
            $Proyecto = $_POST['Proyecto'];
            $Responsable = $_POST['Responsable'];

            $insert3 = "UPDATE ssrp SET Tipo='$Servicio', F_inicio='$FechaI', F_termino='$FechaT', Responsable='$Responsable' WHERE Usuario='$matricula'";
            $respuesta3 = mysqli_query($conexion, $insert3);
            if ($respuesta3) {
                echo 200;
            } else {
                echo 300;
            }
        } else if ($action == 4) {

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


            $matricula = $_POST['Matricula'];
            $contraseña = cifrar($_POST['Contraseña']);

            $insert4 = "UPDATE usuariosssrp SET Contrasena='$contraseña' WHERE ID_usuario='$matricula'";
            $respuesta4 = mysqli_query($conexion, $insert4);
            if ($respuesta4) {
                $_SESSION['User2']['id'] = "";
                echo 203;
            } else {
                echo 300;
            }
        }
    }
}
