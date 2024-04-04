<?php
session_start();
$varSesion = $_SESSION["Id_Responsable"];
if ($varSesion == '' || $varSesion == null) {
    header("location:../login.php");
} else {

    include '../BD/conexion.php';
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../assets/images/IconCCAI.png">
        <link rel="stylesheet" href="../css/Barra.css?see=1.16">
        <link rel="stylesheet" href="../css/viewUser.css?see=1.34">
        <link rel="stylesheet" href="../css/Tabla.css?see=1.5">
        <title>Visualización de usuario</title>
    </head>
    
    <body>
        <?php
        require('../Global/Barra.php');
        ?>
        <div class="centrado" id="onload">
            <img src="../assets/images/LoadingCCAI2.gif" alt="" class="Img__Loading">
        </div>

        <main class="main" id="Usuarios">
            <?php
            if (isset($_GET['Usuario'])) {
                $idUser = $_GET['Usuario'];
                $sql = "SELECT * FROM usuarios where ID_usuario='$idUser'";
                $result = mysqli_query($conexion, $sql);
                $num_rows = mysqli_num_rows($result);
                if ($num_rows) {
                    $data = mysqli_fetch_array($result);
            ?>
                    <header class="Header">
                        <h1 class="Header__Title">Visualización de usuario.</h1>
                        <div class="line"></div>
                    </header>
                    <section class="Data">
                        <div class="Data__Container_Options">
                            <h2 class="Data__Title">Datos personales:</h2>
                            <a class="Link__Edit" href="Panel_Editar_Perfil.php?Tipo=Editar-datos-personales&Usuario=<?php echo $idUser; ?>">Editar datos personales</a>
                        </div>
                        <div class="Box__Data">
                            <div class="Data__Info">
                                <label for="" class="Data__Info_Label Data__Info_LabelE">Nombre completo:</label>
                                <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo $data['Nombre'] ?> <?php echo $data['Apellido_p'] ?> <?php echo $data['Apellido_m'] ?></label>
                                <div class="Data_Containner_Img">
                                    <img src="../assets/images/Flecha.png" alt="Flecha" class="Img_Arrow" id="Btn_Arrow">
                                </div>
                            </div>
                            <div class="Data__Info">
                                <label for="" class="Data__Info_Label Data__Info_LabelE">Edad:</label>
                                <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo $data['Edad'] ?></label>
                                <div class="Data_Containner_Img">
                                    <img src="../assets/images/Flecha.png" alt="Flecha" class="Img_Arrow" id="Btn_Arrow">
                                </div>
                            </div>
                            <div class="Data__Info">
                                <label for="" class="Data__Info_Label Data__Info_LabelE">Número de celular:</label>
                                <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo $data['Numero_cel'] ?></label>
                                <div class="Data_Containner_Img">
                                    <img src="../assets/images/Flecha.png" alt="Flecha" class="Img_Arrow" id="Btn_Arrow">
                                </div>
                            </div>
                            <div class="Data__Info">
                                <label for="" class="Data__Info_Label Data__Info_LabelE">Número de casa:</label>
                                <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo $data['Numero_cas'] ?></label>
                                <div class="Data_Containner_Img">
                                    <img src="../assets/images/Flecha.png" alt="Flecha" class="Img_Arrow" id="Btn_Arrow">
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="Data">
                        <div class="Data__Container_Options">
                            <h2 class="Data__Title">Datos academicos:</h2>
                            <a class="Link__Edit" href="Panel_Editar_Perfil.php?Tipo=Editar-datos-academicos&Usuario=<?php echo $idUser; ?>">Editar datos academicos</a>
                        </div>
                        <div class="Box__Data">
                            <div class="Data__Info">
                                <label for="" class="Data__Info_Label Data__Info_LabelE">Tipo:</label>
                                <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo $data['TipoA'] ?></label>
                                <div class="Data_Containner_Img">
                                    <img src="../assets/images/Flecha.png" alt="Flecha" class="Img_Arrow" id="Btn_Arrow">
                                </div>
                            </div>
                            <div class="Data__Info">
                                <label for="" class="Data__Info_Label Data__Info_LabelE">Matricula:</label>
                                <label for="" class="Data__Info_Label Data__Info_LabelA" id="Label_Matricula"><?php echo $data['ID_usuario'] ?></label>
                                <div class="Data_Containner_Img">
                                    <img src="../assets/images/Flecha.png" alt="Flecha" class="Img_Arrow" id="Btn_Arrow">
                                </div>
                            </div>
                            <div class="Data__Info">
                                <label for="" class="Data__Info_Label Data__Info_LabelE">Carrera:</label>
                                <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo $data['Carrera'] ?></label>
                                <div class="Data_Containner_Img">
                                    <img src="../assets/images/Flecha.png" alt="Flecha" class="Img_Arrow" id="Btn_Arrow">
                                </div>
                            </div>
                            <div class="Data__Info">
                                <label for="" class="Data__Info_Label Data__Info_LabelE">Grupo:</label>
                                <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo $data['Grupo'] ?></label>
                                <div class="Data_Containner_Img">
                                    <img src="../assets/images/Flecha.png" alt="Flecha" class="Img_Arrow" id="Btn_Arrow">
                                </div>
                            </div>
                        </div>
                    </section>

                    <?php
                    if ($data['Registro'] == "SSRP") {
                        $sql2 = "SELECT * FROM ssrp where Usuario='$idUser'";
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
                            <div class="Data__Container_Options">
                                <h2 class="Data__Title">Datos de servicio:</h2>
                                <a class="Link__Edit" href="Panel_Editar_Perfil.php?Tipo=Editar-datos-servicio&Usuario=<?php echo $idUser; ?>">Editar datos de servicio</a>
                            </div>
                            <div class="Box__Data">
                                <div class="Data__Info">
                                    <label for="" class="Data__Info_Label Data__Info_LabelE">Tipo:</label>
                                    <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo $data2['Tipo']; ?></label>
                                    <div class="Data_Containner_Img">
                                        <img src="../assets/images/Flecha.png" alt="Flecha" class="Img_Arrow" id="Btn_Arrow">
                                    </div>
                                </div>

                                <div class="Data__Info">
                                    <label for="" class="Data__Info_Label Data__Info_LabelE">Estatus:</label>
                                    <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo $data2['Estatus']; ?></label>
                                    <div class="Data_Containner_Img">
                                        <img src="../assets/images/Flecha.png" alt="Flecha" class="Img_Arrow" id="Btn_Arrow">
                                    </div>
                                </div>

                                <div class="Data__Info">
                                    <label for="" class="Data__Info_Label Data__Info_LabelE">Fecha de inicio:</label>
                                    <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo $data2['F_inicio'] ?></label>
                                    <div class="Data_Containner_Img">
                                        <img src="../assets/images/Flecha.png" alt="Flecha" class="Img_Arrow" id="Btn_Arrow">
                                    </div>
                                </div>
                                <div class="Data__Info">
                                    <label for="" class="Data__Info_Label Data__Info_LabelE">Fecha de termino:</label>
                                    <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo $data2['F_termino'] ?></label>
                                    <div class="Data_Containner_Img">
                                        <img src="../assets/images/Flecha.png" alt="Flecha" class="Img_Arrow" id="Btn_Arrow">
                                    </div>
                                </div>
                                <div class="Data__Info">
                                    <label for="" class="Data__Info_Label Data__Info_LabelE">Total de horas:</label>
                                    <?php
                                    $meta = 480;
                                    $total = $data2['No_horas'];
                                    $Horas = $total / 60;
                                    $porcentaje = $Horas / $meta * 100;
                                    ?>
                                    <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo round($Horas, 2) ?> de 480 horas</label>
                                </div>
                                <div class="Data__Info">
                                    <label for="" class="Data__Info_Label Data__Info_LabelE">Porcentaje:</label>
                                    <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo round($porcentaje, 2) ?>%</label>
                                </div>
                                <div class="Data__Info">
                                    <label for="" class="Data__Info_Label Data__Info_LabelE">Proyecto:</label>
                                    <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo $data2['Proyecto'] ?></label>
                                    <div class="Data_Containner_Img">
                                        <img src="../assets/images/Flecha.png" alt="Flecha" class="Img_Arrow" id="Btn_Arrow">
                                    </div>
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
                                    <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo $data3['Nombre'] ?> <?php echo $data3['A_paterno'] ?> <?php echo $data3['A_materno'] ?></label>
                                    <div class="Data_Containner_Img">
                                        <img src="../assets/images/Flecha.png" alt="Flecha" class="Img_Arrow" id="Btn_Arrow">
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="Data">
                            <div class="Data__Container_Options">
                                <h2 class="Data__Title">Agregar horas:</h2>
                            </div>
                            <div class="Messaje_Send" id="Messaje_Send2">
                                <h2 class="Messaje_Send_Title" id="Messaje_Send_Title">Enviando..</h2>
                            </div>
                            <div class="Data__InfoH">
                                <label for="" class="Data__Info_Label Data__Info_LabelH">Horas:</label>

                                <div class="Box__Hours">
                                    <select name="TipoI" id="TipoI" class="Form__Input Form__Select">
                                        <option value="Fecha">Fecha</option>
                                        <option value="HorasFecha">Horas + Fecha</option>
                                        <option value="Horas">Horas</option>
                                    </select>

                                    <div class="Option__Select SelectA" id="SelectA">
                                        <form action="" id="SelectAF">
                                        <label for="">Fecha:</label>
                                        <input type="Date" name="" id="FechaA" class="Time">
                                        <label for="">No.horas:</label>
                                        <input type="number" name="" id="HorasA" class="Time" min="0" max="60" onkeypress="return ((event.charCode >= 48 && event.charCode <= 57))" />
                                        <label for="">No.minutos:</label>
                                        <input type="number" name="" id="MinutosA" class="Time" min="0" max="60" onkeypress="return ((event.charCode >= 48 && event.charCode <= 57))" />
                                        </form>
                                    </div>

                                    <div class="Option__Select SelectB" id="SelectB">
                                    <form action="" id="SelectBF">
                                        <label for="">Fecha:</label>
                                        <input type="Date" name="" id="FechaB" class="Time">
                                        <div class="Select__Time">
                                            <div class="Time__Box">
                                            <label for="">Hora de entrada:</label>
                                            <input type="number" name="" id="HoraB" class="Time" min="0" max="60" onkeypress="return ((event.charCode >= 48 && event.charCode <= 57))" />
                                            <label for="">Minutos:</label>
                                            <input type="number" name="" id="MinutoB" class="Time" min="0" max="60" onkeypress="return ((event.charCode >= 48 && event.charCode <= 57))" />
                                            <select name="" id="TipoB" class="Form__Select">
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                            </div>
                                            <div class="Time__Box">
                                            <label for="">Hora de salida:</label>
                                            <input type="number" name="" id="HoraB2" class="Time" min="0" max="60" onkeypress="return ((event.charCode >= 48 && event.charCode <= 57))" />
                                            <label for="">Minutos:</label>
                                            <input type="number" name="" id="MinutosB2" class="Time" min="0" max="60" onkeypress="return ((event.charCode >= 48 && event.charCode <= 57))" />
                                            <select name="TipoI" id="TipoB2" class="Form__Select">
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                            </div>
                                        </div>
                                    </form>
                                    </div>

                                    <div class="Option__Select SelectC" id="SelectC">
                                    <form action="" id="SelectCF">
                                        <label for="">No.horas:</label>
                                        <input type="number" name="" id="HorasC" class="Time" min="0" max="60">
                                        <label for="">No.minutos:</label>
                                        <input type="number" name="" id="MinutosC" class="Time" min="0" max="60">
                                    </form>
                                    </div>
                                </div>
                                <button class="Button__Option-H" id="Button__Time">Agregar</button>
                            </div>
                        </section>


                        <section class="Data">
                            <div class="Data__Container_Options">
                                <h2 class="Data__Title">Eliminar horas:</h2>
                            </div>
                            <div class="Messaje_Send" id="Messaje_Send3">
                                <h2 class="Messaje_Send_Title" id="Messaje_Send_Title">Enviando..</h2>
                            </div>
                            <div class="Data__InfoH">
                                <label for="" class="Data__Info_Label Data__Info_LabelH">Horas:</label>
                                <div class="Box__Hours">
                                    <label for="">No.horas:</label>
                                    <input type="number" name="" id="HorasT" class="Time" min="0" max="60" onkeypress="return ((event.charCode >= 48 && event.charCode <= 57))" />
                                    <label for="">No.minutos:</label>
                                    <input type="number" name="" id="MinutosT" class="Time" min="0" max="60" onkeypress="return ((event.charCode >= 48 && event.charCode <= 57))" />
                                    <label for="" class="Title__Search">Fecha:</label>
                                    <input type="Date" class="Date__Search" id="DateT" name="Fecha">

                                    <div class="Data_TextArea">
                                    <label for="Observaciones" class="Title__Observaciones">Observaciones:</label>
                                     <input type="text" class="Observaciones__Text" id="ObservacionT" name="Observacion" min="0" max="250">
                                </div>

                                </div>
                                <button class="Button__Option-H" id="Button__TimeB">Eliminar</button>
                            </div>
                        </section>

                        <?php
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

                        $consult = "SELECT * FROM usuariosssrp WHERE ID_usuario='$idUser'";
                        $result4 = mysqli_query($conexion, $consult);
                        $num_rows3 = mysqli_num_rows($result4);
                        if ($num_rows3) {
                            $data4 = mysqli_fetch_array($result4);

                            $clave = desifrar($data4['Contrasena']);
                        } else {
                            $data4 = array(
                                "Contrasena" => "Sin datos",
                            );
                            $clave = $data4['Contrasena'];
                        }
                        ?>
                        <section class="Data">
                            <div class="Data__Container_Options">
                                <h2 class="Data__Title">Datos de seción:</h2>
                                <a class="Link__Edit" href="Panel_Editar_Perfil.php?Tipo=Editar-datos-sesion&Usuario=<?php echo $idUser; ?>">Editar datos de seción</a>
                            </div>
                            <div class="Data__Info">
                                <label for="" class="Data__Info_Label Data__Info_LabelE">Contraseña:</label>
                                <input type="password" class="Data__Info_Label Data__Info_Password" value="<?php echo $clave ?>" id="Input__Password">
                                <img src="../assets/images/visibility_off.png" alt="Icono de cerrar" class="Img_cerrar" id="Btn_Password">
                            </div>
                        </section>
                        <section class="Data">
                            <h2 class="Data__Title">Archivos:</h2>
                            <div class="datosDb" id="datos">
                            </div>
                        </section>
                        <section class="Data">
                            <h2 class="Data__Title">Subir archivos:</h2>
                            <div class="container-input">
                                <form id="FormFile" enctype="multipart/form-data">
                                    <input type="file" name="file-5" id="file-5" class="inputfile inputfile-5">
                                    <label for="file-5">
                                        <figure>
                                            <svg class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17">
                                                <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path>
                                            </svg>
                                        </figure>
                                        <span id="span" class="iborrainputfile">Seleccionar archivo</span>
                                    </label>
                                    <div class="Form__Group" id="Group__Descripción">
                                        <label for="Descripción" class="Form__label">Descripción:</label>
                                        <div class="Form__Group-input">
                                            <input type="text" class="Form__Input" name="Descripcion" id="Descripcion" placeholder="Descripción" autocomplete="nope" />
                                            <input type="text" class="Form__Input Input__None" name="Usuario" id="Usuario" value="<?php echo $data['ID_usuario'] ?>">
                                        </div>
                                    </div>
                                    <input type="submit" value="Registrar" class="Button__File" id="Button__Entrada">
                                    <p>! El limite de tamaño de archivos es de 2MB y solo se aceptan con formato= pdf, png, jpeg, jpg, txt, doc, docx ¡</p>
                                </form>
                            </div>
                        </section>
                        <!-- user not ssrp -->
                    <?php
                    } else {
                    }
                    ?>
                    <section class="Data">
                        <h2 class="Data__Title">Historial de asistencias:</h2>
                        <form action="../PDF/pdfAsistencias.php" target="_blank">
                            <div class="Box_Dates">
                                <div class="Dates__Search">
                                    <label for="" class="Title__Search">Fecha inicio:</label>
                                    <input type="Date" class="Date__Search" id="DateA" name="Fecha_Inicio">
                                </div>
                                <div class="Dates__Search">
                                    <label for="" class="Title__Search">Fecha termino:</label>
                                    <input type="Date" class="Date__Search" id="DateB" name="Fecha_Termino">
                                </div>
                                <div class="Dates__Search">
                                    <label for="Servicio" class="Title__Search">Asistencia:</label>
                                    <select name="Asistencia" id="Asistencia" class="Dates__Select">
                                        <option value="0">Todos</option>
                                        <option value="1">Con salida</option>
                                        <option value="2">Sin salida</option>
                                    </select>
                                </div>
                            </div>
                            <div class="DatosDb" id="DatosF">
                            </div>
                            <input type="hidden" name="Matricula" value="<?php echo $data['ID_usuario'] ?>"></input>

                            <input type="submit" value="Generar reporte de asistencia" class="Button_Pdf">
                        </form>
                    </section>

                    <section class="Data">
                        <h2 class="Data__Title">Historial de sanciones:</h2>
                        <div class="Box_Dates">
                                <!-- <div class="Dates__Search">
                                    <label for="" class="Title__Search">Fecha inicio:</label>
                                    <input type="Date" class="Date__Search" id="DateAS" name="Fecha_Inicio">
                                </div>
                                <div class="Dates__Search">
                                    <label for="" class="Title__Search">Fecha termino:</label>
                                    <input type="Date" class="Date__Search" id="DateBS" name="Fecha_Termino">
                                </div> -->
                            </div>
                        <div class="DatosDb" id="DatosS">
                    </section>



                    <section class="Data Options">
                        <h2 class="Data__Title">Opciones:</h2>
                        <div class="Messaje_Send" id="Messaje_Send">
                            <h2 class="Messaje_Send_Title" id="Messaje_Send_Title">Enviando..</h2>
                        </div>
                        <div class="Container__Buttons">
                            <button class="Button__Option Button__Option-One" id="Button__Delete">Eliminar perfil</button>
                        </div>
                    </section>
                    <!-- user not found -->
                <?php
                } else {
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
                ?>
            <?php
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
        </main>
        <div class="Alert_Send" id="Alert_Send">
            <h2 class="Alert_Send_Title" id="Alert_Send_Title">Error</h2>
            <img src="../assets/images/cerrar.png" alt="Icono de cerrar" class="Img_cerrar" id="Btn_Error_cerrarA">
        </div>
        <div class="Box__Items" id="Box__Items">
            <div class="Box_Two" title="Serrar sesión" alt="Serrar sesión" id="Button__Option_Two"><img src="../assets/images/logout.png" alt="Icono de cerrar" class="fa fa-print" id="Btn_Error_cerrar"></div>
            <div class="Btn_Main" title="Opciones" alt="Opciones"><img src="../assets/images/options.png" alt="Icono de cerrar" class="fa fa-print" id="Btn_Error_cerrar"></div>
            <div class="Box_One" title="Regresar" alt="Regresar" id="Button__Option_One"><img src="../assets/images/AtrasO.png" alt="Icono de cerrar" class="fa fa-print" id="Btn_Error_cerrar"></div>
        </div>
    </body>
    <script src="../js/Barra.js?see=1.4"></script>
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/Tabla_Archivos2.js?see=1.5"></script>
    <script src="../js/userView.js?see=1.45"></script>
    <script src="../js/Tabla_Fechas.js?see=1.10"></script>
    <script src="../sweetalert2/dist/sweetalert2.all.js"></script>

    </html>
    <!-- Session     -->
<?php

}
?>