<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/insertarusuario.css">
    <title>Registro</title>
  </head>
  <body>


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h1>Ingresa los datos</h1>
                <form action="../../back/insertarusuario.php" method="post">
                    <input type="text" name="nombre" placeholder="Ingresa el nombre" class="form-control mb-3">
                    <input type="text" name="apaterno" placeholder="Ingresa el apellido paterno" class="form-control mb-3">
                    <input type="text" name="amaterno" placeholder="Ingresa el apellido materno" class="form-control mb-3">
                    <input type="email" name="correo" placeholder="Ingresa el correo" class="form-control mb-3">
                    <input type="password" name="contrasena" placeholder="Ingresa la contraseña" class="form-control mb-3">
                    <input type="number" name="numero" placeholder="Ingresa el numero de contacto" min="0" max="9999999999" class="form-control mb-3">
                    <label for="cars" class="mb-3">Elige que deseas hacer</label>
                    <select id="cars" name="tipousuario" class="form-control mb-3">
                      <option value="conductor">Dar raite</option>
                      <option value="pasajero">Pedir raite</option>
                    </select>
                    <input type="submit" class="btn btn-primary" style="width: 100%;">
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>