<?php
    include ("../../../mcript.php");
    include ("../../../back/conexion.php");
    session_start();
    if(empty($_SESSION["id"])){
        header('location: ../login/login.php');
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
    <title>Perfil</title>
  </head>
  <body>
    <?php include("../../../back/perfil/upload.php"); ?>
    <?php include("../../../back/perfil/editar.php"); ?>

    <?php if($usuario['fotoperfil'] == null): ?>
        <img src="../../img/perfiles/default.jpg" style="width: 20%;">
    <?php else: ?>
        <img src="../../img/perfiles/<?php echo $usuario['fotoperfil'] ?>" style="width: 20%;">  
    <?php endif; ?>
    <br>

    <?php if(!empty($user)): ?>
    <?php else: ?>
    <?php endif; ?>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalfoto">
        Editar imagen de perfil
    </button>

    <table>
        <tbody>
            <tr>
                <td>Nombre:</td>
                <td><?php echo $usuario['nombre']?></td>
            </tr>
            <tr>
                <td>Apaterno:</td>
                <td><?php echo $usuario['apaterno']?></td>
            </tr>
            <tr>
                <td>Amaterno:</td>
                <td><?php echo $usuario['amaterno']?></td>
            </tr>
            <tr>
                <td>Contraseña:</td>
                <td><?php 
                    $pssdecript = $desencriptar($usuario['contrasena']);
                    echo $pssdecript
                ?></td>
            </tr>
            <tr>
                <td>Numero:</td>
                <td><?php echo $usuario['numero']?></td>
            </tr>
            <tr>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaleditar">
                        Editar datos
                    </button>
                </td>
                <td>
                    <?php if($usuario['tipousuario'] == 'pasajero'): ?>
                        <a href="../usuariopasajero/index.php" class="btn">Regresar</a>
                    <?php else: ?>
                        <a href="../usuarioconductor/index.php" class="btn">Regresar</a>
                    <?php endif; ?>
                    
                </td>
 
            </tr> 
        </tbody>
    </table>

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
                        <input type="password" name="contrasena" placeholder="Ingresa la contraseña nueva" class="form-control mb-3">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    
  </body>
</html>