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

    include '../../../back/conexion.php';
    $conexion = conectar();

    $sql = "SELECT * FROM raite WHERE idraitero = $user";
    $query = mysqli_query($conexion, $sql);
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
    <title>Inicio</title>
  </head>
  <body>
      <div class="barraTop">
        <img src="./img/bee.png" alt="Logo BeeRaites" class="logoBeeRaites">
        <p class="nombrePagina"> BeeRaites</p>
        <a href="components/login/login.php" class="btn btn-dark btnIniciar">Iniciar sesion</a>
        <a href="components/registro/insertarusuario.php" class="btn btn-light btnRegistrar">Registrarse</a>
      </div>
    <a href="../../../back/login/control_logout.php" class="btn btn-danger">Salir</a>
    <!-- <a href="../draite/raite.php?user=<?php echo $user ?>" class="btn btn-primary">Ofrecer raite</a> -->

    <div class="Cabecera" style="display:flex; justify-content:space-around">
        <p>Raites</p>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">+</button>
    </div>

    <div class="mx-auto" style="width: 80%">
      <table class="table bg-warning" style="color:white; text-align:center; vertical-align:middle; border:7px white solid">
        <thead class="bg-dark" style="color:white">
          <tr>
            <!-- <th scope="col">ID</th>
            <th scope="col">ID Conductor</th> -->
            <th scope="col">Origen</th>
            <th scope="col">Destino</th>
            <th scope="col">Hora</th>
            <th scope="col">Pasa por</th>
            <th scope="col">Lugares</th>
            <th scope="col">Pasajeros</th>
          </tr>
        </thead>
        <tbody class="bg-warning" style="color:white;">
            <?php while($row = mysqli_fetch_array($query)){ ?>

              <tr style=" border:7px white solid; margin:2px" >
                <td><?php echo $row['origen'] ?></td>
                <td><?php echo $row['destino'] ?></td>
                <td><?php echo $row['hora'] ?></td>
                <td style="width: 28%;"><?php echo $row['pasapor'] ?></td>
                <td><?php echo $row['lugares'] ?></td>

                <!-- Pasajeros -->
                <?php
                  $sqlPasajeros = "SELECT nombre, apaterno, numero 
                    FROM usuario 
                    INNER JOIN apartar 
                    ON apartar.id_usuario = usuario.id 
                    WHERE apartar.id_raite = $row[id]";

                  $queryPasajeros = mysqli_query($conexion, $sqlPasajeros);
                ?>

                <td style="width: 25%; text-align:left"> 
                  <?php while($pasajeros = mysqli_fetch_array($queryPasajeros)){ ?>
                    <p style="padding: 0; margin:0"><?php echo $pasajeros['nombre'] . " " . $pasajeros['apaterno'] . " "?>
                    <a href="https://wa.me/<?php echo $pasajeros["numero"] ?>"><?php echo $pasajeros["numero"] ?><img src="../../img/whatsapp.svg" alt=""> </a> </p>
                  <?php } ?>
                </td>

              </tr>
             
            <?php } ?>
        </tbody>

      </table>
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