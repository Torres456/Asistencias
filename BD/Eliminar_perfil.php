<?php
sleep(1);
session_start();
$varSesion = $_SESSION["Id_Responsable"];
if ($varSesion == '' || $varSesion == null) {
    header("location:login.php");
} else {

    include "conexion.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $accion = $_POST['Accion'];

        if ($accion == 1) {


            $Usuario = $_POST['Usuario'];

            $sql = "SELECT * FROM usuarios where ID_usuario='$Usuario'";
            $result1 = mysqli_query($conexion, $sql);
            $num_rows = mysqli_num_rows($result1);
            if ($num_rows) {
                $data = mysqli_fetch_array($result1);
                if ($data['Registro'] == 'SSRP') {
                    $result_transaccion = true;
                    $conexion->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

                    if (!$conexion->query("DELETE FROM usuariosssrp WHERE ID_usuario='$Usuario' ")) {
                        $result_transaccion = false;
                    }

                    if (!$conexion->query("DELETE FROM asistencia WHERE Usuario='$Usuario' ")) {
                        $result_transaccion = false;
                    }

                    if (!$conexion->query("DELETE FROM archivos WHERE Usuario='$Usuario' ")) {
                        $result_transaccion = false;
                    }

                    if (!$conexion->query("DELETE FROM ssrp WHERE Usuario='$Usuario' ")) {
                        $result_transaccion = false;
                    }

                    if (!$conexion->query("DELETE FROM usuarios WHERE ID_usuario='$Usuario' ")) {
                        $result_transaccion = false;
                    }
                    if ($result_transaccion) {
                        $conexion->commit();
                        echo 200;
                    } else {
                        $conexion->rollback();
                        echo 302;
                    }
                }
            } else {
                echo 301;
            }
        } else if ($accion == 2) {

            $campo = $_POST['Campo'];

            if ($campo == 1) {
                $Horas = $_POST['Horas'];
                $Usuario = $_POST['Usuario'];


                $consult = "SELECT No_horas FROM SSRP WHERE Usuario='$Usuario'";
                $result = mysqli_query($conexion, $consult);
                $num_rows2 = mysqli_num_rows($result);

                if ($num_rows2) {
                    $data = mysqli_fetch_array($result);
                    $horas = $data['No_horas'];

                    $separador = ":";
                    $hora = explode($separador, $Horas);
                    $total = $hora[0] * 60 + $hora[1];
                    $total2 = $horas + $total;

                    $consultU = "UPDATE SSRP SET No_horas='$total2' WHERE usuario='$Usuario'";

                    $result2 = mysqli_query($conexion, $consultU);
                    if ($result2) {
                        echo 200;
                    } else {
                        echo 302;
                    }
                } else {
                    echo 301;
                }
            } else if ($campo == 2) {

                $Usuario = $_POST['Usuario'];
                $Horas2 = $_POST['Horas'];
                $Fecha = $_POST['Fecha'];

                $consult = "SELECT No_horas,Responsable FROM SSRP WHERE Usuario='$Usuario'";
                $result = mysqli_query($conexion, $consult);
                $num_rows2 = mysqli_num_rows($result);

                if ($num_rows2) {
                    $data = mysqli_fetch_array($result);
                    $horasB = $data['No_horas'];
                    $responsable = $data['Responsable'];

                    $separador2 = ":";
                    $hora2 = explode($separador2, $Horas2);
                    $total2 = $hora2[0] * 60 + $hora2[1];
                    $total3 = $horasB + $total2;
                    $horasE = "$hora2[0] Horas $hora2[1] Minutos";

                    $result_transaccion = true;
                    $conexion->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

                    if (!$conexion->query("UPDATE SSRP SET No_horas='$total3' WHERE usuario='$Usuario'")) {
                        $result_transaccion = false;
                    }

                    if (!$conexion->query("INSERT INTO asistencia VALUES ('','00:00:00 NM','00:00:00 NM',$Fecha,'$horasE','$Usuario','0','0','$responsable')")) {
                        $result_transaccion = false;
                    }


                    if ($result_transaccion) {
                        $conexion->commit();
                        echo 200;
                    } else {
                        $conexion->rollback();
                        echo 302;
                    }
                } else {
                    echo 301;
                }

            } else if ($campo == 3) {

                $hora1 = $_POST['H_entrada'];
                $hora2 = $_POST['H_salida'];
                $FechaA = $_POST['Fecha'];
                $Usuario = $_POST['Usuario'];

                $inicio = new DateTime($hora1);
                $fin = new DateTime($hora2);
                $tiempo = $inicio->diff($fin);

                $FinalT = $tiempo->format('%H Horas %i Minutos');
                $FinalS = $tiempo->format('%H:%i');


                $consult6 = "SELECT No_horas,Responsable FROM SSRP WHERE Usuario='$Usuario'";
                $result7 = mysqli_query($conexion, $consult6);
                $data3 = mysqli_fetch_array($result7);
                $horas = $data3['No_horas'];
                $responsable = $data3['Responsable'];

                $separador2 = ":";
                $separador = explode($separador2, $FinalS);
                $total = $separador[0] * 60 + $separador[1];
                $total2 = $horas + $total;


                $result_transaccion2 = true;
                $conexion->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

                if (!$conexion->query("UPDATE SSRP SET No_horas='$total2' WHERE usuario='$Usuario'")) {
                    $result_transaccion2 = false;
                }

                if (!$conexion->query("INSERT INTO asistencia VALUES ('','$hora1','$hora2','$FechaA','$FinalT','$Usuario','0','0','$responsable')")) {
                    $result_transaccion2 = false;
                }

                if ($result_transaccion2) {
                    $conexion->commit();
                    echo 200;
                } else {
                    $conexion->rollback();
                    echo 302;
                }
            }else if ($campo == 4) {

                $Horas = $_POST['Horas'];
                $Usuario = $_POST['Usuario'];
                $Fecha = $_POST['Fecha'];
                $Observacion = $_POST['H_entrada'];

                $consult = "SELECT No_horas,Responsable FROM SSRP WHERE Usuario='$Usuario'";
                $result = mysqli_query($conexion, $consult);
                $num_rows2 = mysqli_num_rows($result);

                if ($num_rows2) {
                    $data = mysqli_fetch_array($result);
                    $horas = $data['No_horas'];
                    $responsable = $data['Responsable'];

                    $separador = ":";
                    $hora = explode($separador, $Horas);
                    $total = $hora[0] * 60 + $hora[1];
                    $total2 = $horas - $total;
                    $FinalT = "$hora[0] Horas $hora[1] Minutos";

  
                    $result_transaccion3 = true;
                    $conexion->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

                    if (!$conexion->query("UPDATE SSRP SET No_horas='$total2' WHERE usuario='$Usuario'")) {
                        $result_transaccion3 = false;
                    }

                    if (!$conexion->query("INSERT INTO sanciones VALUES ('','$Usuario','$Fecha','$FinalT','$Observacion','$responsable')")) {
                        $result_transaccion3 = false;
                    }


                    if ($result_transaccion3) {
                        $conexion->commit();
                        echo 200;
                    } else {
                        $conexion->rollback();
                        echo 302;
                    }
                } else {
                    echo 301;
                }

            }
        }
    }
}
