<?php
    session_start();
    if(empty($_SESSION["id"])){
        header('location: ../login/login.php');
    }
    if($_SESSION["tipousuario"] == 'pasajero'){
      header('location: ../usuariopasajero/index.php');
    }
    $user = $_SESSION["id"];
    // $user = $_GET['user'];
    echo "usuario conductor con nua:";
    echo $user;
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

    <a href="../../../back/login/control_logout.php" class="btn btn-danger">Salir</a>
    <!-- <a href="../draite/raite.php?user=<?php echo $user ?>" class="btn btn-primary">Ofrecer raite</a> -->

    <div class="Cabecera" style="display:flex; justify-content:space-around">
        <p>Raites</p>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">+</button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Registar nuevo raite</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form action="../../../back/raite/draite.php" method="POST" class="form">
            <input type="text" disabled="disabled" name="idRaitero" placeholder="<?php echo 'ID: ' . $user ?>" value="<?php $user ?>" class="form-control mb-3">
            <input type="text" name="origen" placeholder="Origen" class="form-control mb-3">
            <input type="text" name="destino" placeholder="Destino" class="form-control mb-3">
            <input type="time" name="hora" placeholder="Hora salida" class="form-control mb-3">
            <input type="text" name="pasapor" placeholder="Lugares por donde pasa" class="form-control mb-3">
            <select id="cars" name="lugares" class="form-control mb-3">
              <option value="none">Elige tus lugares disponibles</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select>
            
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Registar</button>
            </div>

          </form>

        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>