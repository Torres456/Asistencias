<?php

session_start();
$varSesion = $_SESSION["Id_Responsable"];
if ($varSesion == '' || $varSesion == null) {
    header("location:login.php");
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../assets/images/IconCCAI.png">
        <link rel="stylesheet" href="../css/Panel_Editar_Perfil.css?see=1.8">
        <link rel="stylesheet" href="../css/recarga.css">
        <title>Editar datos personales</title>
    </head>

    <body>
        <div class="centrado" id="onload">
            <img src="../assets/images/LoadingCCAI2.gif" alt="" class="Img__Loading">
        </div>

        <?php
        if (isset($_GET['Tipo']) && isset($_GET['Usuario'])) {
            $user = $_GET['Usuario'];
            $tipo = $_GET['Tipo'];
            include '../BD/conexion.php';
            $sql = "SELECT * FROM usuarios where ID_usuario='$user'";
            $result = mysqli_query($conexion, $sql);
            $num_rows = mysqli_num_rows($result);

            if ($num_rows) {
                $data = mysqli_fetch_array($result);

                if ($tipo == 'Editar-datos-personales') {
        ?>
                    <header class="Header">
                        <div class="Header_Containner_Img">
                            <img src="../assets/images/Atras.png" alt="Flecha" class="Img_Arrow" id="Btn_Arrow">
                        </div>
                        <h1 class="Header__Title" id="Header__Title">Editar datos personales.</h1>
                    </header>

                    <section class="Data">
                        <h2 class="Data__Title">Datos personales:</h2>

                        <div class="Box__Data">
                            <form action="" id="Form">
                                <div class="Data__Info">
                                    <label for="" class="Data__Info_Label Data__Info_LabelE">Nombre:</label>
                                    <input name="Nombre" id="Nombre" class="Data__Info_Label" value="<?php echo $data['Nombre'] ?>" autocomplete="nope" autocomplete="off" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >=31 && event.charCode <= 33) || (event.charCode >=225 && event.charCode <= 225) || (event.charCode >=193 && event.charCode <= 193) || (event.charCode >=233 && event.charCode <= 233) || (event.charCode >=201 && event.charCode <= 211)|| (event.charCode >=237 && event.charCode <= 243) )" /></input>
                                </div>
                                <div class="Data__Info">
                                    <label class="Data__Info_Label Data__Info_LabelE">Apellido paterno:</label>
                                    <input name="Apellido paterno" id="Apellido_paterno" class="Data__Info_Label" value="<?php echo $data['Apellido_p'] ?>" autocomplete="nope" autocomplete="off" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >=31 && event.charCode <= 33) || (event.charCode >=225 && event.charCode <= 225) || (event.charCode >=193 && event.charCode <= 193) || (event.charCode >=233 && event.charCode <= 233) || (event.charCode >=201 && event.charCode <= 211)|| (event.charCode >=237 && event.charCode <= 243) )" /></input>
                                </div>
                                <div class="Data__Info">
                                    <label class="Data__Info_Label Data__Info_LabelE">Apellido materno:</label>
                                    <input name="Apellido materno" id="Apellido_materno" class="Data__Info_Label" value="<?php echo $data['Apellido_m'] ?>" autocomplete="nope" autocomplete="off" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >=31 && event.charCode <= 33) || (event.charCode >=225 && event.charCode <= 225) || (event.charCode >=193 && event.charCode <= 193) || (event.charCode >=233 && event.charCode <= 233) || (event.charCode >=201 && event.charCode <= 211)|| (event.charCode >=237 && event.charCode <= 243) )" /></input>
                                </div>
                                <div class="Data__Info">
                                    <label for="" class="Data__Info_Label Data__Info_LabelE">Edad:</label>
                                    <input name="Edad" id="Edad" type="number" class="Data__Info_Label" value="<?php echo $data['Edad'] ?>" autocomplete="nope" autocomplete="off" onkeypress="return ((event.charCode >= 48 && event.charCode <= 57))" /></input>
                                </div>
                                <div class="Data__Info">
                                    <label for="" class="Data__Info_Label Data__Info_LabelE">Genero:</label>
                                    <select name="Genero" id="Genero" class="Data__Info_Label">
                                        <option <?php echo $data["Genero"] === 'Masculino' ? "selected='selected'" : "" ?> value="Masculino">Masculino</option>
                                        <option <?php echo $data["Genero"] === 'Femenino' ? "selected='selected'" : "" ?> value="Femenino">Femenino</option>
                                    </select>
                                </div>
                                <div class="Data__Info">
                                    <label for="" class="Data__Info_Label Data__Info_LabelE">Número de celular:</label>
                                    <input name="Numero de celular" id="Numero_cel" type="number" class="Data__Info_Label" value="<?php echo $data['Numero_cel'] ?>" autocomplete="nope" autocomplete="off" onkeypress="return ((event.charCode >= 48 && event.charCode <= 57))" /></input>
                                </div>
                                <div class="Data__Info">
                                    <label for="" class="Data__Info_Label Data__Info_LabelE">Número de casa:</label>
                                    <input name="Numero de casa" id="Numero_cas" type="number" class="Data__Info_Label" value="<?php echo $data['Numero_cas'] ?>" autocomplete="nope" autocomplete="off" onkeypress="return ((event.charCode >= 48 && event.charCode <= 57))" /></input>
                                </div>
                                <input id="MatriculaP" type="number" class="Data__Info_Label" value="<?php echo $data['ID_usuario'] ?>"></input>
                            </form>
                        </div>
                    </section>


                <?php
                } else if ($tipo == 'Editar-datos-academicos') {

                ?>
                    <header class="Header">
                        <div class="Header_Containner_Img">
                            <img src="../assets/images/Atras.png" alt="Flecha" class="Img_Arrow" id="Btn_Arrow">
                        </div>
                        <h1 class="Header__Title" id="Header__Title">Editar datos académicos.</h1>
                    </header>

                    <section class="Data">
                        <h2 class="Data__Title">Datos académicos:</h2>
                        <div class="Box__Data">
                            <form action="" id="Form">
                                <div class="Data__Info">
                                    <label for="" class="Data__Info_Label Data__Info_LabelE">Tipo:</label>
                                    <select name="TipoU" id="TipoU" class="Data__Info_Label">
                                        <option <?php echo $data["TipoA"] === 'Alumno' ? "selected='selected'" : "" ?>value="Alumno">Alumno</option>
                                        <option <?php echo $data["TipoA"] === 'Alumno externo' ? "selected='selected'" : "" ?> value="Alumno externo">Alumno externo</option>
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
                                    <input id="Matricula" name="Matricula" type="number" class="Data__Info_Label" value="<?php echo $data['ID_usuario'] ?>" autocomplete="nope" autocomplete="off" onkeypress="return ((event.charCode >= 48 && event.charCode <= 57))" /></input>
                                    <input id="MatriculaP" type="number" class="Data__Info_Label" value="<?php echo $data['ID_usuario'] ?>"></input>
                                </div>
                                <div class="Data__Info">
                                    <label for="" class="Data__Info_Label Data__Info_LabelE">Grupo:</label>
                                    <input id="Grupo" name="Grupo" type="number" class="Data__Info_Label" value="<?php echo $data['Grupo'] ?>" autocomplete="nope" autocomplete="off" onkeypress="return ((event.charCode >= 48 && event.charCode <= 57))" /></input>
                                </div>

                                <input id="MatriculaP" type="number" class="Data__Info_Label" value="<?php echo $data['ID_usuario'] ?>"></input>

                            </form>
                        </div>
                    </section>
                <?php

                } else if ($tipo == 'Editar-datos-servicio') {


                    $sql2 = "SELECT * FROM ssrp where Usuario='$user'";
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

                    <header class="Header">
                        <div class="Header_Containner_Img">
                            <img src="../assets/images/Atras.png" alt="Flecha" class="Img_Arrow" id="Btn_Arrow">
                        </div>
                        <h1 class="Header__Title" id="Header__Title">Editar datos de servicio.</h1>
                    </header>

                    <section class="Data">
                        <h2 class="Data__Title">Datos de servicio:</h2>
                        <div class="Box__Data">
                            <form action="" id="Form">
                                <div class="Data__Info">
                                    <label for="" class="Data__Info_Label Data__Info_LabelE">Tipo:</label>
                                    <select name="Servicio" id="Servicio" class="Data__Info_Label">
                                        <option <?php echo $data2["Tipo"] === 'Servicio social' ? "selected='selected'" : "" ?> value="Servicio social">Servicio social</option>
                                        <option <?php echo $data2["Tipo"] === 'Residencias profecionales' ? "selected='selected'" : "" ?> value="Residencias profecionales">Residencias profecionales</option>
                                    </select>
                                </div>

                                <div class="Data__Info">
                                    <label for="" class="Data__Info_Label Data__Info_LabelE">Estatus:</label>
                                    <select name="Estatus" id="Estatus" class="Data__Info_Label">
                                        <option <?php echo $data2["Estatus"] === 'Activo' ? "selected='selected'" : "" ?> value="Activo">Activo</option>
                                        <option <?php echo $data2["Estatus"] === 'Inactivo' ? "selected='selected'" : "" ?> value="Inactivo">Inactivo</option>
                                    </select>
                                </div>

                                <div class="Data__Info">
                                    <label for="" class="Data__Info_Label Data__Info_LabelE">Fecha de inicio:</label>
                                    <input name="Fecha de inicio" id="Fecha_I" type="date" class="Data__Info_Label" value="<?php echo $data2['F_inicio'] ?>"></input>
                                </div>
                                <div class="Data__Info">
                                    <label for="" class="Data__Info_Label Data__Info_LabelE">Fecha de termino:</label>
                                    <input id="Fecha_T" name="Fecha de termino" type="date" class="Data__Info_Label" value="<?php echo $data2['F_termino'] ?>"></input>
                                </div>

                                <div class="Data__Info">
                                    <label for="" class="Data__Info_Label Data__Info_LabelE">Proyecto:</label>
                                    <input id="Proyecto" name="Proyecto" class="Data__Info_Label" value="<?php echo $data2['Proyecto'] ?>"></input>
                                </div>
                                <?php
                                $consult = "SELECT ID_responsable, Nombre, A_paterno, A_materno FROM responsables";
                                $respuesta = mysqli_query($conexion, $consult);
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
                                    <input id="MatriculaP" type="number" class="Data__Info_Label" value="<?php echo $data['ID_usuario'] ?>"></input>
                            </form>
                        </div>
                    </section>

                <?php
                } else if ($tipo == 'Editar-datos-sesion') {
                ?>
                    <header class="Header">
                        <div class="Header_Containner_Img">
                            <img src="../assets/images/Atras.png" alt="Flecha" class="Img_Arrow" id="Btn_Arrow">
                        </div>
                        <h1 class="Header__Title" id="Header__Title">Editar contraseña.</h1>
                    </header>
                    <section class="Data">
                        <h2 class="Data__Title">Datos de sesión:</h2>
                        <div class="Box__Data">
                            <form action="" id="Form">
                                <div class="Data__Info">
                                    <label for="" class="Data__Info_Label Data__Info_LabelE">Nueva contraseña:</label>
                                    <input type="password" name="Contraseña" id="password" class="Data__Info_Label" autocomplete="nope" autocomplete="off"></input>
                                </div>
                                <div class="Data__Info">
                                    <label class="Data__Info_Label Data__Info_LabelE">Confirmar contraseña:</label>
                                    <input type="password" name="Confirmar contraseña" id="Password2" class="Data__Info_Label" autocomplete="nope" autocomplete="off"></input>
                                </div>
                                <input type="password" id="MatriculaP" type="text" class="Data__Info_Label" value="<?php echo $data['ID_usuario'] ?>"></input>
                            </form>
                        </div>
                    </section>


                <?php

                } //termina
                ?>


                <section class="Data Options">
                    <h2 class="Data__Title">Opciones:</h2>
                    <div class="Messaje_Send" id="Messaje_Send">
                        <h2 class="Messaje_Send_Title" id="Messaje_Send_Title">Enviando..</h2>
                    </div>
                    <div class="Container__Buttons">
                        <button class="Button__Option Button__Option-One" id="Messaje_Cancel_Title">Cancelar</button>
                        <button class="Button__Option Button__Option-Two" id="Button__Option-Send">Guardar</button>
                    </div>
                </section>

                <div class="Alert_Send" id="Alert_Send">
                    <h2 class="Alert_Send_Title" id="Alert_Send_Title">Error</h2>
                    <img src="../assets/images/cerrar.png" alt="Icono de cerrar" class="Img_cerrar" id="Btn_Error_cerrar">
                </div>
            <?php
            } else { //else si no encuentra usuario. consulta uno
            ?>
                <header class="Header">
                    <h1 class="Header__Title">Usuario no encontrado.</h1>
                    <div class="line"></div>
                </header>
                <div class="Img__error">
                    <img src="../assets/images/Usuario.png" alt="" class="Img__Get">
                </div>
            <?php
            }
        } else {

            ?>
            <header class="Header">
                <h1 class="Header__Title">No se encuantra una petición.</h1>
                <div class="line"></div>
            </header>
            <div class="Img__error">
                <img src="../assets/images/GET.png" alt="" class="Img__Get">
            </div>
        <?php
        }

        ?>


    <?php
}
    ?>

    </body>
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/recarga.js"></script>
    <script src="../js/EditarPerfil_P.js?see=1.14"></script>
    <script src="../sweetalert2/dist/sweetalert2.all.js"></script>

    </html>