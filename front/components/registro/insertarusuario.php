<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/insertarusuario.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:wght@200&display=swap" rel="stylesheet">
    <title>Registro</title>
  </head>
  <body style="background-color: #115372;">
    <!-- Section: Design Block -->
    <section class="text-center">
      <!-- Background image -->
      <div class="p-5 bg-image" style="
            background-image: url('../../img/headerregistro.jpg');
            height: 200px;">
      </div>
      <!-- Background image -->

      <div class="card mx-4 mx-md-5 shadow-5-strong" style="
            margin-top: -100px;
            background: hsla(0, 0%, 100%, 0.8);
            backdrop-filter: blur(30px);
            ">
        <div class="card-body py-5 px-md-5">

          <div class="row d-flex justify-content-center">
            <div class="col-lg-8">
              <h2 class="fw-bold mb-3">Registro</h2>
              <div class="container mt-3">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="../../../back/registro/insertarusuario.php" method="post">
                    <input type="text" name="nombre" placeholder="Nombre" class="form-control mb-3">
                    <input type="text" name="apaterno" placeholder="Apellido paterno" class="form-control mb-3">
                    <input type="text" name="amaterno" placeholder="Apellido materno" class="form-control mb-3">
                    <input type="email" name="correo" placeholder="Correo electronico" class="form-control mb-3">
                    <input type="password" name="contrasena" placeholder="Ingresa la contraseña" class="form-control mb-3">
                    <input type="number" name="numero" placeholder="Numero Telefonico" min="0" max="9999999999" class="form-control mb-3">
                    <label for="cars" class="mb-3">Elige que deseas hacer</label>
                    <select id="cars" name="tipousuario" class="form-control mb-3">
                      <option value="conductor">Dar raite</option>
                      <option value="pasajero">Pedir raite</option>
                    </select>
                    <div id="contbut">
                      <input type="submit" class="btn btn-info mb-2" style="width: 100%;">
                      <a href="../../index.html" class="btn btn-light" style="width: 100%;">Regresar</a>
                    </div>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Section: Design Block -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>