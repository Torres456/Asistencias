<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Registro de usuarios invitados">
    <link rel="icon" href="assets/images/IconCCAI.png">
    <link rel="stylesheet" href="css/Invitados.css?see=1.5">
    <title>Registro de usuarios invitados</title>
</head>
<?php
include "BD/conexion.php";
$consult = "SELECT ID_responsable, Nombre, A_paterno FROM responsables";
$respuesta = mysqli_query($conexion, $consult);
?>

<body class="hidden">
    <div class="centrado" id="onload">
        <img src="assets/images/LoadingCCAI2.gif" alt="" class="Img__Loading">
    </div>

    <header class="Header">
        <h1 class="Header__Title">Registro de usuarios invitados.</h1>
        <div class="line"></div>
    </header>

    <section class="Shipment">
        <div class="Shipment__Container__Form">
            <form action="" class="Form" id="Form" autocomplete="nope">

                <div class="Form__Group" id="Group__Tipo">
                    <label for="Tipo" class="Form__label">Tipo:</label>
                    <select name="Tipo" id="Tipo" class="Form__Input">
                        <option value="0">Seleccione</option>
                        <option value="Alumno">Alumno</option>
                        <option value="Profesor">Profesor</option>
                        <option value="Empleado-TESI">Empleado-TESI</option>
                        <option value="Externo">Externo</option>
                    </select>
                </div>

                <div class="Form__Group" id="Group__Matricula">
                    <label for="Matricula" class="Form__label">Matrícula:</label>
                    <div class="Form__Group-input">
                        <input type="text" class="Form__Input" name="Matricula" id="Matricula" placeholder="Matricula" minlength="4" maxlength="10" autocomplete="nope" />
                    </div>
                    <p class="Form__Input-Error">Este campo <strong>no puede estar vacio </strong> y solo puede llevar letras, números, guion y guion_bajo.</p>
                </div>

                <div class="Form__Group" id="Group__Nombre">
                    <label for="Nombre" class="Form__label">Nombre(s):</label>
                    <div class="Form__Group-input">
                        <input type="text" class="Form__Input" name="Nombre" id="Nombre" placeholder="Nombre" minlength="1" maxlength="100" autocomplete="nope" />
                    </div>
                    <p class="Form__Input-Error">Este campo<strong> no puede estar vacio </strong> y solo puede llevar letras, espacios y acentos.</p>
                </div>

                <div class="Form__Group" id="Group__ApellidoP">
                    <label for="ApellidoP" class="Form__label">Apellido Paterno:</label>
                    <div class="Form__Group-input">
                        <input type="text" class="Form__Input" name="ApellidoP" id="ApellidoP" placeholder="Apellido Paterno" minlength="1" maxlength="100" autocomplete="nope" />
                    </div>
                    <p class="Form__Input-Error">Este campo<strong> no puede estar vacio </strong> y solo puede llevar letras, espacios y acentos.</p>
                </div>



                <div class="Form__Group" id="Group__ApellidoM">
                    <label for="ApellidoM" class="Form__label">Apellido Materno:</label>
                    <div class="Form__Group-input">
                        <input type="text" class="Form__Input" name="ApellidoM" id="ApellidoM" placeholder="Apellido materno" minlength="1" maxlength="100" autocomplete="nope" />
                    </div>
                    <p class="Form__Input-Error">Este campo<strong> no puede estar vacio </strong> y solo puede llevar letras, espacios y acentos.</p>
                </div>

                <div class="Form__Group" id="Group__Edad">
                    <label for="Edad" class="Form__label">Edad:</label>
                    <div class="Form__Group-input">
                        <input type="number" class="Form__Input" name="Edad" id="Edad" placeholder="Edad" min="10" max="100" autocomplete="nope" />
                    </div>
                    <p class="Form__Input-Error">Este campo<strong> no puede estar vacio </strong> y solo puede llevar números.</p>
                </div>

                <div class="Form__Group" id="Group__Sexo">
                    <label for="Sexo" class="Form__label">Genero:</label>
                    <select name="Genero" id="Genero" class="Form__Input Form__Select">
                        <option value="0">Seleccione</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select>
                </div>

                <div class="Form__Group" id="Group__Carrera">
                    <label for="Carrera" class="Form__label">Carrera:</label>
                    <select name="Carrera" id="Carrera" class="Form__Input Form__Select">
                        <option value="0">Seleccione</option>
                        <option value="Ingeniería en Sistemas Computacionales">Ingeniería en Sistemas Computacionales</option>
                        <option value="Ingeniería Ambiental">Ingeniería Ambiental</option>
                        <option value="Ingeniería Biomédica">Ingeniería Biomédica</option>
                        <option value="Ingeniería Informática">Ingeniería Informática</option>
                        <option value="Ingeniería Electrónica">Ingeniería Electrónica</option>
                        <option value="Licenciatura en Administración">Licenciatura en Administración</option>
                        <option value="Arquitectura">Arquitectura</option>
                        <option value="Maestria en Administración">Maestria en Administración</option>
                        <option value="Sin carrera">Sin carrera</option>
                    </select>
                </div>

                <div class="Form__Group" id="Group__Proyecto">
                    <label for="Proyecto" class="Form__label">Proyecto:</label>
                    <div class="Form__Group-input">
                        <input type="text" class="Form__Input" name="Proyecto" id="Proyecto" placeholder="Proyecto" minlength="1" maxlength="300" autocomplete="nope" />
                    </div>
                    <p class="Form__Input-Error">Este campo<strong> no puede estar vacio </strong> y solo puede llevar letras, espacios números acentos guion y guion bajo.</p>
                </div>

                <div class="Form__Group" id="Group__Equipo">
                    <label for="Equipo" class="Form__label">No.Equipo:</label>
                    <div class="Form__Group-input">
                        <input type="number" class="Form__Input" name="Equipo" id="Equipo" placeholder="Equipo" min="10" max="100" autocomplete="nope" />
                    </div>
                    <p class="Form__Input-Error">Este campo <strong>no puede estar vacio y solo puede contener números</strong></p>
                </div>


                <div class="Form__Group" id="Group__Observaciones">
                    <label for="Observaciones" class="Form__label">Recurso utilizado/Observaciones:</label>
                    <div class="Form__Group-input">
                        <input type="text" class="Form__Input" name="Observaciones" id="Observaciones" placeholder="Observaciones" minlength="1" maxlength="300" autocomplete="nope" />
                    </div>
                    <p class="Form__Input-Error">Este campo no puede estar vacio<strong> y solo puede contener letras, números, espacios, guion y guion_bajo.</strong></p>
                </div>


                <div class="Form__Group" id="Group__Responsable">
                    <label for="Responsable" class="Form__label">Responsable:</label>
                    <div class="Form__Group-input">
                        <select name="Responsable" id="Responsable" class="Form__Input Form__Select">
                            <option value="0">Seleccione</option>
                            <?php
                            while ($Users = mysqli_fetch_array($respuesta)) {
                            ?>
                                <option value="<?php echo $Users['ID_responsable'] ?>"> <?php echo $Users['Nombre'] ?> <?php echo $Users['A_paterno'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <p class="Form__Input-Error">Este campo<strong> no puede estar vacio </strong> y solo puede llevar letras, espacios y acentos.</p>
                </div>

            </form>
        </div>

        <div class="Shipment__send">
            <div class="Shipment__Send__Button">
                <input type="submit" value="Enviar" class="Send__Button" id="Button__Send">
                <div class="Messaje_Send" id="Messaje_Send">
                    <h2 class="Messaje_Send_Title" id="Messaje_Send_Title"></h2>
                </div>
            </div>
            <div class="Shipment__Send__Requeriments">
                <p class="Shipment__Send__Requeriments__Title">Información obligatoria:</p>
                <div class="Container__Requeriments">
                    <p class="Requeriments__Shipment" id="Chart__Tipo">Tipo.</p>
                    <p class="Requeriments__Shipment" id="Chart__Matricula">Matricula.</p>
                    <p class="Requeriments__Shipment" id="Chart__Nombre">Nombre.</p>
                    <p class="Requeriments__Shipment" id="Chart__ApellidoP">Apellido paterno.</p>
                    <p class="Requeriments__Shipment" id="Chart__ApellidoM">Apellido materno.</p>
                    <p class="Requeriments__Shipment" id="Chart__Edad">Edad.</p>
                    <p class="Requeriments__Shipment" id="Chart__Genero">Genero.</p>
                    <p class="Requeriments__Shipment" id="Chart__Carrera">Carrera.</p>
                    <p class="Requeriments__Shipment" id="Chart__Proyecto">Proyecto.</p>
                    <p class="Requeriments__Shipment" id="Chart__Equipo">Equipo.</p>
                    <p class="Requeriments__Shipment" id="Chart__Observaciones">Observaciones.</p>
                    <p class="Requeriments__Shipment" id="Chart__Responsable">Responsable.</p>
                </div>
            </div>

            <div class="Video">
                <video id="theVideo" autoplay></video>
                <canvas id="theCanvas"></canvas>
            </div>


        </div>
    </section>

    <div class="Alert_Send" id="Alert_Send">
        <h2 class="Alert_Send_Title" id="Alert_Send_Title">Error</h2>
        <img src="assets/images/cerrar.png" alt="Icono de cerrar" class="Img_cerrar" id="Btn_Error_cerrar">
    </div>

</body>

<script src="js/Invitados.js?see=1.8"></script>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</html>