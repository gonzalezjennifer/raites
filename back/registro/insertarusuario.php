<?php 
    include("../conexion.php");
    include ("../../mcript.php");
    $conexion = conectar();
    $nombre = $_POST['nombre'];
    $apaterno = $_POST['apaterno'];
    $amaterno = $_POST['amaterno'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $contrasena_encriptada = $encriptar($contrasena);
    $numero = $_POST['numero'];
    $tipousuario = $_POST['tipousuario'];

    $query = "INSERT INTO usuario (nombre, apaterno, amaterno, correo, contrasena, fotoperfil, numero, tipousuario) 
                VALUES('$nombre', '$apaterno', '$amaterno', '$correo', '$contrasena_encriptada', '', '$numero', '$tipousuario')";

    $resultado = mysqli_query($conexion, $query);

    if($resultado) {
        header('location: ../../front/index.html');
    } else {
        
        echo 'FUCK ';
    }
?>