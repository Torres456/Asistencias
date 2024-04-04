<?php
session_start();
$varSesion = $_SESSION["Id_Responsable"];
if ($varSesion == '' || $varSesion == null) {
  header("location:login.php");
} else {
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/Pdf.css">
  <link rel="icon" href="../assets/images/IconCCAI.png">
  <title>PDF</title>
</head>

<body>
  <?php

  use Dompdf\Dompdf;
  use Dompdf\Options;

  if (isset($_GET['Fecha_Inicio']) && isset($_GET['Fecha_Termino']) && isset($_GET['Asistencia']) && isset($_GET['Matricula'])) {

    require '../vendor/autoload.php';
    include '../BD/conexion.php';
    $salida = "";

    $Inicio = $_GET['Fecha_Inicio'];
    $Termino = $_GET['Fecha_Termino'];
    $Tipo = $_GET['Asistencia'];
    $Matricula = $_GET['Matricula'];

    $queryA = "SELECT Nombre, Apellido_p, Apellido_m FROM usuarios WHERE ID_usuario='$Matricula'";
    $result = $conexion->query($queryA);
    $num_rows = mysqli_num_rows($result);

    if ($num_rows) { //User
      $data = mysqli_fetch_array($result);
      $queryB = "SELECT Tipo, Responsable FROM SSRP WHERE Usuario='$Matricula'";
      $result2 = $conexion->query($queryB);
      $num_rows2 = mysqli_num_rows($result2);
      if ($num_rows2) { //SSRP
        $data2 = mysqli_fetch_array($result2);
        $responsable = $data2["Responsable"];
        $queryC = "SELECT Nombre,A_paterno, A_materno FROM responsables WHERE ID_responsable='$responsable'";
        $result3 = $conexion->query($queryC);
        $data3 = mysqli_fetch_array($result3);
      } else { //ssrp
        $data3 = array(
          "Nombre" => "Sin datos",
          "A_paterno" => "Sin datos",
          "A_materno" => "Sin datos"
        );
      }

      //Filters---

      if ($Tipo == "") {


        $queryT = "SELECT a.ID_asistencia, a.H_entrada, a.H_salida, a.Fecha, a.No_horas, s.Responsable FROM asistencia AS a INNER JOIN ssrp AS s ON a.Usuario = s.Usuario WHERE s.Responsable='null' AND a.Usuario='null' AND a.H_salida='Sin salida' AND a.Fecha BETWEEN 'null' AND 'null'";
      } else {




        if ($Inicio == "" && $Termino == "") {

          $Tipo = $_GET['Asistencia'];

          if ($Tipo == 0) {
            $queryT = "SELECT a.ID_asistencia, a.H_entrada, a.H_salida, a.Fecha, a.No_horas, s.Responsable FROM asistencia AS a INNER JOIN ssrp AS s ON a.Usuario = s.Usuario WHERE s.Responsable='$varSesion' AND a.Usuario='$Matricula'";
          } else if ($Tipo == 1) {
            $queryT = "SELECT a.ID_asistencia, a.H_entrada, a.H_salida, a.Fecha, a.No_horas, s.Responsable FROM asistencia AS a INNER JOIN ssrp AS s ON a.Usuario = s.Usuario WHERE NOT a.H_salida='Sin salida' AND s.Responsable='$varSesion' AND a.Usuario='$Matricula'";
          } else if ($Tipo == 2) {
            $queryT = "SELECT a.ID_asistencia, a.H_entrada, a.H_salida, a.Fecha, a.No_horas, s.Responsable FROM asistencia AS a INNER JOIN ssrp AS s ON a.Usuario = s.Usuario WHERE s.Responsable='$varSesion' AND a.Usuario='$Matricula' AND a.H_salida='Sin salida'";
          }else {

            $queryT = "SELECT a.ID_asistencia, a.H_entrada, a.H_salida, a.Fecha, a.No_horas, s.Responsable FROM asistencia AS a INNER JOIN ssrp AS s ON a.Usuario = s.Usuario WHERE s.Responsable='null' AND a.Usuario='null' AND a.H_salida='Sin salida' AND a.Fecha BETWEEN 'null' AND 'null'";
          }

          $fecha = "Historial total";
        } else if ($Inicio != "" && $Termino == "") {

          $Tipo = $_GET['Asistencia'];
          $fechaA = $_GET['Fecha_Inicio'];

          $fecha = $fechaA;
          if ($Tipo == 0) {
            $queryT = "SELECT a.ID_asistencia, a.H_entrada, a.H_salida, a.Fecha, a.No_horas FROM asistencia AS a INNER JOIN ssrp AS s ON a.Usuario = s.Usuario WHERE s.Responsable='$varSesion' AND a.Usuario='$Matricula' AND a.fecha='$fechaA'";
          } else if ($Tipo == 1) {
            $queryT = "SELECT a.ID_asistencia, a.H_entrada, a.H_salida, a.Fecha, a.No_horas FROM asistencia AS a INNER JOIN ssrp AS s ON a.Usuario = s.Usuario WHERE NOT a.H_salida='Sin salida' AND s.Responsable='$varSesion' AND a.Usuario='$Matricula' AND a.fecha='$fechaA'";
          } else if ($Tipo == 2) {
            $queryT = "SELECT a.ID_asistencia, a.H_entrada, a.H_salida, a.Fecha, a.No_horas FROM asistencia AS a INNER JOIN ssrp AS s ON a.Usuario = s.Usuario WHERE s.Responsable='$varSesion' AND a.Usuario='$Matricula' AND a.H_salida='Sin salida' AND a.fecha='$fechaA'";
          }else {

            $queryT = "SELECT a.ID_asistencia, a.H_entrada, a.H_salida, a.Fecha, a.No_horas, s.Responsable FROM asistencia AS a INNER JOIN ssrp AS s ON a.Usuario = s.Usuario WHERE s.Responsable='null' AND a.Usuario='null' AND a.H_salida='Sin salida' AND a.Fecha BETWEEN 'null' AND 'null'";
          }
        } else if ($Inicio != "" && $Termino != "") {
          $Tipo = $_GET['Asistencia'];
          $fechaA = $_GET['Fecha_Inicio'];
          $fechaB = $_GET['Fecha_Termino'];
          if ($Tipo == 0) {
            $queryT = "SELECT a.ID_asistencia, a.H_entrada, a.H_salida, a.Fecha, a.No_horas, s.Responsable FROM asistencia AS a INNER JOIN ssrp AS s ON a.Usuario = s.Usuario WHERE s.Responsable='$varSesion' AND a.Usuario='$Matricula' AND a.Fecha BETWEEN '$fechaA' AND '$fechaB'";
          } else if ($Tipo == 1) {
            $queryT = "SELECT a.ID_asistencia, a.H_entrada, a.H_salida, a.Fecha, a.No_horas, s.Responsable FROM asistencia AS a INNER JOIN ssrp AS s ON a.Usuario = s.Usuario WHERE NOT a.H_salida='Sin salida' AND s.Responsable='$varSesion' AND a.Usuario='$Matricula' AND a.Fecha BETWEEN '$fechaA' AND '$fechaB'";
          } else if ($Tipo == 2) {
            $queryT = "SELECT a.ID_asistencia, a.H_entrada, a.H_salida, a.Fecha, a.No_horas, s.Responsable FROM asistencia AS a INNER JOIN ssrp AS s ON a.Usuario = s.Usuario WHERE s.Responsable='$varSesion' AND a.Usuario='$Matricula' AND a.H_salida='Sin salida' AND a.Fecha BETWEEN '$fechaA' AND '$fechaB'";
          }else {

            $queryT = "SELECT a.ID_asistencia, a.H_entrada, a.H_salida, a.Fecha, a.No_horas, s.Responsable FROM asistencia AS a INNER JOIN ssrp AS s ON a.Usuario = s.Usuario WHERE s.Responsable='null' AND a.Usuario='null' AND a.H_salida='Sin salida' AND a.Fecha BETWEEN 'null' AND 'null'";
          }


          $fecha = "$fechaA al mes $fechaB";
        } else {

          $queryT = "SELECT a.ID_asistencia, a.H_entrada, a.H_salida, a.Fecha, a.No_horas, s.Responsable FROM asistencia AS a INNER JOIN ssrp AS s ON a.Usuario = s.Usuario WHERE s.Responsable='null' AND a.Usuario='null' AND a.H_salida='Sin salida' AND a.Fecha BETWEEN 'null' AND 'null'";
        }
      } //Tipo null


      $resultT = $conexion->query($queryT);

      $options = new Options();
      $options->set('chroot', realpath(''));


      $html = '
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="PdfStyle.css">

</head>
<body>
<div class="Box__Title">
  <h2 class="Title__Box">Registro de horas de servicio social y residencias profesionales</h2>
  <img src="ccai.jpeg" alt="" class="Title__Img" />
</div>

<div class="Data__Tutor">
  <label for="" class="Data__Label"
    >Responsable: ' . $data3["Nombre"] . ' ' . $data3["A_paterno"] . ' ' . $data3["A_materno"] . '</label
  >
  <label for="" class="Data__Label">Fecha: ' . $fecha . '</label>
</div>
<div class="Data__Student">
  <h2 class="Student__Title">Datos del estudiante</h2>
  <div class="Students__Labels">
    <label for="" class="Student__Label">Matricula:' . $_GET["Matricula"] . '</label>
    <label for="" class="Student__Label">Apellido paterno:' . $data["Apellido_p"] . '</label>
    <label for="" class="Student__Label">Apellido materno:' . $data["Apellido_m"] . '</label>
    <label for="" class="Student__Label">Nombre(s): ' . $data["Nombre"] . '</label>
  </div>
</div>

<div class="Box__Table">
  <table class="Table__Users" id="Table__Users">
    <thead>
      <tr>
        <th>Hora de entrada:</th>
        <th>Hora de salida:</th>
        <th>Fecha:</th>
        <th>No.Horas:</th>
      </tr>
    </thead>
    <tbody>';
      while ($fila = $resultT->fetch_assoc()) {

        $html .= "<tr>
       <td>" . $fila["H_entrada"] . "</td>
       <td>" . $fila["H_salida"] . "</td>
       <td>" . $fila["Fecha"] . "</td>
       <td>" . $fila["No_horas"] . "</td>
       </tr>";
      }
      $html .= '
  </tbody>
  </table>
<div class="Box__Firms">
      <label for="" class="Firm__Label Firm__Label-one">Firma del responsable.</label>
      <label for="" class="Firm__Label-Space"></label>
      <label for="" class="Firm__Label">Firma del alumno.</label>
    </div>
</body>
</html>

';

      $dompdf = new Dompdf($options);
      $dompdf->loadHtml($html);
      $dompdf->render();
      // $output = $dompdf->output();
      // file_put_contents('pdf/prueva10.pdf', $output);

      header("Content-type: application/pdf");
      header("Content-Disposition: inline; filename=documento.pdf");
      echo $dompdf->output();


      //User not found
    } else {
  ?>
      <header class="Header">
        <h1 class="Header__Title">Usuario no encontrado.</h1>
        <div class="line"></div>
      </header>
      <div class="Img__error">
        <img src="../assets/images/Usuario.png" alt="" class="Img__Get">
      </div>
      <div class="Box__Buttons">
        <button type="button" class="Button_Error" onclick="myFunction()">Regresar</button>
      </div>
      <script>
        function myFunction() {
          $(location).attr('href', '../Panel/Usuarios.php');
        }
      </script>
      <script src="../js/jquery-3.2.1.min.js"></script>
    <?php

    }
  } else {

    ?>
    <header class="Header">
      <h1 class="Header__Title">No se encuantra una petición.</h1>
      <div class="line"></div>
    </header>
    <div class="Img__error">
      <img src="../assets/images/GET.png" alt="" class="Img__Get">
    </div>
    <div class="Box__Buttons">
      <button type="button" class="Button_Error" onclick="myFunction()">Regresar</button>
    </div>

    <script>
      function myFunction() {
        $(location).attr('href', '../Panel/Usuarios.php');
      }
    </script>
    <script src="../js/jquery-3.2.1.min.js"></script>

  <?php

  }







  // }

  ?>



</body>

</html>