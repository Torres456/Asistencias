<?php
session_start();
$varSesion = $_SESSION['User2']['id'];
if ($varSesion == '' || $varSesion == null) {
    header("location:Profile.php");
} else {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Visualización de perfil de usuario">
        <link rel="icon" href="../assets/images/IconCCAI.png">
        <link rel="stylesheet" href="../css/perfil.css?see=1.24">
        <title>Perfil</title>
    </head>
    <?php
    include '../BD/conexion.php';

    // $idUser = $_GET['Id'];

    $sql = "SELECT * FROM usuarios where ID_usuario='$varSesion'";
    $result = mysqli_query($conexion, $sql);
    $num_rows = mysqli_num_rows($result);
    ?>

    <body>
        <div class="centrado" id="onload">
            <img src="../assets/images/LoadingCCAI2.gif" alt="" class="Img__Loading">
        </div>
        <?php
        if ($num_rows) {
            $data = mysqli_fetch_array($result);
        ?>
            <header class="Header">
                <h2 class="Header__Title">Perfil personal</h2>
                <div class="line"></div>
            </header>
            <section class="Data">
                <div class="Data__Container_Options">
                    <h2 class="Data__Title">Datos personales:</h2>
                    <a class="Link__Edit" href="Edit_Profile.php?Tipo=Editar-datos-personales">Editar datos personales</a>
                </div>
                <div class="Box__Data">
                    <div class="Data__Info">
                        <label for="" class="Data__Info_Label Data__Info_LabelE">Nombre completo:</label>
                        <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo $data['Nombre'] ?> <?php echo $data['Apellido_p'] ?> <?php echo $data['Apellido_m'] ?></label>
                    </div>
                    <div class="Data__Info">
                        <label for="" class="Data__Info_Label Data__Info_LabelE">Edad:</label>
                        <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo $data['Edad'] ?></label>
                    </div>
                    <div class="Data__Info">
                        <label for="" class="Data__Info_Label Data__Info_LabelE">Número de celular:</label>
                        <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo $data['Numero_cel'] ?></label>
                    </div>
                    <div class="Data__Info">
                        <label for="" class="Data__Info_Label Data__Info_LabelE">Número de casa:</label>
                        <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo $data['Numero_cas'] ?></label>
                    </div>
                </div>
            </section>
            <section class="Data">
                <div class="Data__Container_Options">
                    <h2 class="Data__Title">Datos académicos:</h2>
                    <a class="Link__Edit" href="Edit_Profile.php?Tipo=Editar-datos-academicos">Editar datos académicos</a>
                </div>
                <div class="Box__Data">
                    <div class="Data__Info">
                        <label for="" class="Data__Info_Label Data__Info_LabelE">Tipo:</label>
                        <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo $data['TipoA'] ?></label>
                    </div>
                    <div class="Data__Info">
                        <label for="" class="Data__Info_Label Data__Info_LabelE">Matricula:</label>
                        <label for="" class="Data__Info_Label Data__Info_LabelA" id="Label_Matricula"><?php echo $data['ID_usuario'] ?></label>
                    </div>
                    <div class="Data__Info">
                        <label for="" class="Data__Info_Label Data__Info_LabelE">Carrera:</label>
                        <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo $data['Carrera'] ?></label>
                    </div>
                    <div class="Data__Info">
                        <label for="" class="Data__Info_Label Data__Info_LabelE">Grupo:</label>
                        <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo $data['Grupo'] ?></label>
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
                    <div class="Data__Container_Options">
                        <h2 class="Data__Title">Datos de servicio:</h2>
                        <a class="Link__Edit" href="Edit_Profile.php?Tipo=Editar-datos-servicio">Editar datos de servicio</a>
                    </div>

                    <div class="Box__Data">
                        <div class="Data__Info">
                            <label for="" class="Data__Info_Label Data__Info_LabelE">Tipo:</label>
                            <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo $data2['Tipo']; ?></label>
                        </div>
                        <div class="Data__Info">
                            <label for="" class="Data__Info_Label Data__Info_LabelE">Fecha de inicio:</label>
                            <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo $data2['F_inicio'] ?></label>
                        </div>
                        <div class="Data__Info">
                            <label for="" class="Data__Info_Label Data__Info_LabelE">Fecha de termino:</label>
                            <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo $data2['F_termino'] ?></label>
                        </div>
                        <div class="Data__Info">
                            <label for="" class="Data__Info_Label Data__Info_LabelE">Total de horas:</label>
                            <?php
                            $meta = 480;
                            $total = $data2['No_horas'];
                            $Horas = $total / 60;
                            $porcentaje = $Horas / $meta * 100;
                            ?>
                            <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo round($Horas, 2) ?> / 480 horas</label>
                        </div>
                        <div class="Data__Info">
                            <label for="" class="Data__Info_Label Data__Info_LabelE">Porcentaje:</label>
                            <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo round($porcentaje, 2) ?>%</label>
                        </div>
                        <div class="Data__Info">
                            <label for="" class="Data__Info_Label Data__Info_LabelE">Proyecto:</label>
                            <label for="" class="Data__Info_Label Data__Info_LabelA"><?php echo $data2['Proyecto'] ?></label>
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
                        </div>
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
                <div class="Data__Container_Options">
                    <h2 class="Data__Title">Datos de sesión:</h2>
                    <a class="Link__Edit" href="Edit_Profile.php?Tipo=Editar-datos-sesion">Editar datos de sesión</a>
                </div>
                    <div class="Data__Info">
                        <label for="" class="Data__Info_Label Data__Info_LabelE">Contraseña:</label>
                        <input type="password" class="Data__Info_Label Data__Info_Password" value="<?php echo $clave ?>" id="Input__Password">
                        <img src="../assets/images/visibility_off.png" alt="Icono de cerrar" class="Img_cerrar" id="Btn_Password">
                    </div>
                </section>

                <section class="Data">
                    <h2 class="Data__Title">Mis archivos:</h2>
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
                            <p>! El limite de tamaño de archivos es de 2 MB y solo se aceptan con formato= pdf, png, jpeg, jpg, txt, doc, docx ¡</p>
                        </form>
                    </div>
                </section>


                <div class="Box__Items" id="Box__Items">
                    <!-- <a href="#" class="btn_roundf" title="Imprimir" alt="impirmir"><i class="fa fa-print"></i></a> -->
                    <a href="#" class="Btn_Main" title="Opciones" alt="Opciones"><img src="../assets/images/options.png" alt="Icono de cerrar" class="fa fa-print" id="Btn_Error_cerrar"></a>
                    <a href="#" class="Box_One" title="Serrar sesión" alt="Serrar sesión" id="Button__Option_Three"><img src="../assets/images/logout.png" alt="Icono de cerrar" class="fa fa-print" id="Btn_Error_cerrar"></a>
                </div>
            <?php
            } else {
            }

            ?>
        <?php
        } else {
        ?>
            <div class="Alert">
                <h2 class="Alert__Title">Usuario no encontrado</h2>
            </div>
        <?php
        }
        ?>

        <div class="Alert_Send" id="Alert_Send">
            <h2 class="Alert_Send_Title" id="Alert_Send_Title">Error</h2>
            <img src="../assets/images/cerrar.png" alt="Icono de cerrar" class="Img_cerrar" id="Btn_Error_cerrarA">
        </div>
    </body>
    <script>
        function myFunction1() {
            $(location).attr('href', 'editarPerfil.php');
        }

        function myFunction2() {
            $(location).attr('href', 'editarPerfil.php');
        }
    </script>
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/perfil.js?see=1.5"></script>
    <script src="../js/Tabla_Archivos.js?see=1.11"></script>
    <script src="../sweetalert2/dist/sweetalert2.all.js"></script>

    </html>


<?php
}

?>