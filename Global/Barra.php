<div class="menu">
        <ion-icon name="menu-outline"></ion-icon>
        <ion-icon name="close-outline"></ion-icon>
    </div>

<div class="barra-lateral">
        <div>
            <div class="nombre-pagina">
                <img src="../assets/images/panel.png"  id="cloud" name="cloud-outline">
                <span>Panel</span>
            </div>
            <a class="boton" id="Buttom" href="Crear.php">
            <img src="../assets/images/crear.png" alt="" class="Icon__Navegacion">
                <span>Crear nuevo</span>
            </a>
        </div>

        <nav class="navegacion">
            <ul>
                <li>
                    <a id="InicioB" href="Panel.php" class="Option">
                        <img src="../assets/images/home.png" alt="" class="Icon__Navegacion">
                        <!-- <ion-icon name="mail-unread-outline"></ion-icon> -->
                        <span>Inicio</span>
                    </a>
                </li>
                <li>
                    <a href="Usuarios.php" class="Option" id="UsuariosB">
                    <img src="../assets/images/registros.png" alt="" class="Icon__Navegacion">
                        <span>Usuarios</span>
                    </a>
                </li>
                <li>
                    <a  class="Option" id="Salir">
                    <img src="../assets/images/logoutB.png" alt="" class="Icon__Navegacion" >
                        <span>Cerra sesión</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="#">
                        <ion-icon name="document-text-outline"></ion-icon>
                        <span>Drafts</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <ion-icon name="bookmark-outline"></ion-icon>
                        <span>Important</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <ion-icon name="alert-circle-outline"></ion-icon>
                        <span>Spam</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <ion-icon name="trash-outline"></ion-icon>
                        <span>Trash</span>
                    </a>
                </li> -->
            </ul>
        </nav>
        <div>
            <div class="linea"></div>
            <div class="usuario">
                <img src="../assets/images/ccai.jpeg" alt="">
                <div class="info-usuario">
                    <div class="nombre-email">
                        <span class="nombre"><?php echo $_SESSION["Nombre_Responsable"];?></span>
                        <span class="email"><?php echo $_SESSION["Id_Responsable"];?></span>
                    </div>
                    <ion-icon name="ellipsis-vertical-outline"></ion-icon>
                </div>
            </div>
        </div>
    </div>
