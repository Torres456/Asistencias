<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">
    <meta name="description" content="Inicio de seción">
    <link rel="icon" href="../assets/images/IconCCAI.png">
    <link rel="stylesheet" href="../css/login.css?see=1.8">
    <link rel="stylesheet" href="../css/recarga.css">
</head>

<body class="hidden">
    <div class="centrado" id="onload">
        <img src="../assets/images/LoadingCCAI2.gif" alt="" class="Img__Loading">
    </div>

    <div class="Alert_Send" id="Alert_Send">
        <h2 class="Alert_Send_Title" id="Alert_Send_Title">Error</h2>
        <img src="../assets/images/cerrar.png" alt="Icono de cerrar" class="Img_cerrar" id="Btn_Error_cerrar">
    </div>

    <div class="Conntainer">
        <div class="Container_Form">
            <h2 class="Form__Title"><strong>Inicio de sesión: Profesores.</strong></h2>
            <form action="" class="Form" id="Form">
                <div class="Form__Group" id="Group__Usuario">
                    <label for="Usuario" class="Form__Label">Usuario:</label>
                    <div class="Form__Group-input">
                        <input type="text" class="Form__Input" name="Usuario" id="Usuario" placeholder="Usuario" autocomplete="nope" autocomplete="off" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" min="1" />
                        <p class="Form__Input-Error"></p>
                    </div>
                </div>
                <div class="Form__Group" id="Group__Contraseña">
                    <label for="Contraseña" class="Form__Label">Contraseña:</label>
                    <div class="Form__Group-input">
                        <input type="password" class="Form__Input" name="Contraseña" id="Contraseña" placeholder="Contraseña" autocomplete="nope">
                        <p class="Form__Input-Error"></p>
                    </div>
                </div>
                <div class="Messaje_Send" id="Messaje_Send">
                    <h2 class="Messaje_Send_Title" id="Messaje_Send_Title">.</h2>
                </div>
                <div class="Conntainer__Button">
                    <input type="submit" class="Form__Button" id="Form__Button" value="Iniciar sesión">
                </div>
            </form>
            <button class="Button__Exit" onclick="myFunction()">Regresar</button>
        </div>

        <div class="container__Img">
            <img src="../assets/images/loginA.png" alt="" class="Login__Img">
        </div>
    </div>



</body>

<script>
    function myFunction() {
        $(location).attr('href', '../index.php');
    }
</script>

<script src="../js/login.js?see=1.6"></script>
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/recarga.js"></script>
<script src="../sweetalert2/dist/sweetalert2.all.js"></script>

</html>