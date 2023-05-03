<?php 
    include("../conexion.php");
    include ("../../mcript.php");
    $nombre = $_POST['nombre'];
    $apaterno = $_POST['apaterno'];
    $amaterno = $_POST['amaterno'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $contrasena_encriptada = $encriptar($contrasena);
    $numero = $_POST['numero'];
    $tipousuario = $_POST['tipousuario'];

    $sql = "INSERT INTO usuario (nombre, apaterno, amaterno, correo, contrasena, numero, tipo) 
                VALUES('$nombre', '$apaterno', '$amaterno', '$correo', '$contrasena_encriptada', '$numero', '$tipousuario')";

    if($conn->query($sql) === TRUE) {
        header('location: https://raites.000webhostapp.com/index.html');
    } else {
        
        echo 'FUCK';
    }
    $conn->close();
?>