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
    <link rel="stylesheet" href="../../style/usuarioconductor.css">
    <title>Inicio</title>
  </head>
  <body>
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
              <button
                  type = "button"
                  class = "navbar-toggler"
                  data-bs-toggle = "collapse"
                  data-bs-target = "#navbarButtons"
                  aria-controls="navbarButtons" 
                  aria-expanded="false" 
                  aria-label="Toggle navigation"
              >
                  <span class = "navbar-toggler-icon"></span>
              </button>
              <div id = "navbarButtons" class="collapse navbar-collapse justify-content-md-end" >
                  <div class=" d-grid gap-2 d-md-flex"> <!--Alt: " d-grid gap-2 d-md-flex justify-content-md-end"--> <!--gap-2: separation-->
                      <a class="btn btn-warning me-md-2" href="../perfil/perfil.php">
                          Perfil
                      </a>
                      <a class="btn btn-outline-warning" href="../../../back/login/control_logout.php"> <!--./login.html-->
                          Salir
                      </a>
                  </div>
              </div>
          </section>
      </nav>
    </header>
    <main class="container">
      <!-- <a href="../draite/raite.php?user=<?php echo $user ?>" class="btn btn-primary">Ofrecer raite</a> -->

      <div class="Cabecera mb-3" style="display:flex;">
          <h3 style="margin-left: 9vw;">Raites</h3>
          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin-left: 54vw;">Nuevo Raite</button>
      </div>

      <div class="mx-auto" style="width: 80%">
        <table class="table table-striped table-dark" style="color:white; text-align:center; vertical-align:middle; border-collapse: collapse!important;">
          <thead style="color:white">
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
          <tbody class="table-warning" style="color:black;">
              <?php while($row = mysqli_fetch_array($query)){ ?>

                <tr style=" border:3px white solid; margin:2px" >
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



              <div class="btn-group-vertical form-control mb-3">
                <button class="btn" type="button" id="dropdownMenuClickable" data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false">
                  Elige los dias de tu raite
                </button>
                <ul class="dropdown-menu form-control mb-3 align-center" aria-labelledby="dropdownMenuClickable">
                  <li><label class="btn btn-primary dropdown-item">
                      <input class="form-check-input" type="checkbox" name="Lunes" value="Lunes"> Lunes
                    </label>
                  </li>
                  <li><label class="btn btn-primary dropdown-item">
                      <input class="form-check-input" type="checkbox" name="Martes" value="Martes" > Martes
                    </label>
                  </li>
                  <li><label class="btn btn-primary dropdown-item">
                      <input class="form-check-input" type="checkbox" name="Miercoles" value="Miercoles" > Miercoles
                    </label>
                  </li>
                  <li><label class="btn btn-primary dropdown-item">
                      <input class="form-check-input" type="checkbox" name="Jueves" value="Jueves" > Jueves
                    </label>
                  </li>
                  <li><label class="btn btn-primary dropdown-item">
                      <input class="form-check-input" type="checkbox" name="Viernes" value="Viernes" > Viernes
                    </label>
                  </li>
                  <li><label class="btn btn-primary dropdown-item">
                      <input class="form-check-input" type="checkbox" name="Sabado" value="Sabado" > Sabado
                    </label>
                  </li>
                  <li><label class="btn btn-primary dropdown-item">
                      <input class="form-check-input" type="checkbox" name="Domingo" value="Domingo" > Domingo
                    </label>
                  </li>
                </ul>
              </div>




              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Registar</button>
              </div>

            </form>

          </div>
        </div>
      </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>