<?php
    session_start();
    include '../../../back/conexion.php';
    if(empty($_SESSION["id"])){
        header('location: ../login/login.php');
    }
    if($_SESSION["tipousuario"] == 'pasajero'){
      header('location: ../usuariopasajero/index.php');
    }
    $user = $_SESSION["id"];
    $conexion = conectar();

    $sql = "SELECT * FROM raite WHERE idraitero = $user";
    $query = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html>
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

        <title>Inicio</title>
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
            <!-- Table section -->
            <section class="container-md">
                <div>
                    <?php include '../../../back/raite/draite.php' ?>
                </div>
                <div class="navbar">
                    <h3 class="text-white">Raites</h3>
                    <button type="button" 
                        class="btn btn-warning" 
                        data-bs-toggle="modal" 
                        data-bs-target="#exampleModal" 
                    >
                        <i class="bi bi-plus-circle me-1"></i>
                        Nuevo Raite
                    </button>
                </div>

                <table id="tablaraites" class="table table-dark table-striped table-hover mt-3">
                    <thead>
                        <tr>
                            <th><i class="bi bi-geo-fill me-md-2"></i>Origen</th>
                            <th><i class="bi bi-geo-alt-fill me-md-2"></i>Destino</th>
                            <th><i class="bi bi-clock me-md-2"></i>Hora</th>
                            <th><i class="bi bi-calendar-event me-md-2"></i>Días</th>
                            <th><i class="bi bi-houses-fill me-md-2"></i>Pasa por</th>
                            <th><i class="bi bi-diagram-3 me-md-2"></i>Lugares</th>
                            <th><i class="bi bi-people-fill me-2"></i>Pasajeros</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_array($query)){ ?>
                        <tr>
                            <td><?php echo $row['origen'] ?></td>
                            <td><?php echo $row['destino'] ?></td>
                            <td><?php echo $row['hora'] ?></td>
                            <td><?php echo $row['dias'] ?></td>
                            <td><?php echo $row['pasapor'] ?></td>
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
                                <p style="padding: 0; margin:0"><?php echo $pasajeros['nombre'] . " " . $pasajeros['apaterno'] . " - "?>
                                <?php echo $pasajeros["numero"] ?><a href="https://wa.me/52<?php echo $pasajeros["numero"] ?>"> </a><i class="bi bi-whatsapp" style="margin-left: 5px;"></i></p>
                              <?php } ?>
                            </td>
        
                            <td style="text-align:center;">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#raite<?php echo $row['id']?>">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                              <div class="modal fade" id="raite<?php echo $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <form action="../../../back/raite/ccraite.php" method="post">
                                              <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Confirmacion</h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body text-center">
                                                  ¿Quieres cancelar un raite de <b><?php echo $row['origen']?></b> a <b><?php echo $row['destino']?></b>?

                                                  <input type="text" name="idraite" class="d-none" value="<?php echo $row['id']?>">
                                              </div>
                                              <div class="modal-footer">
                                              <input type="submit" class="btn btn-success mb-2" value="Aceptar">
                                                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>    
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
        
            <!-- Modal -->
            <section class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                <i class="bi bi-car-front-fill me-2"></i>
                                Agendar nuevo raite
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="POST" class="form">
                            <div class="modal-body">
                                <div class="mb-4">
                                    <label class="form-label" for="idRaitero">Conductor</label>
                                    <input type="text" class="form-control" disabled="disabled" name="idRaitero" placeholder="<?php echo 'ID: ' . $user ?>" value="<?php $user ?>" />
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="origen">Origen</label>
                                    <input type="text" class="form-control" name="origen" placeholder="Irapuato" />
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="destino">Destino</label>
                                    <input type="text" class="form-control" name="destino" placeholder="DICIS" />
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="hora">Hora de salida</label>
                                    <input type="time" class="form-control" name="hora" />
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="pasapor">Sitios por donde pasa</label>
                                    <input type="text" class="form-control" name="pasapor" placeholder="Central, plaza..." />
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="lugares">Lugares disponibles</label>
                                    <select id="cars" class="form-control" name="lugares">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                                <div>
                                    <span>
                                        Elige los días de tu raite
                                    </span>
                                    <div class="mb-3 align-center list-group">
                                        <label class="list-group-item">
                                            <input class="form-check-input me-1" type="checkbox" name="Lunes" value="Lunes"> Lunes
                                        </label>
                          
                                        <label class="list-group-item">
                                            <input class="form-check-input me-1" type="checkbox" name="Martes" value="Martes" > Martes
                                        </label>
                          
                                        <label class="list-group-item">
                                            <input class="form-check-input me-1" type="checkbox" name="Miercoles" value="Miercoles" > Miercoles
                                        </label>
                          
                                        <label class="list-group-item">
                                            <input class="form-check-input me-1" type="checkbox" name="Jueves" value="Jueves" > Jueves
                                        </label>
                          
                                        <label class="list-group-item">
                                            <input class="form-check-input me-1" type="checkbox" name="Viernes" value="Viernes" > Viernes
                                        </label>
                          
                                        <label class="list-group-item">
                                            <input class="form-check-input me-1" type="checkbox" name="Sabado" value="Sabado" > Sabado
                                        </label>
                          
                                        <label class="list-group-item">
                                            <input class="form-check-input me-1" type="checkbox" name="Domingo" value="Domingo" > Domingo
                                        </label>
                                    </div>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" >Cancelar</button>
                                <input type="submit" class="btn btn-success" value="Publicar" id="btndarraite" name="btndarraite"></input>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </main>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script src="raites.js"></script>

    </body>
</html>