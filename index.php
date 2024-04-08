<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de asistencias para la Industria 4.0">
    <link rel="stylesheet" href="css/index.css?see=1.17">
    <link rel="icon" href="assets/images/IconCCAI.png">
    <title>Asistencias</title>
</head>
<?php 
include "BD/conexion.php";
$consult = "SELECT ID_responsable, Nombre, A_paterno FROM responsables";
$respuesta = mysqli_query($conexion, $consult);

$consult2 = "SELECT COUNT(ID_asistencia) AS Total FROM asistencia where Fecha=CURDATE() AND No_horas='0'";
$respuesta2 = mysqli_query($conexion, $consult2);

$Total = mysqli_fetch_array($respuesta2);

?>

<body class="hidden">
    <div class="centrado" id="onload">
        <img src="assets/images/LoadingCCAI2.gif" alt="" class="Img__Loading">
    </div>

    <header class="Header">
        <h1 class="Header__Title">Industria 4.0</h1>
        <button type="button" class="Header__Button" onclick="myFunction3()">Acceso profesores</button>
    </header>

    <div class="Container__Fetch">
        <h2 class="Container__Fetch__Date" id="txtDate">19-ENERO-2023</h2>
        <h2 class="Container__Fetch__Title" id="txtClock">23:34:00</h2>
    </div>

    <div class="Container_Boxes">
        <div class="Container__Info">
            <div class="Container__Info__Title">
                <h2 class="Container__Info__Title">Control de asistencia</h2>
            </div>

            <div class="Carrucel">
                <div class="Box_Carrucel" id="Box_Carrucel">
                    <div class="Boxes_Carrucel Box_One">
                    <h2 class="Boxes__Title">Registro de entrada</h2>
                        <form id="Form_One">

                            <div class="Form__Group" id="Group__Matricula">
                                <div class="Form__Group-input">
                                    <input type="text" class="Form__Input" name="Matricula" id="Matricula" required="" autocomplete="nope" />
                                    <label for="Matricula">Matricula:</label>
                                </div>
                                <p class="Form__Input-Error"></p>
                            </div>


                            <div class="Form__Group" id="Group__Equipo">
                                <div class="Form__Group-input">
                                    <input type="number" class="Form__Input" name="Equipo" id="Equipo"required="" autocomplete="nope" />
                                    <label for="Equipo">No.Equipo:</label>
                                </div>
                                <p class="Form__Input-Error"></p>
                            </div>

                            <div class="Form__Group" id="Group__Observaciones">
                                <div class="Form__Group-input">
                                    <input type="text" class="Form__Input" name="Observaciones" id="Observaciones" required="" autocomplete="nope" />
                                    <label for="Observaciones">Recurso/Observaciones:</label>
                                </div>
                                <p class="Form__Input-Error"></p>
                            </div>

                            <div class="Form__Group" id="Group__Responsable">
                                <select name="Responsable" id="Responsable" class="Form__Select">
                                    <option value="0">Seleccione Responsable</option>
                                    <?php
                                    while ($Users = mysqli_fetch_array($respuesta)) {
                                    ?>
                                        <option value="<?php echo $Users['ID_responsable'] ?>"> <?php echo $Users['Nombre'] ?> <?php echo $Users['A_paterno'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="Container__Button">
                                <input type="submit" value="Registrar" class="Button__Box_One" id="Button__Entrada">
                                <button class="Button_Move  Button__Salida" id="Button__SalidaM">Registrar Salida</button>
                            </div>
                        </form>
                        <div class="Messaje_Send" id="Messaje_Send">
                            <h2 class="Messaje_Send_Title" id="Messaje_Send_Title">Enviando..</h2>
                        </div>

                        
                    </div>

                    <div class="Boxes_Carrucel Box_Two">
                        <h2 class="Boxes__Title">Registro de salida</h2>
                        <form action="" id="Form_Two">

                            <div class="Form__Group" id="Group__MatriculaS">
                                <div class="Form__Group-input">
                                    <input type="text" class="Form__Input" name="MatriculaS" id="MatriculaS" required="" autocomplete="nope" />
                                <label for="MatriculaS" >Matricula: </label>
                                </div>
                                <p class="Form__Input-Error"></p>
                            </div>
                            <div class="Container__Button">
                                <input type="submit" value="Registrar" class="Button__Box_One" id="Button__Salida">
                                <button class="Button_Move  Button__Entrada" id="Button__EntradaM">Registrar Salida</button>
                            </div>
                        </form>

                        <div class="Messaje_Send2" id="Messaje_Send2">
                            <h2 class="Messaje_Send_Title" id="Messaje_Send_Title2"></h2>
                        </div>


                    </div>

                </div>
            </div>
        </div>
        <div class="Container__Table">
            <h2 class="Container__Table__Title">Registros de asistencia del dia de hoy: <?php echo $Total['Total'] ?></h2>
            <div class="datosDb" id="datos">
            </div>
        </div>
    </div>

    <!-- Alert---- -->
    <div class="Alert_Send" id="Alert_Send">
        <h2 class="Alert_Send_Title" id="Alert_Send_Title"></h2>
        <img src="assets/images/cerrar.png" alt="Icono de cerrar" class="Img_cerrar" id="Btn_Error_cerrar">
    </div>

    <footer class="Fotter">
        <button class="Button__Footer" id="Button__Footer1" onclick="myFunction2()">Registro de usuarios invitados</button>
        <button class="Button__Footer" id="Button__Footer1" onclick="myFunction()">Registro de servicio social y Residencias</button>
        <button class="Button__Footer" id="Button__Footer1" onclick="myFunction4()">Visualizar mi perfil</button>
    </footer>


</body>
<script>
    function myFunction() {

        $(location).attr('href', 'RegistroSSRP.php');
    }

    function myFunction2() {

        $(location).attr('href', 'Invitados.php');
    }

    function myFunction3() {

        $(location).attr('href', 'panel/login.php');
    }

    function myFunction4() {

        $(location).attr('href', '  Perfil/Student_System.php');
    }

</script>
<script src="js/index.js?see=1.8"></script>
<script src="js/clock.js"></script>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/Tabla_Asistencias.js?see=1.2"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</html>