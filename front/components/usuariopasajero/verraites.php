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

    $raitexiste = array();
    while ($row = mysqli_fetch_array($rexisteraite)) {
        $raitexiste[] = $row['id_raite'];
    }

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Red+Hat+Display:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../../style/verraites.css">
        <title>Raites Disponibles</title>
    </head>
    <body>
    <header>
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
                        <a class="btn btn-warning me-md-2" href="../usuariopasajero/index.php">
                            Regresar
                        </a>
                        <a class="btn btn-outline-warning" href="../../../back/login/control_logout.php"> <!--./login.html-->
                            Salir
                        </a>
                    </div>
                </div>
            </section>
        </nav>
    </header>    
    <main>
    <div class="container mt-5 ">
        <div class="Cabecera mb-3" style="display:flex; width:100vw!important;">
            <h3>Raites disponibles</h3>
        </div>
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
                    <?php while($raite=mysqli_fetch_array($resultado)){ ?>
                        <?php if( ($raite['lugares'] > 0) && !in_array($raite['id'], $raitexiste)): ?>
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
                                                        <input type="submit" class="btn btn-primary" name="btnapartar" value="Aceptar">
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
    </main>
        


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script src="../../../back/raite/verraites.js"></script>
    </body>
</html>