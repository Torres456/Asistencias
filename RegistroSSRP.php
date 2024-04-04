<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Registro de servicio social y residencias profecionales para la seccion de Industria-4.0">
    <link rel="stylesheet" href="css/RegistroSSRP.CSS?see=1.12">
    <link rel="icon" href="assets/images/IconCCAI.png">
    <title>Registro de servicio social y residencias profecionales</title>
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
        <h1 class="Header__Title">Registro de Servicio Social y Residencias Profecionales.</h1>
        <div class="line"></div>
    </header>
    <section class="Shipment">
        <div class="Shipment__Container__Form">
            <form action="" class="Form" id="Form">

                <div class="Form__Group" id="Group__TipoU">
                    <label for="TipoU" class="Form__label">Tipo de usuario:</label>
                    <select name="TipoU" id="TipoU" class="Form__Input Form__Select">
                        <option value="0">Seleccione</option>
                        <option value="Alumno" selected>Alumno</option>
                        <option value="Alumno_externo">Alumno externo.</option>
                    </select>
                </div>

                <div class="Form__Group" id="Group__Matricula">
                    <label for="Matricula" class="Form__label">Matricula:</label>
                    <div class="Form__Group-input">
                        <input type="text" class="Form__Input" name="Matricula" id="Matricula" placeholder="Matricula" autocomplete="nope" />
                    </div>
                    <p class="Form__Input-error">Este campo<strong> no puede estar vacío </strong> y solo puede llevar letras, espacios y acentos.</p>
                </div>

                <div class="Form__Group" id="Group__Contraseña">
                    <label for="Contraseña" class="Form__label">Contraseña:</label>
                    <div class="Form__Group-input">
                        <input type="password" class="Form__Input" name="Contraseña" id="Contraseña" placeholder="Contraseña" autocomplete="nope" />
                    </div>
                    <p class="Form__Input-error">Este campo<strong> no puede estar vacío </strong> y debe tener de 4 a 12 digitos.</p>
                </div>

                <div class="Form__Group" id="Group__Contraseña_2">
                    <label for="Contraseña_2" class="Form__label">Confirmar contraseña:</label>
                    <div class="Form__Group-input">
                        <input type="password" class="Form__Input" name="Contraseña_2" id="Contraseña_2" placeholder="Confirmar contraseña" autocomplete="nope" />
                    </div>
                    <p class="Form__Input-error">Este campo<strong> no puede estar vacío </strong> y debe tener de 4 a 12 digitos.</p>
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

                <div class="Form__Group" id="Group__Grupo">
                    <label for="Grupo" class="Form__label">Grupo:</label>
                    <div class="Form__Group-input">
                        <input type="text" class="Form__Input" name="Grupo" id="Grupo" placeholder="Grupo" autocomplete="nope" />
                    </div>
                    <p class="Form__Input-error">Este campo<strong> no puede estar vacío </strong> y solo puede llevar letras, números, espacios, guion y guion_bajo.</p>
                </div>

                <div class="Form__Group" id="Group__Servicio">
                    <label for="Servicio" class="Form__label">Tipo de servicio:</label>
                    <select name="Servicio" id="Servicio" class="Form__Input Form__Select">
                        <option value="0">Seleccione</option>
                        <option value="Servicio social">Servicio social</option>
                        <option value="Residencias profecionales">Residencias profecionales</option>
                    </select>
                </div>

                <div class="Form__Group" id="Group__Nombre">
                    <label for="Nombre" class="Form__label">Nombre(s):</label>
                    <div class="Form__Group-input">
                        <input type="text" class="Form__Input" name="Nombre" id="Nombre" placeholder="Nombre" autocomplete="nope" />
                    </div>
                    <p class="Form__Input-error">Este campo<strong> no puede estar vacío </strong> y solo puede llevar letras, espacios y acentos.</p>
                </div>

                <div class="Form__Group" id="Group__ApellidoP">
                    <label for="ApellidoP" class="Form__label">Apellido Paterno:</label>
                    <div class="Form__Group-input">
                        <input type="text" class="Form__Input" name="ApellidoP" id="ApellidoP" placeholder="Apellido Paterno" autocomplete="nope" />
                    </div>
                    <p class="Form__Input-error">Este campo<strong> no puede estar vacío </strong> y solo puede llevar letras, espacios y acentos.</p>
                </div>

                <div class="Form__Group" id="Group__ApellidoM">
                    <label for="ApellidoM" class="Form__label">Apellido Materno:</label>
                    <div class="Form__Group-input">
                        <input type="text" class="Form__Input" name="ApellidoM" id="ApellidoM" placeholder="Apellido materno" autocomplete="nope" />
                    </div>
                    <p class="Form__Input-error">Este campo<strong> no puede estar vacío </strong> y solo puede llevar letras, espacios y acentos.</p>
                </div>

                <div class="Form__Group" id="Group__Edad">
                    <label for="Edad" class="Form__label">Edad:</label>
                    <div class="Form__Group-input">
                        <input type="number" class="Form__Input" name="Edad" id="Edad" placeholder="Edad" min="10" max="100" autocomplete="nope" />
                    </div>
                    <p class="Form__Input-error">Este campo<strong> no puede estar vacío </strong> y solo puede llevar números.</p>
                </div>

                <div class="Form__Group" id="Group__Sexo">
                    <label for="Sexo" class="Form__label">Genero:</label>
                    <select name="Genero" id="Genero" class="Form__Input Form__Select">
                        <option value="0">Seleccione</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select>

                </div>

                <div class="Form__Group" id="Group__No_Celular">
                    <label for="No_Celular" class="Form__label">Numero de celular:</label>
                    <div class="Form__Group-input">
                        <input type="number" class="Form__Input" name="No_Celular" id="No_Celular" placeholder="Numero de celular" autocomplete="nope" />
                    </div>
                    <p class="Form__Input-error">Este campo<strong> no puede estar vacío </strong> y debe ser un numero de 10 digitos.</p>
                </div>

                <div class="Form__Group" id="Group__No_Casa">
                    <label for="No_Casa" class="Form__label">Numero de casa:</label>
                    <div class="Form__Group-input">
                        <input type="number" class="Form__Input" name="No_Casa" id="No_Casa" placeholder="Numero de casa" autocomplete="nope" />
                    </div>
                    <p class="Form__Input-error">Este campo<strong> no puede estar vacío </strong> y debe ser un numero de 10 digitos.</p>
                </div>

                <div class="Form__Group" id="Group__FechaI">
                    <label for="FechaI" class="Form__label">Fecha de Inicio:</label>
                    <div class="Form__Group-input">
                        <input type="date" class="Form__Input Form__Date" name="FechaI" id="FechaI" placeholder="Fecha de Inicio" autocomplete="nope" />
                    </div>
                    <p class="Form__Input-error">Este campo<strong> no puede estar vacío</strong></p>
                </div>

                <div class="Form__Group" id="Group__FechaT">
                    <label for="FechaT" class="Form__label">Fecha de Termino:</label>
                    <div class="Form__Group-input">
                        <input type="date" class="Form__Input  Form__Date" name="FechaT" id="FechaT" placeholder="Fecha de Termino" autocomplete="nope" />
                    </div>
                    <p class="Form__Input-error">Este campo<strong> no puede estar vacío</strong></p>
                </div>

                <div class="Form__Group" id="Group__Horas">
                    <label for="Horas" class="Form__label">Numero de Horas al día:</label>
                    <div class="Form__Group-input">
                        <input type="number" class="Form__Input" name="Horas" id="Horas" placeholder="Numero de casa" autocomplete="nope" />
                    </div>
                    <p class="Form__Input-error">Este campo<strong> no puede estar vacío </strong> y solo puede llevar números.</p>
                </div>

                <div class="Form__Group" id="Group__Responsable">
                    <label for="Responsable" class="Form__label">Responsable:</label>
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


                <div class="Form__Group" id="Group__Proyecto">
                    <label for="Proyecto" class="Form__label">Proyecto:</label>
                    <div class="Form__Group-input">
                        <input type="text" class="Form__Input" name="Proyecto" id="Proyecto" placeholder="Proyecto" autocomplete="nope" />
                    </div>
                    <p class="Form__Input-error">Este campo<strong> no puede estar vacío </strong> y solo puede llevar letras, espacios y acentos.</p>
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
                    <p class="Requeriments__Shipment Requeriments__Shipment-Active" id="Chart__TipoU">Tipo-usuario.</p>
                    <p class="Requeriments__Shipment" id="Chart__Matricula">Matricula.</p>
                    <p class="Requeriments__Shipment" id="Chart__Contraseña">Contraseña.</p>
                    <p class="Requeriments__Shipment" id="Chart__Contraseña_2">Confirmar contraseña.</p>
                    <p class="Requeriments__Shipment" id="Chart__Carrera">Carrera.</p>
                    <p class="Requeriments__Shipment" id="Chart__Grupo">Grupo.</p>
                    <p class="Requeriments__Shipment" id="Chart__Servicio">Tipo de servicio.</p>
                    <p class="Requeriments__Shipment" id="Chart__Nombre">Nombre.</p>
                    <p class="Requeriments__Shipment" id="Chart__ApellidoP">Apellido paterno.</p>
                    <p class="Requeriments__Shipment" id="Chart__ApellidoM">Apellido materno.</p>
                    <p class="Requeriments__Shipment" id="Chart__Edad">Edad.</p>
                    <p class="Requeriments__Shipment" id="Chart__Genero">Genero.</p>
                    <p class="Requeriments__Shipment" id="Chart__No_Celular">Numero de celular.</p>
                    <p class="Requeriments__Shipment" id="Chart__No_Casa">Numero de casa.</p>
                    <p class="Requeriments__Shipment" id="Chart__FechaI">Fecha de inicio.</p>
                    <p class="Requeriments__Shipment" id="Chart__FechaT">Fecha de termino.</p>
                    <p class="Requeriments__Shipment" id="Chart__Horas">Numero de Horas.</p>
                    <p class="Requeriments__Shipment" id="Chart__Responsable">Responsable.</p>
                    <p class="Requeriments__Shipment" id="Chart__Proyecto">Proyecto.</p>
                </div>
            </div>
        </div>
    </section>

    <div class="Alert_Send" id="Alert_Send">
        <h2 class="Alert_Send_Title" id="Alert_Send_Title">Error</h2>
        <img src="assets/images/cerrar.png" alt="Icono de cerrar" class="Img_cerrar" id="Btn_Error_cerrar">
    </div>

</body>
<script src="js/RegistroSSRP.js?see=1.13"></script>
<script src="sweetalert2/dist/sweetalert2.all.js"></script>
<script src="js/jquery-3.2.1.min.js"></script>

</html>