<?php
  include ("../../../back/conexion.php");
  include ("../../../mcript.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Red+Hat+Display:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../style/login.css">
    <title>Raites</title>
  </head>
  <body style="background-color: whitesmoke;">
    <div class="principal">
    <div class="barraTop">
    <img src="../../img/bee.png" alt="Logo BeeRaites" class="logoBeeRaites">
    <p class="nombrePagina"> BeeRaites</p>
  </div>
  <section class=" gradient-custom" style="height: 92vh">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center" style="height: 80%">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card text-white" style="border-radius: 1rem; background-color: #dab600;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-5 text-uppercase">Login</h2>
              
              <?php 
                include("../../../back/login/control_login.php");
              ?>

              <form action="" method="post">
                <input type="email" name="correo" placeholder="Correo" class="form-control mb-3">
                <input type="password" name="contrasena" placeholder="Ingresa la contraseña" class="form-control mb-3">
                <div class="botones">
                  <a href="../../index.html" class="btn btn-light" style="width: 40%; height: 10%;">Regresar</a>
                  <input type="submit" name="btningresar" class="btn btn-dark mb-3" value="Iniciar sesion" style="width: 40%; height: 10%; margin-left: 10px;">
                </div>
              </form>

            </div>

            <div>
              <p class="mb-0">Don't have an account? <a href="../registro/insertarusuario.php" class="text-black-50 fw-bold">Sign Up</a>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>