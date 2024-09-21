<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- ICONS -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <!-- STYLESHEET -->
    <link rel="stylesheet" href="css/style.css" />
    <title>Sidebar</title>
  </head>
  <body>

    <div class="container">
        <div class="sidebar">
            <div class="sidebaruno">
                <div class="logo">
                    <div class="logo-img">
                        <img src="img/logo.png" alt="">
                    </div>
                </div>

                <div class="logo">
                    <div class="user-img">
                        <img src="img/user.jpg" alt="">
                    </div>
                </div>

                <div class="head">
                    <div class="user-details">
                        <p class="name">Yerald Sinche</p>
                        <p class="title">Adminstrador</p>
                    </div>
                </div>
                <a href="#">
                    <i class="icon"></i>
                    <span class="text">Editar Perfil</span>
                </a>

            </div>
            <div class="nav">
                <div class="menu">
                    <p class="title">Menú</p>
                    <ul>
                        <li class="active">
                            <a href="#">
                                <img src="img/icon-admin.png" alt="">
                                <span class="text">Administración</span>
                                <i class="arrow ph-bold ph-caret-down"></i>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="#">
                                        <span class="text">Usuarios</span>
                                    </a>
                                    <a href="#">
                                        <span class="text">Clientes</span>
                                    </a>
                                    <a href="#">
                                        <span class="text">Tanques</span>
                                    </a>
                                    <a href="#">
                                        <span class="text">Sensores</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <img src="img/icon-consumo.png" alt="">
                                <span class="text">Consumo</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                            <img src="img/icon-nivel.png" alt="">
                                <span class="text">Nivel</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="img/icon-calidad.png" alt="">
                                <span class="text">Calidad</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="img/icon-home.png" alt="">
                                <span class="text">Inicio</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="img/icon-salir.png" alt="">
                                <span class="text">Cerrar sesión</span>
                            </a>
                        </li>
                    </ul>


                </div>
            </div>
        </div>
    </div>
    <!-- Jquery -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js"
      integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw=="
      crossorigin="anonymous"
    ></script>
    <script src="js/script.js"></script>
  </body>
</html>