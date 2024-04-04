<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/images/IconCCAI.png">
    <link rel="stylesheet" href="../css/Formulario.css?see=1.2">
    <link rel="stylesheet" href="../css/recarga.css">
    <title>Formulario</title>
</head>

<body>

<div class="centrado" id="onload">
            <img src="../assets/images/LoadingCCAI2.gif" alt="" class="Img__Loading">
        </div>

    <header class="Header">
        <h1 class="Header__Title">Crear nuevo responable.</h1>
        <div class="line"></div>
    </header>

    <section class="Data">
        <div class="Box__Data">
            <form action="" id="Form">

                <div class="Data__Info">
                    <label for="" class="Data__Info_Label Data__Info_LabelE">Matricula:</label>
                    <input name="Matricula" id="Matricula" type="number" class="Data__Info_Label" autocomplete="nope" autocomplete="off" onkeypress="return ((event.charCode >= 48 && event.charCode <= 57))" /></input>
                </div>

                <div class="Data__Info">
                    <label for="" class="Data__Info_Label Data__Info_LabelE">Nombre:</label>
                    <input name="Nombre" id="Nombre" class="Data__Info_Label" autocomplete="nope" autocomplete="off" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >=31 && event.charCode <= 33) || (event.charCode >=225 && event.charCode <= 225) || (event.charCode >=193 && event.charCode <= 193) || (event.charCode >=233 && event.charCode <= 233) || (event.charCode >=201 && event.charCode <= 211)|| (event.charCode >=237 && event.charCode <= 243) )" /></input>
                </div>
                <div class="Data__Info">
                    <label class="Data__Info_Label Data__Info_LabelE">Apellido paterno:</label>
                    <input name="Apellido paterno" id="Apellido_paterno" class="Data__Info_Label" autocomplete="nope" autocomplete="off" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >=31 && event.charCode <= 33) || (event.charCode >=225 && event.charCode <= 225) || (event.charCode >=193 && event.charCode <= 193) || (event.charCode >=233 && event.charCode <= 233) || (event.charCode >=201 && event.charCode <= 211)|| (event.charCode >=237 && event.charCode <= 243) )" /></input>
                </div>

                <div class="Data__Info">
                    <label class="Data__Info_Label Data__Info_LabelE">Apellido materno:</label>
                    <input name="Apellido materno" id="Apellido_materno" class="Data__Info_Label" autocomplete="nope" autocomplete="off" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >=31 && event.charCode <= 33) || (event.charCode >=225 && event.charCode <= 225) || (event.charCode >=193 && event.charCode <= 193) || (event.charCode >=233 && event.charCode <= 233) || (event.charCode >=201 && event.charCode <= 211)|| (event.charCode >=237 && event.charCode <= 243) )" /></input>
                </div>

                <div class="Data__Info">
                    <label for="" class="Data__Info_Label Data__Info_LabelE">Nombre de usuario:</label>
                    <input name="Usuario" id="Usuario" type="text" class="Data__Info_Label" autocomplete="nope" autocomplete="off" /></input>
                </div>

                <div class="Data__Info">
                    <label for="" class="Data__Info_Label Data__Info_LabelE">Contraseña:</label>
                    <input name="Contraseña" id="Clave" type="password" class="Data__Info_Label" autocomplete="nope" autocomplete="off"></input>
                </div>

                <div class="Data__Info">
                    <label for="" class="Data__Info_Label Data__Info_LabelE">Confirmar contraseña:</label>
                    <input name="Confirmar contraseña" id="Clave_2" type="password" class="Data__Info_Label" autocomplete="nope" autocomplete="off"></input>
                </div>

            </form>
        </div>
    </section>

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

</body>

<script src="../js/Formulario.js?see=1.4"></script>
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/recarga.js"></script>
<script src="../sweetalert2/dist/sweetalert2.all.js"></script>

</html>