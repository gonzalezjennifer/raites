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

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- Bootstrap, fonts, and CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Red+Hat+Display:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"/>
        <link rel="stylesheet" href="../../styles/perfil.css">

        <title>Mi Perfil</title>
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
                            <li><a class="dropdown-item disabled"><i class="bi bi-person-fill me-2"></i>Mi Perfil</a></li>
                            <li><a class="dropdown-item" href="../../../back/login/control_logout.php"><i class="bi bi-box-arrow-right me-2"></i>Salir</a></li>
                        </ul> 
                    </div>
                </section>
           </nav>
        </header>
        <main>
            <section class="container mt-3">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-7">
                        <div class="card p-3 py-4">
                            <div class = "text-center">
                                <?php if($usuario['fotoperfil'] == null): ?>
                                    <img src="../../img/perfiles/default.jpg" width="100" class="rounded-circle" />
                                <?php else: ?>
                                    <img src="../../img/perfiles/<?php echo $usuario['fotoperfil'] ?>" width="100" class="rounded-circle" />  
                                <?php endif; ?>
                                <?php if(!empty($user)): ?>
                                <?php else: ?>
                                <?php endif; ?>
                            </div>
                            <div class="text-center mt-3">
                                <span class="bg-warning rounded p-1 px-4">
                                    <?php echo $usuario['tipousuario'] ?>
                                </span>
                                <h5 class="text-white fw-bold mt-2 mb-2"><?php echo $usuario['nombre'] . " " . $usuario['apaterno'] . " " . $usuario['amaterno'] ?></h5>
                                <span class="text-white">
                                    Número: 
                                    <span style="color: #adb5bd;"><?php echo $usuario['numero']?></span>
                                </span>
                                <div class="buttons mt-3">
                                    <button type="button"
                                        class="btn btn-outline-warning px-4"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalfoto"
                                    >
                                        <i class="bi bi-image-fill me-2"></i>
                                        Editar foto de perfil
                                    </button>
                                    <button type="button"
                                        class="btn btn-warning px-4 ms-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modaleditar"
                                    >
                                        <i class="bi bi-pencil-fill me-2"></i>
                                        Editar datos
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="modal fade" 
                id="modalfoto"
                tabindex="-1"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true"
            >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    <i class="bi bi-image-fill me-2"></i>
                                    Actualizar foto de perfil
                                </h5>
                                <button type="button"
                                class="btn-close btn-close-white"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                                >
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="file" name="file" />
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-success mb-2" name="btnarchivo" value="Guardar">
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <section class="modal fade"
                id="modaleditar"
                data-bs-backdrop="static"
                data-bs-keyboard="false"
                tabindex="-1"
                aria-labelledby="staticBackdropLabel"
                aria-hidden="true"
            >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">
                                    <i class="bi bi-pencil-fill me-2"></i>
                                    Editar datos de perfil
                                </h5>
                                <button type="button"
                                    class="btn-close btn-close-white"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                >
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-4">
                                    <label class="form-label" for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" value="<?php echo $usuario['nombre']?>">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="apaterno">Apellido paterno</label>
                                    <input type="text" class="form-control" name="apaterno" value="<?php echo $usuario['apaterno']?>">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="amaterno">Apellido materno</label>
                                    <input type="text" class="form-control" name="amaterno" value="<?php echo $usuario['amaterno']?>">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="constrasena">Nueva contraseña</label>
                                    <input type="password" class="form-control" name="contrasena" value="<?php $pssdecript = $desencriptar($usuario['contrasena']); echo $pssdecript ?>">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="numero">Número telefónico</label>
                                    <input type="number" class="form-control" name="numero" value="<?php echo $usuario['numero']?>">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-success mb-2" name="btneditar" value="Guardar"/>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    
    </body>
</html>