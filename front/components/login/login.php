<?php
    include ("../../../back/conexion.php");
    include ("../../../mcript.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
                
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"/>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"/>
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
                <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Red+Hat+Display:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"/>
                <link href="../../styles/login.css" rel="stylesheet" />
        
        <title>Iniciar sesión</title>
    </head>
    <body class="" style="background-color: #242526;">
        <header>
            <!-- Navbar section -->
            <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top shadow">
                <section class="container-md">
                    <a class="navbar-brand mb-0 h1 fs-3">
                        <img class = "d-inline-block align-text-center" src="../../img/logo160x160.png" width="50" height="50"/>
                        <span class = "bee-logo">
                            <span class="text-warning">Bee</span>Raites <!--##ffe484-->
                        </span>
                    </a>
                </section>
           </nav>
        </header>
        <main class="container" >
        <!--<main class="container mt-md-4 d-flex align-items-center justify-content-center w-100">-->
            <section class = "row vh-100 align-items-center justify-content-center">
                <div class = "login col-sm-8 col-md-6 col-lg-4 p-4" >
                    <h2 class="text-center text-white mb-5">Inicia sesión en BeeRaites</h2>
                    
                    <?php 
                        include("../../../back/login/control_login.php");
                    ?>

                    <form action="" method="post">
                        <div class="mb-4">
                            <label class="form-label" for="correo">Correo electrónico</label>
                            <input class="form-control" name="correo" type="email" placeholder="correo@ejemplo.com" required />
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="contrasena">Contraseña</label>
                            <input class="form-control" name="contrasena" type="password" required />
                        </div>
                        <div class="mb-4">
                            <input class="btn btn-warning w-100 mt-4" name="btningresar" type="submit" value="Iniciar"/>
                        </div>
                    </form>
                    <p class="text-white text-center">
                        ¿Aún no tienes cuenta?
                        <a href="../registro/insertarusuario.php" style="text-decoration: none;">
                            Regístrate aquí
                        </a>
                    </p>
                </div>
            </section>
<!--
            <section class="login">
                <form action = "" method = "post">
                    <h2 class = "form-title text-center">Iniciar sesión</h2>
                    <div class = "mb-2">
                        <label class = "form-label" for="email">Correo electrónico</label>
                        <input class="form-control" type = "email" placeholder="correo@ejemplo.com" required/> g
                    </div>
                    <div class = "mb-3">
                        <label class="form-label" for="password">Contraseña</label>
                        <input class = "form-control" type  ="password" required />
                        <span class = "form-text">
                            ¿Olvidaste tu contraseña? <a class = "" href="" style = "text-decoration: none;">Recuperar contraseña</a>
                        </span>
                    </div>
                    <div class="mb-3">
                        <input class = "btn btn-warning w-100 mt-2" type="submit" value="Ingresar"/>
                    </div>
                </form>
                <span class="form-text mt-3  ">
                    ¿Todavía no tienes una cuenta? <a class = "" href="" style = "text-decoration: none;">Regístrate aquí</a>
                </span>
            </section>
-->
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </body>
</html>
