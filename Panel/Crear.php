<?php
session_start();
$varSesion = $_SESSION["Id_Responsable"];
if ($varSesion == '' || $varSesion == null) {
    header("location:login.php");
} else {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/images/IconCCAI.png">
    <link rel="stylesheet" href="../css/Barra.css?see=1.12">
    <link rel="stylesheet" href="../css/recarga.css">
    <link rel="stylesheet" href="../css/Crear.css">
    <title>Crear nuevo</title>
</head>
<body>
<div class="centrado" id="onload">
            <img src="../assets/images/LoadingCCAI2.gif" alt="" class="Img__Loading">
        </div>
<?php
    
    require('../Global/Barra.php');
        ?>

<main class="main">


<section class="Info">
                <div class="Info__Box">
                    <div class="Info__Container_Boxes">
                        <div class="Info__Box_Container">
                            
                            <p class="Box__Description">Crear nuevo usuario:</p>
                        </div>
                        <div class="Info__Box_Image">
                            <img src="../assets/images/crearUsuario.png" alt="" class="Image__Box">
                        </div>
                    </div>
                    <p class="Box_Option">Crear</p>
                </div>

                <div class="Info__Box Box_Two">
                    <div class="Info__Container_Boxes">
                        <div class="Info__Box_Container">
                            
                            <p class="Box__Description">Crear nuevo responsable:</p>
                        </div>
                        <div class="Info__Box_Image">
                            <img src="../assets/images/responsable.png" alt="" class="Image__Box">
                        </div>
                    </div>
                    <a class="Box_Option Box_Option_Two" href="Formulario.php">Crear</a>
                </div>

                <div class="Info__Box Box_Three">
                    <div class="Info__Container_Boxes">
                        <div class="Info__Box_Container">
                    
                            <p class="Box__Description">Crear:</p>
                        </div>
                        <div class="Info__Box_Image">
                            <img src="../assets/images/registros.png" alt="" class="Image__Box">
                        </div>
                    </div>
                    <p class="Box_Option Box_Option_Three">Más información:</p>
                </div>


                </div>
            </section>




</main>
 
</body>

<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/Barra.js"></script>
<script src="../js/recarga.js"></script>
</html>


<?php
}
?>