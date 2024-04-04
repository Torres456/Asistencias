<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Busqeda de perfil de usuario">
    <link rel="icon" href="assets/images/IconCCAI.png">
    <link rel="stylesheet" href="css/busqueda.css?see=1.10">
    <title>Busqueda de perfil</title>
</head>

<body>
    <div class="centrado" id="onload">
        <img src="assets/images/LoadingCCAI2.gif" alt="" class="Img__Loading">
    </div>
    <header class="Header">
        <h2 class="Header__Title">Búsqueda de perfil</h2>
        <div class="line"></div>
    </header>

    <div class="Search">
        <label for="" class="Search__Label">Buscar:</label>
        <input type="text" class="Search__Input" name="Usuario" id="Usuario" placeholder="Usuario" minlength="4" maxlength="10" autocomplete="nope" />
    </div>

    <div class="datosDb" id="datos">
    </div>

</body>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/busqueda.js?see=1.5"></script>


</html>