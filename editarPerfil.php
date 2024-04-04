<?php
session_start();
$varSesion = $_SESSION['User2']['id'];
if ($varSesion == '' || $varSesion == null) {
    header("location:loginA.php");
} else {

    include 'BD/conexion.php';
    $sql = "SELECT * FROM usuarios where ID_usuario='$varSesion'";
    $result = mysqli_query($conexion, $sql);
    $num_rows = mysqli_num_rows($result);

    $consult = "SELECT ID_responsable, Nombre, A_paterno, A_materno FROM responsables";
    $respuesta = mysqli_query($conexion, $consult);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/EditarPerfil.css?see=1.11">
        <title>Editar perfil</title>
    </head>

    <body class="hidden">
        <div class="centrado" id="onload">
            <img src="assets/images/LoadingCCAI2.gif" alt="" class="Img__Loading">
        </div>
        <?php
        if ($num_rows) {
            $data = mysqli_fetch_array($result);
        ?>

            <header class="Header">
                <h1 class="Header__Title">Editar perfil.</h1>
                <div class="line"></div>
            </header>

            <section class="Data">
                <h2 class="Data__Title">Datos personales:</h2>
                <div class="Box__Data">
                    <div class="Data__Info">
                        <label for="" class="Data__Info_Label Data__Info_LabelE">Nombre:</label>
                        <input id="Nombre" class="Data__Info_Label" value="<?php echo $data['Nombre'] ?>" autocomplete="nope" autocomplete="off" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >=31 && event.charCode <= 33) || (event.charCode >=225 && event.charCode <= 225) || (event.charCode >=193 && event.charCode <= 193) || (event.charCode >=233 && event.charCode <= 233) || (event.charCode >=201 && event.charCode <= 211)|| (event.charCode >=237 && event.charCode <= 243) )" /></input>
                        <input type="text" value="<?php echo $varSesion ?>" id="None">
                    </div>
                    <div class="Data__Info">
                        <label class="Data__Info_Label Data__Info_LabelE">Apellido paterno:</label>
                        <input id="A_paterno" class="Data__Info_Label" value="<?php echo $data['Apellido_p'] ?>" autocomplete="nope" autocomplete="off" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >=31 && event.charCode <= 33) || (event.charCode >=225 && event.charCode <= 225) || (event.charCode >=193 && event.charCode <= 193) || (event.charCode >=233 && event.charCode <= 233) || (event.charCode >=201 && event.charCode <= 211)|| (event.charCode >=237 && event.charCode <= 243) )" /></input>
                    </div>
                    <div class="Data__Info">
                        <label class="Data__Info_Label Data__Info_LabelE">Apellido materno:</label>
                        <input id="A_materno" class="Data__Info_Label" value="<?php echo $data['Apellido_m'] ?>" autocomplete="nope" autocomplete="off" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >=31 && event.charCode <= 33) || (event.charCode >=225 && event.charCode <= 225) || (event.charCode >=193 && event.charCode <= 193) || (event.charCode >=233 && event.charCode <= 233) || (event.charCode >=201 && event.charCode <= 211)|| (event.charCode >=237 && event.charCode <= 243) )" /></input>
                    </div>
                    <div class="Data__Info">
                        <label for="" class="Data__Info_Label Data__Info_LabelE">Edad:</label>
                        <input id="Edad" type="number" class="Data__Info_Label" value="<?php echo $data['Edad'] ?>" autocomplete="nope" autocomplete="off" onkeypress="return ((event.charCode >= 48 && event.charCode <= 57))" /></input>
                    </div>
                    <div class="Data__Info">
                        <label for="" class="Data__Info_Label Data__Info_LabelE">Genero:</label>
                        <select name="Genero" id="Genero" class="Data__Info_Label">
                            <option <?php echo $data["Genero"] === 'Hombre' ? "selected='selected'" : "" ?> value="Hombre">Masculino</option>
                            <option <?php echo $data["Genero"] === 'Mujer' ? "selected='selected'" : "" ?> value="Mujer">Femenino</option>
                        </select>
                    </div>

                    <div class="Data__Info">
                        <label for="" class="Data__Info_Label Data__Info_LabelE">Número de celular:</label>
                        <input id="N_celular" type="number" class="Data__Info_Label" value="<?php echo $data['Numero_cel'] ?>" autocomplete="nope" autocomplete="off" onkeypress="return ((event.charCode >= 48 && event.charCode <= 57))" /></input>
                    </div>

                    <div class="Data__Info">
                        <label for="" class="Data__Info_Label Data__Info_LabelE">Número de casa:</label>
                        <input id="N_casa" type="number" class="Data__Info_Label" value="<?php echo $data['Numero_cas'] ?>" autocomplete="nope" autocomplete="off" onkeypress="return ((event.charCode >= 48 && event.charCode <= 57))" /></input>
                    </div>
                </div>
            </section>

            <section class="Data">
                <h2 class="Data__Title">Datos académicos:</h2>
                <div class="Box__Data">
                    <div class="Data__Info">
                        <label for="" class="Data__Info_Label Data__Info_LabelE">Tipo:</label>
                        <select name="TipoU" id="TipoU" class="Data__Info_Label">
                            <option <?php echo $data["TipoA"] === 'Alumno' ? "selected='selected'" : "" ?>value="Alumno">Alumno</option>
                            <option <?php echo $data["TipoA"] === 'Alumno_externo' ? "selected='selected'" : "" ?> value="Alumno_externo">Alumno externo</option>
                        </select>
                    </div>
                    <div class="Data__Info">
                        <label for="" class="Data__Info_Label Data__Info_LabelE">Carrera:</label>
                        <select name="Carrera" id="Carrera" class="Data__Info_Label">
                            <option <?php echo $data["Carrera"] === 'Ingeniería en Sistemas Computacionales' ? "selected='selected'" : "" ?> value="Ingeniería en Sistemas Computacionales">Ingeniería en Sistemas Computacionales</option>

                            <option <?php echo $data["Carrera"] === 'Ingeniería Ambienta' ? "selected='selected'" : "" ?> value="Ingeniería Ambiental">Ingeniería Ambiental</option>

                            <option <?php echo $data["Carrera"] === 'Ingeniería Biomédica' ? "selected='selected'" : "" ?> value="Ingeniería Biomédica">Ingeniería Biomédica</option>

                            <option <?php echo $data["Carrera"] === 'Ingeniería Informática' ? "selected='selected'" : "" ?> value="Ingeniería Informática">Ingeniería Informática</option>

                            <option <?php echo $data["Carrera"] === 'Ingeniería Electrónica' ? "selected='selected'" : "" ?> value="Ingeniería Electrónica">Ingeniería Electrónica</option>

                            <option <?php echo $data["Carrera"] === 'Licenciatura en Administración' ? "selected='selected'" : "" ?> value="Licenciatura en Administración">Licenciatura en Administración</option>

                            <option <?php echo $data["Carrera"] === 'Arquitectura' ? "selected='selected'" : "" ?> value="Arquitectura">Arquitectura</option>

                            <option <?php echo $data["Carrera"] === 'Maestria en Administración' ? "selected='selected'" : "" ?> value="Maestria en Administración">Maestria en Administración</option>

                            <option <?php echo $data["Carrera"] === 'Sin carrera' ? "selected='selected'" : "" ?>value="Sin carrera">Sin carrera</option>
                        </select>
                    </div>
                    <div class="Data__Info">
                        <label for="" class="Data__Info_Label Data__Info_LabelE">Matricula:</label>
                        <input id="Matricula" type="number" class="Data__Info_Label" value="<?php echo $data['ID_usuario'] ?>" autocomplete="nope" autocomplete="off" onkeypress="return ((event.charCode >= 48 && event.charCode <= 57))" /></input>
                    </div>
                    <div class="Data__Info">
                        <label for="" class="Data__Info_Label Data__Info_LabelE">Grupo:</label>
                        <input id="Grupo" type="number" class="Data__Info_Label" value="<?php echo $data['Grupo'] ?>" autocomplete="nope" autocomplete="off" onkeypress="return ((event.charCode >= 48 && event.charCode <= 57))" /></input>
                    </div>
                </div>
            </section>







            <?php
            if ($data['Registro'] == "SSRP") {
                $sql2 = "SELECT * FROM ssrp where Usuario='$varSesion'";
                $result2 = mysqli_query($conexion, $sql2);
                $num_rows2 = mysqli_num_rows($result2);
                if ($num_rows2) {
                    $data2 = mysqli_fetch_array($result2);
                } else {
                    $data2 = array(
                        "Tipo" => "Sin datos",
                        "F_inicio" => "Sin datos",
                        "F_termino" => "Sin datos",
                        "No_horas" => "Sin datos",
                        "Proyecto" => "Sin datos",
                        "Responsable" => "Sin datos"
                    );
                }
            ?>
                <section class="Data">
                    <h2 class="Data__Title">Datos de servicio:</h2>
                    <div class="Box__Data">
                        <div class="Data__Info">
                            <label for="" class="Data__Info_Label Data__Info_LabelE">Tipo:</label>
                            <select name="Servicio" id="Servicio" class="Data__Info_Label">
                                <option <?php echo $data2["Tipo"] === 'Servicio social' ? "selected='selected'" : "" ?> value="Servicio social">Servicio social</option>
                                <option <?php echo $data2["Tipo"] === 'Residencias profecionales' ? "selected='selected'" : "" ?> value="Residencias profecionales">Residencias profecionales</option>
                            </select>
                        </div>
                        <div class="Data__Info">
                            <label for="" class="Data__Info_Label Data__Info_LabelE">Fecha de inicio:</label>
                            <input id="Fecha_I" type="date" class="Data__Info_Label" value="<?php echo $data2['F_inicio'] ?>"></input>
                        </div>
                        <div class="Data__Info">
                            <label for="" class="Data__Info_Label Data__Info_LabelE">Fecha de termino:</label>
                            <input id="Fecha_T" type="date" class="Data__Info_Label" value="<?php echo $data2['F_termino'] ?>"></input>
                        </div>

                        <div class="Data__Info">
                            <label for="" class="Data__Info_Label Data__Info_LabelE">Proyecto:</label>
                            <input id="Proyecto" class="Data__Info_Label" value="<?php echo $data2['Proyecto'] ?>"></input>
                        </div>
                        <?php
                        $responsable = $data2['Responsable'];
                        $sql3 = "SELECT * FROM responsables where ID_responsable='$responsable'";
                        $result3 = mysqli_query($conexion, $sql3);
                        $num_rows2 = mysqli_num_rows($result2);
                        if ($num_rows2) {
                            $data3 = mysqli_fetch_array($result3);
                        } else {
                            $data3 = array(
                                "Nombre" => "Sin datos",
                                "A_paterno" => "Sin datos",
                                "A_materno" => "Sin datos"
                            );
                        }
                        ?>
                        <div class="Data__Info">
                            <label for="" class="Data__Info_Label Data__Info_LabelE">Responsable:</label>
                            <select name="Responsable" id="Responsable" class="Data__Info_Label">
                                <?php
                                while ($Users = mysqli_fetch_array($respuesta)) {
                                ?>
                                    <option <?php echo $data2["Responsable"] === $Users["ID_responsable"] ? "selected='selected'" : "" ?> value="<?php echo $Users['ID_responsable'] ?>"> <?php echo $Users['Nombre'] ?> <?php echo $Users['A_paterno'] ?> <?php echo $Users['A_materno'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                </section>

                
                <?php
                $consult = "SELECT * FROM usuariosssrp WHERE ID_usuario='$varSesion'";
                $result4 = mysqli_query($conexion, $consult);
                $num_rows3 = mysqli_num_rows($result4);
                if ($num_rows3) {
                    $data4 = mysqli_fetch_array($result4);
                    function desifrar($mensaje2)
                    {
                        $decrifad = "";
                        for ($i = 0; $i < strlen($mensaje2); $i++) {
                            $caracter = $mensaje2[$i];
                            if (ctype_alpha($caracter)) {
                                $mayuscula = ctype_upper($caracter);
                                $caracter = strtoupper($caracter);
                                $caracterCifrado = chr(((ord($caracter) + ord('A') - 3) % 26) + ord('A'));
                                $decrifad .= ($mayuscula) ? $caracterCifrado : strtolower($caracterCifrado);
                            } else {
                                $decrifad .= $caracter;
                            }
                        }
                        return base64_decode($decrifad);
                    }
                    $clave = desifrar($data4['Contrasena']);
                } else {
                    $data4 = array(
                        "Nombre" => "Sin datos",
                        "A_paterno" => "Sin datos",
                        "A_materno" => "Sin datos"
                    );
                }
                ?>
                <section class="Data">
                    <h2 class="Data__Title">Datos de seción:</h2>
                    <div class="Data__Info">
                        <label for="" class="Data__Info_Label Data__Info_LabelE">Contraseña:</label>
                        <input type="password" class="Data__Info_Label Data__Info_Password" value="<?php echo $clave ?>" id="Input__Password">
                        <img src="assets/images/visibility_off.png" alt="Icono de cerrar" class="Img_cerrar" id="Btn_Password">
                    </div>
                </section>

            <?php
            } else {
            }
            ?>
            <section class="Data Options">
                <h2 class="Data__Title">Opciones:</h2>
                <div class="Messaje_Send" id="Messaje_Send">
                    <h2 class="Messaje_Send_Title" id="Messaje_Send_Title">Enviando..</h2>
                </div>
                <div class="Container__Buttons">
                    <button class="Button__Option Button__Option-One" onclick="myFunction()">Cancelar</button>
                    <button class="Button__Option Button__Option-Two" id="Button__Option-Two">Guardar</button>
                </div>
            </section>
        <?php
        } else {
        ?>
            <div class="Alert">
                <h2 class="Alert__Title">Usuario no encontrado</h2>
            </div>
        <?php
        }
        ?>

        <!-- Alert---- -->
        <div class="Alert_Send" id="Alert_Send">
            <h2 class="Alert_Send_Title" id="Alert_Send_Title"></h2>
            <img src="assets/images/cerrar.png" alt="Icono de cerrar" class="Img_cerrar" id="Btn_Error_cerrar">
        </div>

    </body>

    <script>
        function myFunction() {
            $(location).attr('href', 'Perfil.php');
        }
    </script>

    <script src="js/EditarPerfil.js?see=1.14"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    </html>
<?php
}

?>