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
    $query = "SELECT * FROM raite";
    $resultado = mysqli_query($conexion, $query);

    $existeraite = "SELECT * FROM apartar WHERE id_usuario = $user";
    $rexisteraite = mysqli_query($conexion, $existeraite);
    $raitexiste=mysqli_fetch_array($rexisteraite);
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
        <title>Hello, world!</title>
    </head>
    <body>       
        <div class="container mt-5 ">
            <table id="tablaraites" class="table table-striped">
                <thead>
                    <tr>
                        <th style="vertical-align: middle;">Origen</th>
                        <th style="vertical-align: middle;">Destino</th>
                        <th style="vertical-align: middle;">Hora de salida</th>
                        <th style="vertical-align: middle;">Dias</th>
                        <th style="vertical-align: middle;">Lugares disponibles</th>
                        <th style="vertical-align: middle;">Lugares por donde pasa</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Me falta un if para que no salga un raite que ya se aparto 
                    pero ocupo la tabla donde se apartan los raites -->
                    <?php while($raite=mysqli_fetch_array($resultado)){ ?>
                        <?php if( ($raite['lugares'] > 0) && ($raitexiste['id_raite']!=$raite['id'])): ?>
                            <tr>
                                <td><?php echo $raite['origen'] ?></td>
                                <td><?php echo $raite['destino'] ?></td>
                                <td><?php echo $raite['hora'] ?></td>
                                <td><?php echo $raite['dias'] ?></td>
                                <td><?php echo $raite['lugares'] ?></td>
                                <td><?php echo $raite['pasapor'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#raite<?php echo $raite['id']?>">
                                        Apartar
                                    </button>
                                    <div class="modal fade" id="raite<?php echo $raite['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!--
                                                    Formulario para apartar raite
                                                 -->
                                                <form action="../../../back/raite/praite.php?id=<?php echo $raite['id']?>" method="post">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Confirmacion</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- No se bien que mensaje poner -->
                                                        Esta por apartar un  raite de <b><?php echo $raite['origen']?></b> a <b><?php echo $raite['destino']?></b>
                                                        <br>
                                                        <p>Estas seguro que deseas continuar?</p>

                                                        <input type="text" name="idraite" class="d-none" value="<?php echo $raite['id']?>" disabled>
                                                        <input type="text" name="idpasajero" class="d-none" value="<?php echo $user?>" disabled>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <input type="submit" class="btn btn-primary mb-2" name="btnapartar" value="Aceptar">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>    
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            
                        <?php endif; ?>

                    <?php } ?>
                </tbody>
            </table>
        </div>
        <a href="../usuariopasajero/index.php" class="btn btn-danger">Regresar</a>
        


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script src="../../../back/raite/verraites.js"></script>
    </body>
</html>