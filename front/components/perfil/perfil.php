<?php
    include ("../../../mcript.php");
    include ("../../../back/conexion.php");
    session_start();
    $tipo = '';
    if(empty($_SESSION["id"])){
        header('location: ../login/login.php');
    } 
    if($_SESSION["tipousuario"] == 'pasajero'){
        $tipo = '../usuariopasajero/index.php';
    } else {
        $tipo = '../usuarioconductor/index.php';
    }
    $user = $_SESSION["id"];
    $conexion = conectar();
    $query = "SELECT * FROM usuario WHERE id=$user";
    $resultado = mysqli_query($conexion, $query);

    $usuario=mysqli_fetch_array($resultado)
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
    <link rel="stylesheet" href="../../style/perfil.css">
    <title>Perfil</title>
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
                            <a class="btn btn-warning me-md-2" href="<?php echo $tipo ?>">
                                Inicio
                            </a>
                            <a class="btn btn-outline-warning" href="../../../back/login/control_logout.php"> <!--./login.html-->
                                Salir
                            </a>
                        </div>
                    </div>
                </section>
            </nav>
            </header>
            <main style="margin-top: 15vh;">
                <?php include("../../../back/perfil/upload.php"); ?>
                <?php include("../../../back/perfil/editar.php"); ?>

                <div class="container mt-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-7">
                        <div class="card p-3 py-4">
                            <div class="text-center">
                                <?php if($usuario['fotoperfil'] == null): ?>
                                    <img src="../../img/perfiles/default.jpg" width="100" class="rounded-circle">
                                <?php else: ?>
                                    <img src="../../img/perfiles/<?php echo $usuario['fotoperfil'] ?>" width="100" class="rounded-circle">  
                                <?php endif; ?>
                                <?php if(!empty($user)): ?>
                                <?php else: ?>
                                <?php endif; ?>
                            </div>
                            
                            <div class="text-center mt-3">
                                <span class="bg-secondary p-1 px-4 rounded text-white"><?php echo $usuario['tipousuario'] ?></span>
                                <h5 class="mt-2 mb-0"><?php echo $usuario['nombre'] . " " . $usuario['apaterno'] . " " . $usuario['amaterno'] ?></h5>
                                <span>Numero: <?php echo $usuario['numero']?></span>
                                
                                <div class="buttons mt-3">
                                    <button type="button" class="btn btn-outline-primary px-4" data-bs-toggle="modal" data-bs-target="#modalfoto">
                                        Editar imagen de perfil
                                    </button>
                                    <button type="button" class="btn btn-primary px-4 ms-3" data-bs-toggle="modal" data-bs-target="#modaleditar">
                                        Editar datos
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <div class="modal fade" id="modalfoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Sube tu foto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                        <input type="file" name="file">
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-primary mb-2" name="btnarchivo" value="Aceptar">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modaleditar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="text" name="nombre" placeholder="Nombre" class="form-control mb-3" value="<?php echo $usuario['nombre']?>">
                                    <input type="text" name="apaterno" placeholder="Apellido paterno" class="form-control mb-3" value="<?php echo $usuario['apaterno']?>">
                                    <input type="text" name="amaterno" placeholder="Apellido materno" class="form-control mb-3" value="<?php echo $usuario['amaterno']?>">
                                    <input type="password" name="contrasena" placeholder="Ingresa la contraseña nueva" class="form-control mb-3" value="<?php $pssdecript = $desencriptar($usuario['contrasena']); echo $pssdecript ?>">
                                    <input type="number" name="numero" placeholder="Numero Telefonico" class="form-control mb-3" value="<?php echo $usuario['numero']?>">
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-primary mb-2" name="btneditar" value="Aceptar">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    
  </body>
</html>