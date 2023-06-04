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
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- Bootstrap, fonts, and CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Red+Hat+Display:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"/>
        <link rel="stylesheet" href="../../styles/verraites.css" />

        <title>Raites disponibles</title>
    </head>
    <body style="background-color: #0d1117;">
        <header>
            <!-- Navbar section -->
            <nav class="navbar navbar-expand-md navbar-dark fixed-top shadow" style="background-color: #161b22;">
                <section class="container-md">
                    <a class="navbar-brand mb-0 h1 fs-3">
                        <img class = "d-inline-block align-text-center" src="../../img/logo160x160.png" width="50" height="50"/>
                        <span class = "bee-logo">
                            <span class="text-warning">Bee</span>Raites <!--##ffe484-->
                        </span>
                    </a>
                    
                    <div class="dropdown">
                        <button class = "btn dropdown-toggle hidden-arrow btn-show-menu"
                            type = "button"
                            id = "dropdownUserMenu"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <i class="bi bi-person-circle"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="dropdownUserMenu">
                            <li><a class="dropdown-item" href="../perfil/perfil.php"><i class="bi bi-person-fill me-2"></i>Mi Perfil</a></li>
                            <li><a class="dropdown-item" href="../../../back/login/control_logout.php"><i class="bi bi-box-arrow-right me-2"></i>Salir</a></li>
                        </ul> 
                    </div>
                </section>
            </nav>
        </header>
        <main>
            <section class="container-md">
                <div id="noap">
                    <?php include '../../../back/raite/praite.php' ?>
                </div>
                <div class="navbar">
                    <h3 class="text-white">Raites disponibles</h3>
                    <a class="btn btn-warning" href="./verraites.php">
                        <i class="bi bi-car-front-fill me-2"></i>
                        Consultar Raites
                    </a>
                </div>
                <table id="tablaraites" class="table table-dark table-striped table-hover mt-3">
                    <thead>
                        <tr>
                            <th><i class="bi bi-geo-fill me-md-2"></i>Origen</th>
                            <th><i class="bi bi-geo-alt-fill me-md-2"></i>Destino</th>
                            <th><i class="bi bi-clock me-md-2"></i>Hora de salida</th>
                            <th><i class="bi bi-calendar-event me-md-2"></i>Días</th>
                            <th><i class="bi bi-people-fill me-2"></i>Lugares disponibles</th>
                            <th><i class="bi bi-houses-fill me-md-2"></i>Sitios por donde pasa</th>
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
                                                    <form action="" method="post">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Confirmación de apartado</h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- No se bien que mensaje poner -->
                                                            ¿Deseas apartar un  raite de <b><?php echo $raite['origen']?></b> a <b><?php echo $raite['destino']?></b>?

                                                            <input type="text" name="idraite" class="d-none" value="<?php echo $raite['id']?>">
                                                            <input type="text" name="hora" class="d-none" value="<?php echo $raite['hora']?>">
                                                            <input type="text" name="idpasajero" class="d-none" value="<?php echo $user?>" disabled>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="submit" class="btn btn-primary" name="btnapartar" value="Aceptar" id="btnapartar">
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>    
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
            </section>
        </main>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script src="../../../back/raite/verraites.js"></script>
    </body>
</html>