<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/IconCCAI.png">
    <title>PDF</title>
</head>

<body>

<?php
$archivo = $_GET["archivo"];
$exists = is_file("./Archivos_Usuarios/$archivo");
if ($exists) {
    $mi_pdf = fopen("./Archivos_Usuarios/$archivo", "r");
    if (!$mi_pdf) {
        echo "<p>No se pudo abrir el archivo para lectura</p>";
        exit;
    } else {
        header('Content-type: application/pdf');
        fpassthru($mi_pdf);
        fclose($archivo);
    }
} else {
    echo "<p>Archivo eliminado</p>";
}
?>

</body>

</html>