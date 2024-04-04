<?php
sleep(1);
include 'conexion.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['Action'];

    if ($action == 1) {

        $Usuario = $_POST['Usuario'];
        $consult = "SELECT * FROM usuarios WHERE ID_usuario='$Usuario'";
        $result = mysqli_query($conexion, $consult);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows) {
            $consult2 = "SELECT * FROM asistencia WHERE usuario='$Usuario' AND Fecha=CURDATE() AND No_horas='0'";
            $result2 = mysqli_query($conexion, $consult2);
            $num_rows2 = mysqli_num_rows($result2);
            if ($num_rows2) {
                echo 3;
            } else {
                $Recurso = $_POST['Recurso'];
                $Observaciones = $_POST['Observaciones'];
                $Responsable = $_POST['Responsable'];

                $insert1 = "INSERT INTO asistencia VALUES ('',TIME_FORMAT(CURRENT_TIME, '%r'),'Sin salida',CURDATE(),'0','$Usuario','$Recurso','$Observaciones','$Responsable')";
                $result1 = mysqli_query($conexion, $insert1);
                if ($result1) {
                    echo 200;
                } else {
                    echo 300;
                }
            }
        } else {
            echo 2;
        }
    } else if ($action == 2) {


        $Usuario = $_POST['Usuario'];
        $consult = "SELECT * FROM usuarios WHERE ID_usuario='$Usuario'";
        $resultB = mysqli_query($conexion, $consult);
        $num_rows = mysqli_num_rows($resultB);
        if ($num_rows) {
            $consult2 = "SELECT * FROM asistencia WHERE usuario='$Usuario' AND Fecha=CURDATE() AND No_horas='0'";
            $resultB2 = mysqli_query($conexion, $consult2);
            $num_rows2 = mysqli_num_rows($resultB2);
            if ($num_rows2) {
                $consult3 = "SELECT H_entrada FROM asistencia WHERE usuario='$Usuario' AND Fecha=CURDATE() AND No_horas='0'";
                $result3 = mysqli_query($conexion, $consult3);
                $data = mysqli_fetch_array($result3);
                $hora1 = $data['H_entrada'];

                $consult4 = "SELECT TIME_FORMAT(CURRENT_TIME, '%r') AS HoraS";
                $result4 = mysqli_query($conexion, $consult4);
                $data2 = mysqli_fetch_array($result4);
                $hora2 = $data2['HoraS'];

                $inicio = new DateTime($hora1);
                $fin = new DateTime($hora2);
                $tiempo = $inicio->diff($fin);

                $FinalT = $tiempo->format('%H Horas %i Minutos');
                $FinalS = $tiempo->format('%H:%i');

                $consult5 = "UPDATE asistencia SET H_salida='$hora2', No_horas='$FinalT' WHERE usuario='$Usuario' AND Fecha=CURDATE() AND No_horas='0'";
                $result5 = mysqli_query($conexion, $consult5);
                if ($result5) {
                    $consult6 = "SELECT Registro FROM usuarios WHERE ID_usuario='$Usuario'";
                    $result6 = mysqli_query($conexion, $consult6);
                    $data3 = mysqli_fetch_array($result6);
                    $tipo = $data3['Registro'];

                    if ($tipo = $data3['Registro'] == 'Invitado') {
                        echo 200;
                    } else {
                        $consult7 = "SELECT No_horas FROM SSRP WHERE Usuario='$Usuario'";
                        $result7 = mysqli_query($conexion, $consult7);
                        $num_rows2 = mysqli_num_rows($result7);

                        $data4 = mysqli_fetch_array($result7);
                        $horas = $data4['No_horas'];
                        $separador = ":";
                        $separador = explode($separador, $FinalS);
                        $total = $separador[0] * 60 + $separador[1];
                        $total2 = $horas + $total;
                        $consult8 = "UPDATE SSRP SET No_horas='$total2' WHERE usuario='$Usuario'";
                        $result8 = mysqli_query($conexion, $consult8);
                        if ($result8) {
                            echo 200;
                        } else {
                            echo 300;
                        }
                    }
                } else {
                    echo 300;
                }
            } else {
                echo 3;
            }
        } else {
            echo 2;
        }
    } 






}
