<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $option = $_POST['option'];

    if ($option == 1) {

        session_start();
        $_SESSION['User2']['id'] = "";
        echo 200;
    } else {

        session_start();
        $_SESSION["Id_Responsable"] = "";
        echo 200;
    }
}
