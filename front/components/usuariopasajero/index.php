<?php
    session_start();
    include '../../../back/conexion.php';
    if(empty($_SESSION["id"])){
      header('location: ../login/login.php');
    }
    if($_SESSION["tipousuario"] == 'conductor'){
      header('location: ../usuarioconductor/index.php');
    }
    $user = $_SESSION["id"];

    $conexion = conectar();
    $raites = "SELECT u.nombre, r.id, r.origen, r.destino, r.hora, r.dias FROM usuario u 
                  JOIN apartar a ON u.id = a.id_usuario 
                  JOIN raite r ON a.id_raite = r.id 
                  WHERE u.id = $user";
    $rraites = mysqli_query($conexion, $raites);

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
    <a href="./verraites.php" class="btn btn-success">Apartar raite</a>
    <div class="container">
      <h2>Raites apartados</h2>
      <table>
        <thead>
          <tr>
            <td><b>Origen</b></td>
            <td><b>Destino</b></td>
            <td><b>Hora</b></td>
            <td><b>Dias</b></td>
            <td><b>Contacto del conductor</b></td>
            <td></td>
          </tr>
        </thead>
        <tbody>
            <?php while($raite=mysqli_fetch_array($rraites)){ ?>
              <tr>
                  <td><?php echo $raite['origen'] ?></td>
                  <td><?php echo $raite['destino'] ?></td>
                  <td><?php echo $raite['hora'] ?></td>
                  <td><?php echo $raite['dias'] ?></td>
                  <?php
                    $idraite = $raite['id'];
                    $contactos = "SELECT u.numero FROM usuario u JOIN raite r ON u.id = r.idraitero WHERE r.id = $idraite";
                    $rcontactos = mysqli_query($conexion, $contactos);
                    $contacto=mysqli_fetch_array($rcontactos)
                  ?>
                  <td><?php echo $contacto['numero'] ?></td>
                  <td>
                      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#raite<?php echo $raite['id']?>">
                          Cancelar raite
                      </button>
                      <div class="modal fade" id="raite<?php echo $raite['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <form action="../../../back/raite/acancelar.php" method="post">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Confirmacion</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body text-center">
                                          <!-- No se bien que mensaje poner -->
                                          Esta por cancelar un  raite de <b><?php echo $raite['origen']?></b> a <b><?php echo $raite['destino']?></b>
                                          <br>
                                          Te sugerimos contactar al conductor en caso de que lo requiera <b><?php echo $contacto['numero']?></b>
                                          <p>Estas seguro que deseas continuar?</p>

                                          <input type="text" name="idraite" class="d-none" value="<?php echo $raite['id']?>">
                                          <input type="text" name="idpasajero" class="d-none" value="<?php echo $user?>">
                                      </div>
                                      <div class="modal-footer">
                                      <input type="submit" class="btn btn-primary mb-2" value="Aceptar">
                                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>    
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </td>
              </tr>

            <?php } ?>

        </tbody>
      </table>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>