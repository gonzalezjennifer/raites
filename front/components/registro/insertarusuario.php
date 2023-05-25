<?php
    include ("../../../back/conexion.php");
    include ("../../../mcript.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width = device-width, initial-scale = 1.0"/>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Red+Hat+Display:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"/>
        <link rel="shortcut-icon" href="./img/logo160x160.ico"/>
        <link href="./styles/insertarusuario.css" rel="stylesheet" />

        <title>Regístrate</title>
    </head>
    <body style="background-color: #242526;">
        <header>
            <!-- Navbar section -->
            <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top shadow">
                <section class="container-md">
                    <a class="navbar-brand mb-0 h1 fs-3">
                        <img class = "d-inline-block align-text-center" src="./img/logo160x160.png" width="50" height="50"/>
                        <span class = "bee-logo">
                            <span class="text-warning">Bee</span>Raites <!--##ffe484-->
                        </span>
                    </a>
                </section>
           </nav>
        </header>
        <main class="container">
            <section class = "row vh-100 align-items-center justify-content-center">
                <div class = "register col-sm-8 col-md-6 col-lg-4 p-4" >
                    <h4 class="text-center text-white mb-5">Crea una cuenta</h4>

                    <?php include("../../../back/registro/insertarusuario.php"); ?>

                    <form action="" method="post">
                        <div class="mb-4">
                            <label class="form-label" for="nombre">Nombre(s)</label>
                            <input class="form-control" name="nombre" type="text" placeholder="" required />
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="apaterno">Apellido paterno</label>
                            <input class="form-control" name="apaterno" type="text" required/>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="amaterno">Apellido materno</label>
                            <input class="form-control" name="amaterno" type="text" />
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="correo">Correo electrónico</label>
                            <input class="form-control" name="correo" type="email" placeholder="correo@ejemplo.com" required />
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="contrasena">Contraseña</label>
                            <input class="form-control" name="contrasena" type="password" required />
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="numero">Teléfono</label>
                            <input class="form-control" name="numero" type="tel" />
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="tipousuario">¿Qué función cumplirás?</label>
                            <select id="cars" name="tipousuario" class="form-control">
                                <option value="conductor">Dar raite</option>
                                <option value="pasajero">Pedir raite</option>
                              </select>
                        </div>
                        <div class="mb-4">
                            <input class="btn btn-warning w-100 mt-4" type="submit" value="Crear cuenta"/>
                        </div>
                    </form>
                    <p class="text-white text-center">
                        ¿Ya tienes una cuenta?
                        <a href="components/login/login.php" style="text-decoration: none;">
                            Inicia sesión aquí
                        </a>
                    </p>
                </div>
            </section>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    </body>
</html>