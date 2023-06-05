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

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <!-- Bootstrap, fonts, and CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Red+Hat+Display:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"/>
        <link rel="stylesheet" href="../../styles/usuarioconductor.css">

        <title>Raites</title>
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
                <div class="navbar">
                    <h3 class="text-white">Raites apartados</h3>
                    <a class="btn btn-warning" href="./verraites.php">
                        <i class="bi bi-car-front-fill me-2"></i>
                        Apartar Raite
                    </a>
                </div>
                <table id="tablaraites" class="table table-dark table-striped table-hover mt-3">
                    <thead>
                        <tr>
                            <th><i class="bi bi-geo-fill me-md-2"></i></i>Origen</th>
                            <th><i class="bi bi-geo-alt-fill me-md-2"></i>Destino</th>
                            <th><i class="bi bi-clock me-md-2"></i>Hora</th>
                            <th><i class="bi bi-calendar-event me-md-2"></i>Días</th>
                            <th><i class="bi bi-person-badge-fill me-2"></i>Nombre y contacto del conductor</th>
                            <th> </th>
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
                                  $contactos = "SELECT u.numero, u.nombre, u.apaterno FROM usuario u JOIN raite r ON u.id = r.idraitero WHERE r.id = $idraite";
                                  $rcontactos = mysqli_query($conexion, $contactos);
                                  $contacto=mysqli_fetch_array($rcontactos)
                                ?>
                                <td>
                                    <?php echo $contacto['nombre'].' '. $contacto['apaterno'].' - '.$contacto['numero'] ?> </a> <i class="bi bi-whatsapp" style="margin-left: 3px;"></i>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#raite<?php echo $raite['id']?>">
                                        <i class="bi bi-x"></i>
                                    </button>
                                    <div class="modal fade" id="raite<?php echo $raite['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="../../../back/raite/acancelar.php" method="post">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Confirmación de cancelación</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <!-- No se bien que mensaje poner -->
                                                        ¿Deseas cancelar un  raite de <b><?php echo $raite['origen']?></b> a <b><?php echo $raite['destino']?></b>?
                                                        <br>
                                                        Te sugerimos contactar al conductor en caso de ser necesario <b><?php echo $contacto['numero']?></b>
          
                                                        <input type="text" name="idraite" class="d-none" value="<?php echo $raite['id']?>">
                                                        <input type="text" name="idpasajero" class="d-none" value="<?php echo $user?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                    <input type="submit" class="btn btn-success mb-2" value="Aceptar">
                                                        <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">No</button>    
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
            </section>
        </main>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script src="raitesapartados.js"></script>
    </body>
</html>