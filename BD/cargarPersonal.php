<?php
session_start();
$varSesion = $_SESSION["Id_Responsable"];
if ($varSesion == '' || $varSesion == null) {
    header("location:login.php");
} else {

    include("conexion.php");

    $salida = "";
    if (isset($_POST['Accion']) && isset($_POST['Tipo']) && isset($_POST['Estatus'])) {
        $accion = $_POST['Accion'];
        $tipo = $_POST['Tipo'];
        $estatus = $_POST['Estatus'];

        if ($accion == 0) {

            if ($tipo == 0) {
                if ($estatus == 0) {
                    $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, u.Apellido_m, u.Grupo, s.Tipo, s.Estatus FROM usuarios AS u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario WHERE s.Responsable='$varSesion'";
                } else {
                    $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, u.Apellido_m, u.Grupo, s.Tipo, s.Estatus FROM usuarios AS u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario WHERE s.Responsable='$varSesion' AND s.Estatus='$estatus'";
                }
            } else {
                if ($estatus == 0) {
                    $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, u.Apellido_m, u.Grupo, s.Tipo, s.Estatus FROM usuarios AS u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario WHERE s.Responsable='$varSesion' AND u.TipoA='$tipo'";
                } else {
                    $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, u.Apellido_m, u.Grupo, s.Tipo, s.Estatus FROM usuarios AS u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario WHERE s.Responsable='$varSesion' AND u.TipoA='$tipo' AND s.Estatus='$estatus'";
                }
            }
        } else if ($accion == 1) {

            if ($tipo == 0) {
                if ($estatus == 0) {
                    $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, u.Apellido_m, u.Grupo, s.Tipo, s.Estatus FROM usuarios AS u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario WHERE s.Responsable='$varSesion' AND s.Tipo='Servicio social'";
                } else {
                    $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, u.Apellido_m, u.Grupo, s.Tipo, s.Estatus FROM usuarios AS u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario WHERE s.Responsable='$varSesion' AND s.Tipo='Servicio social' AND s.Estatus='$estatus'";
                }
            } else {

                if ($estatus == 0) {
                    $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, u.Apellido_m, u.Grupo, s.Tipo, s.Estatus FROM usuarios AS u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario WHERE s.Responsable='$varSesion' AND s.Tipo='Servicio social' And u.TipoA='$tipo'";
                } else {
                    $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, u.Apellido_m, u.Grupo, s.Tipo, s.Estatus FROM usuarios AS u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario WHERE s.Responsable='$varSesion' AND s.Tipo='Servicio social' And u.TipoA='$tipo' AND s.Estatus='$estatus'";
                }
            }
        } else if ($accion == 2) {

            if ($tipo == 0) {

                if ($estatus == 0) {
                    $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, u.Apellido_m, u.Grupo, s.Tipo, s.Estatus FROM usuarios AS u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario WHERE s.Responsable='$varSesion' AND s.Tipo='Residencias profecionales'";
                } else {
                    $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, u.Apellido_m, u.Grupo, s.Tipo, s.Estatus FROM usuarios AS u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario WHERE s.Responsable='$varSesion' AND s.Tipo='Residencias profecionales' AND s.Estatus='$estatus'";
                }
            } else {

                if ($estatus == 0) {
                    $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, u.Apellido_m, u.Grupo, s.Tipo, s.Estatus FROM usuarios AS u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario WHERE s.Responsable='$varSesion' AND s.Tipo='Residencias profecionales' And u.TipoA='$tipo'";
                } else {
                    $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, u.Apellido_m, u.Grupo, s.Tipo, s.Estatus FROM usuarios AS u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario WHERE s.Responsable='$varSesion' AND s.Tipo='Residencias profecionales' And u.TipoA='$tipo' AND s.Estatus='$estatus'";
                }
            }
        }
    }

    if (isset($_POST['consulta'])  && isset($_POST['Accion'])  && isset($_POST['Tipo']) && isset($_POST['Estatus'])) {
        $accion2 = $_POST['Accion'];
        $tipo = $_POST['Tipo'];

        if ($accion2 == 0) {
            $q = $conexion->real_escape_string($_POST['consulta']);
            if ($tipo == 0) {
                if ($estatus == 0) {
                    $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, u.Apellido_m, u.Grupo, s.Tipo, s.Estatus FROM usuarios AS u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario WHERE s.Responsable='$varSesion' AND u.ID_usuario LIKE '%" . $q . "%'";
                } else {
                    $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, u.Apellido_m, u.Grupo, s.Tipo, s.Estatus FROM usuarios AS u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario WHERE s.Responsable='$varSesion' AND s.Estatus='$estatus' AND u.ID_usuario LIKE '%" . $q . "%'";
                }
            } else {
                if ($estatus == 0) {
                    $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, u.Apellido_m, u.Grupo, s.Tipo, s.Estatus FROM usuarios AS u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario WHERE s.Responsable='$varSesion' And u.TipoA='$tipo' AND u.ID_usuario LIKE '%" . $q . "%'";
                } else {
                    $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, u.Apellido_m, u.Grupo, s.Tipo, s.Estatus FROM usuarios AS u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario WHERE s.Responsable='$varSesion' And u.TipoA='$tipo' AND s.Estatus='$estatus' AND u.ID_usuario LIKE '%" . $q . "%'";
                }
            }
        } else if ($accion2 == 1) {

            $q = $conexion->real_escape_string($_POST['consulta']);

            if ($tipo == 0) {

                if ($estatus == 0) {
                    $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, u.Apellido_m, u.Grupo, s.Tipo, s.Estatus FROM usuarios AS u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario WHERE s.Responsable='$varSesion' AND s.Tipo='Servicio social' AND u.ID_usuario LIKE '%" . $q . "%'";
                } else {
                    $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, u.Apellido_m, u.Grupo, s.Tipo, s.Estatus FROM usuarios AS u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario WHERE s.Responsable='$varSesion' AND s.Tipo='Servicio social' AND s.Estatus='$estatus' AND u.ID_usuario LIKE '%" . $q . "%'";
                }
            } else {
                if ($estatus == 0) {
                    $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, u.Apellido_m, u.Grupo, s.Tipo, s.Estatus FROM usuarios AS u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario WHERE s.Responsable='$varSesion' And u.TipoA='$tipo' AND s.Tipo='Servicio social' AND u.ID_usuario LIKE '%" . $q . "%'";
                } else {
                    $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, u.Apellido_m, u.Grupo, s.Tipo, s.Estatus FROM usuarios AS u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario WHERE s.Responsable='$varSesion' AND u.TipoA='$tipo' AND s.Tipo='Servicio social'  AND s.Estatus='$estatus' AND u.ID_usuario LIKE '%" . $q . "%'";
                }
            }
        } else if ($accion2 == 2) {

            $q = $conexion->real_escape_string($_POST['consulta']);

            if ($tipo == 0) {

                if ($estatus == 0) {
                    $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, u.Apellido_m, u.Grupo, s.Tipo, s.Estatus FROM usuarios AS u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario WHERE s.Responsable='$varSesion' AND s.Tipo='Residencias profecionales' AND u.ID_usuario LIKE '%" . $q . "%'";
                } else {
                    $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, u.Apellido_m, u.Grupo, s.Tipo, s.Estatus FROM usuarios AS u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario WHERE s.Responsable='$varSesion' AND s.Tipo='Residencias profecionales' AND s.Estatus='$estatus' AND u.ID_usuario LIKE '%" . $q . "%'";
                }
            } else {

                if ($estatus == 0) {
                    $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, u.Apellido_m, u.Grupo, s.Tipo, s.Estatus FROM usuarios AS u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario WHERE s.Responsable='$varSesion' And u.TipoA='$tipo' AND s.Tipo='Residencias profecionales' AND u.ID_usuario LIKE '%" . $q . "%'";
                } else {
                    $query = "SELECT u.ID_usuario, u.TipoA, u.Nombre, u.Apellido_p, u.Apellido_m, u.Grupo, s.Tipo, s.Estatus FROM usuarios AS u INNER JOIN ssrp AS s ON u.ID_usuario = s.Usuario WHERE s.Responsable='$varSesion' And u.TipoA='$tipo' AND s.Tipo='Residencias profecionales' AND s.Estatus='$estatus' AND u.ID_usuario LIKE '%" . $q . "%'";
                }
            }
        } else {
        }
    }

    $result = $conexion->query($query);

    if ($result->num_rows > 0) {
        $salida .= "
                <table class='Table__Users' id='Table__Users'>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tipo</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Grupo</th>
                        <th>Tipo</th>
                        <th>Estatus</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>";

        while ($fila = $result->fetch_assoc()) {

            $salida .= "<tr>
                <td>" . $fila["ID_usuario"] . "</td>
                <td>" . $fila["TipoA"] . "</td>
                <td>" . $fila["Nombre"] . "</td>
                <td>" . $fila["Apellido_p"] . "</td>
                <td>" . $fila["Apellido_m"] . "</td>
                <td>" . $fila["Grupo"] . "</td>
                <td>" . $fila["Tipo"] . "</td>
                <td>" . $fila["Estatus"] . "</td>
                <td><a class='Table__Button' target='_top' href='View_User.php?Usuario=" . $fila['ID_usuario'] . "'>visualizar</a>
                </td>
                </tr>";
        }
        $salida .= "</tbody></table>";
    } else {
        $salida .= "<div class='Table__Alert'>
                    <h2>Sin datos</h2>
                    <div class='Img__error'>
                <img src='../assets/images/Sin_datos.png' alt='' class='Img__Get'>
            </div>
                </div>";
    }
    echo $salida;
}
