<?php 
    include("conexion.php");
    $conexion = conectar();
    $nombre = $_POST['nombre'];
    $apaterno = $_POST['apaterno'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $numero = $_POST['numero'];
    $tipousuario = $_POST['tipousuario'];

    $query = "INSERT INTO usuario (nombre, apaterno, correo, contrasena, fotoperfil, numero, tipousuario) 
                VALUES('$nombre', '$apaterno', '$correo', '$contrasena', '', '$numero', '$tipousuario')";

    $resultado = mysqli_query($conexion, $query);

    if($resultado) {
        header('location: ../front/index.php');
    } else {
        echo 'FUCK ';
    }
?>