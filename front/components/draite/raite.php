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

    <title>Hello, world!</title>
  </head>
  <body>
    
    <section class="text-center">
        <div class="p-5 bg-image" style="
              background-image: url('../../img/headerregistro.jpg');
              height: 200px;">
        </div>
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
              <?php include("../../../back/raite/draite.php"); ?>
                  <form action="" method="post">
                      <input type="text" name="origen" placeholder="Origen" class="form-control mb-3">
                      <input type="text" name="destino" placeholder="Destino" class="form-control mb-3">
                      <input type="text" name="hora" placeholder="Hora salida" class="form-control mb-3">
                      <input type="text" name="pasapor" placeholder="Lugares por donde pasa" class="form-control mb-3">
                      <input type="text" name="fotoauto" placeholder="Pon la fotoauto" class="form-control mb-3">
                      <select id="cars" name="lugares" class="form-control mb-3">
                        <option value="none">Elige tus lugares disponibles</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                      </select>
                      <div id="contbut">
                        <input type="submit" class="btn btn-info mb-2" name="btnregistro" style="width: 100%;">
                        <a href="../usuarioconductor/index.php" class="btn btn-light" style="width: 100%;">Regresar</a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>