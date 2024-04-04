<?php
session_start();
$varSesion = $_SESSION["Id_Responsable"];
if ($varSesion == '' || $varSesion == null) {
    header("location:login.php");
} else {

    include '../BD/conexion.php';
    // Datos Cuadro-1
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/Usuarios.css?see=1.4">
        <link rel="stylesheet" href="../css/Barra.css?see=1.16">
        <link rel="stylesheet" href="../css/Tabla.css?see=1.2">
        <link rel="stylesheet" href="../css/recarga.css">
        <link rel="icon" href="../assets/images/IconCCAI.png">
        <title>Usuarios</title>
    </head>

    <body class="hidden">
    <?php
}
require('../Global/Barra.php');
    ?>

    <div class="centrado" id="onload">
        <img src="../assets/images/LoadingCCAI2.gif" alt="" class="Img__Loading">
    </div>

    <main class="main" id="Usuarios">
        <section class="Table">
            <h2 class="Table__Title">Usuarios registrados</h2>
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

                <div class="Table__Select Option__Box">
                    <label for="Servicio" class="Form__label">Tipo de alumno:</label>
                    <select name="Servicio" id="Alumno" class="Table__Select">
                        <option value="0">Todos</option>
                        <option value="Alumno">Alumno interno</option>
                        <option value="Alumno_externo">Alumno externo</option>
                    </select>
                </div>

            </div>
            <div class="Table__Select Option__Box2">
                    <label for="Servicio" class="Form__label">Estatus:</label>
                    <select name="Estatus" id="Estatus" class="Table__Select">
                        <option value="0">Todos</option>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>
            <div class="DatosDb" id="Datos">
            </div>
        </section>
    </main>
    </body>
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/Barra.js?see=1.4"></script>
    <script src="../js/recarga.js"></script>
    <script src="../js/busqueda.js?see=1.11"></script>
    <script src="../sweetalert2/dist/sweetalert2.all.js"></script>
    </html>