<?php
session_start();
$varSesion = $_SESSION["Id_Responsable"];
if ($varSesion == '' || $varSesion == null) {
    header("location:login.php");
} else {

    include '../BD/conexion.php';
    // Datos Cuadro-1
    $sql = "SELECT COUNT(*) AS Asistencias FROM asistencia INNER JOIN ssrp ON asistencia.Usuario = ssrp.Usuario WHERE asistencia.Fecha=CURDATE() AND asistencia.No_horas='0' AND ssrp.Responsable='$varSesion'";

    $result = mysqli_query($conexion, $sql);
    $data = mysqli_fetch_array($result);
    // Datos Cuadro-3
    $sql2 = "SELECT COUNT(*) AS Registros FROM ssrp WHERE Responsable='$varSesion' AND Estatus='Activo'";
    $result2 = mysqli_query($conexion, $sql2);
    $data2 = mysqli_fetch_array($result2);
    // Datos Cuadro-2
    $num1 = $data2['Registros'];
    $num2 = $data['Asistencias'];
    $flatas = $num1 - $num2;
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Panel de control">
        <link rel="icon" href="../assets/images/IconCCAI.png">
        <link rel="stylesheet" href="../css/Barra.css?see=1.17">
        <link rel="stylesheet" href="../css/panel.css?see=1.10">
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <title>Panel</title>
    </head>

    <body class="hidden">

        <div>
        <?php
    }
    require('../Global/Barra.php');
        ?>
        <div class="centrado" id="onload">
            <img src="../assets/images/LoadingCCAI2.gif" alt="" class="Img__Loading">
        </div>

        </div>
        <main class="main" id="Inicio">

            <section class="Info">
                <div class="Info__Box">
                    <div class="Info__Container_Boxes">
                        <div class="Info__Box_Container">
                            <h2 class="Box__Num"><?php echo $data['Asistencias'] ?></h2>
                            <p class="Box__Description">Asistencias del día de hoy</p>
                        </div>
                        <div class="Info__Box_Image">
                            <img src="../assets/images/users.png" alt="" class="Image__Box">
                        </div>
                    </div>
                    <p class="Box_Option">-</p>
                </div>

                <div class="Info__Box Box_Two">
                    <div class="Info__Container_Boxes">
                        <div class="Info__Box_Container">
                            <h2 class="Box__Num"><?php echo $flatas ?></h2>
                            <p class="Box__Description">Faltas del día de hoy</p>
                        </div>
                        <div class="Info__Box_Image">
                            <img src="../assets/images/faltas.png" alt="" class="Image__Box">
                        </div>
                    </div>
                    <p class="Box_Option Box_Option_Two">-</p>
                </div>

                <div class="Info__Box Box_Three">
                    <div class="Info__Container_Boxes">
                        <div class="Info__Box_Container">
                            <h2 class="Box__Num"><?php echo $data2['Registros'] ?></h2>
                            <p class="Box__Description">Número de usuarios</p>
                        </div>
                        <div class="Info__Box_Image">
                            <img src="../assets/images/registros.png" alt="" class="Image__Box">
                        </div>
                    </div>
                    <p class="Box_Option Box_Option_Three">Más información:</p>
                </div>


                </div>
            </section>

            <section class="Table">
                <h2 class="Table__Title">Tabla asistencias</h2>
                <div class="Table__Option">
                    <div class="Table__Search Option__Box">
                        <label for="" class="Title__Search">Buscar:</label>
                        <input type="text" class="Table__Search" id="Consulta">
                    </div>

                    <div class="Table__Select Option__Box">
                        <label for="Servicio" class="Form__label">Tipo de servicio:</label>
                        <select name="Servicio" id="Servicio" class="Table__Select">
                            <option value="0">Todos</option>
                            <option value="1">Servicio social</option>
                            <option value="2">Residencias profecionales</option>
                        </select>
                    </div>
                </div>

                <div class="DatosDb" id="Datos">
                </div>
            </section>
        </main>

    </body>
    <!-- //Panel -->
    <script src="../js/Barra.js?see=1.5"></script>
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/Tabla_panelA.js?see=1.8"></script>
    <script src="../js/recarga.js"></script>
    <script src="../sweetalert2/dist/sweetalert2.all.js"></script>
    </html>