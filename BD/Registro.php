<?php

sleep(1);

include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $action = $_POST['Action'];

    if ($action == 1) {

        $matricula = $_POST['Matricula'];
        $consult = "SELECT * FROM usuarios WHERE ID_usuario='$matricula'";
        $respuesta1 = mysqli_query($conexion, $consult);
        $num_rows = mysqli_num_rows($respuesta1);

        if ($num_rows) {
            echo 2;
        } else {
            $Contraseña = $_POST['Contraseña'];

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

            $Matricula = $_POST['Matricula'];
            $NewContraseña = cifrar($Contraseña);
            $Tipo = $_POST['Tipo'];
            $Nombre = $_POST['Nombre'];
            $ApellidoP = $_POST['ApellidoP'];
            $ApellidoM = $_POST['ApellidoM'];
            $Edad = $_POST['Edad'];
            $Genero = $_POST['Genero'];
            $Numero_cel = $_POST['Numero_cel'];
            $Numero_cas = $_POST['Numero_cas'];
            $Carrera = $_POST['Carrera'];
            $Grupo = $_POST['Grupo'];
            $Servicio = $_POST['Servicio'];
            $FechaI = $_POST['FechaI'];
            $FechaT = $_POST['FechaT'];
            $Horas = $_POST['Horas'];
            $Proyecto = $_POST['Proyecto'];
            $Responsable = $_POST['Responsable'];

            $insert1 = "INSERT INTO usuarios(ID_usuario,tipoA,Registro,Nombre,Apellido_p,Apellido_m,Edad,Genero,Numero_cel,Numero_cas,Carrera,Grupo,F_registro,H_registro) VALUES ('$Matricula','$Tipo','SSRP','$Nombre','$ApellidoP','$ApellidoM','$Edad','$Genero','$Numero_cel','$Numero_cas','$Carrera','$Grupo',CURDATE(),TIME_FORMAT(CURRENT_TIME, '%r'))";
            $respuesta2 = mysqli_query($conexion, $insert1);

            if ($respuesta2) {

                $insert2 = "INSERT INTO ssrp(Tipo,Usuario,F_inicio,F_termino,No_horas,No_faltas,Proyecto,Responsable,Estatus) VALUES ('$Servicio','$Matricula','$FechaI','$FechaT','0','0','$Proyecto','$Responsable','Activo')";
                $respuesta3 = mysqli_query($conexion, $insert2);
                if ($respuesta3) {

                    $insert3 = "INSERT INTO usuariosssrp(ID_usuario,Contrasena) VALUES ('$Matricula','$NewContraseña')";
                    $respuesta4 = mysqli_query($conexion, $insert3);

                    if ($respuesta4) {
                        echo 200;
                    } else {
                        $delete2 = "DELETE FROM usuarios WHERE ID_usuario='$Matricula'";
                        $respuestaD2 = mysqli_query($conexion, $delete2);
                        if ($respuestaD2) {

                            $delete3 = "DELETE FROM ssrp WHERE Usuario='$Matricula'";
                            $respuestaD2 = mysqli_query($conexion, $delete3);
                        }
                    }
                } else {
                    $delete = "DELETE FROM usuarios WHERE ID_usuario='$Matricula'";
                    $respuestaD1 = mysqli_query($conexion, $delete);
                    echo 302;
                }
            } else {
                echo 301;
            }
        }
    } else if ($action == 2) {

        $matricula = $_POST['Matricula'];
        $consult = "SELECT * FROM usuarios WHERE ID_usuario='$matricula'";
        $respuestaA = mysqli_query($conexion, $consult);
        $num_rows = mysqli_num_rows($respuestaA);

        if ($num_rows) {
            echo 2;
        } else {

            $Tipo = $_POST['Tipo'];
            $Matricula = $_POST['Matricula'];
            $Nombre = $_POST['Nombre'];
            $ApellidoP = $_POST['ApellidoP'];
            $ApellidoM = $_POST['ApellidoM'];
            $Edad = $_POST['Edad'];
            $Genero = $_POST['Genero'];
            $Carrera = $_POST['Carrera'];
            $Proyecto = $_POST['Proyecto'];
            $Equipo = $_POST['Equipo'];
            $Observaciones = $_POST['Observaciones'];
            $Responsable = $_POST['Responsable'];

            $insert1 = "INSERT INTO usuarios(ID_usuario,tipoA,Registro,Nombre,Apellido_p,Apellido_m,Edad,Genero,Numero_cel,Numero_cas,Carrera,Grupo,F_registro,H_registro) VALUES ('$Matricula','$Tipo','Invitado','$Nombre','$ApellidoP','$ApellidoM','$Edad','$Genero','00000000','00000000','$Carrera','0',CURDATE(),TIME_FORMAT(CURRENT_TIME, '%r'))";
            $respuestaB = mysqli_query($conexion, $insert1);

            if ($respuestaB) {

                $insert2 = "INSERT INTO asistencia VALUES ('',TIME_FORMAT(CURRENT_TIME, '%r'),'Sin salida',CURDATE(),'0','$Matricula','$Equipo','$Observaciones','$Responsable')";
                $respuestaC = mysqli_query($conexion, $insert2);

                if ($respuestaC) {
                    echo 200;
                } else {
                    $delete = "DELETE FROM usuarios WHERE ID_usuario='$Matricula'";
                    $respuestaD = mysqli_query($conexion, $delete);
                    echo 302;
                }
            } else {
                echo 301;
            }
        }
    }
}
