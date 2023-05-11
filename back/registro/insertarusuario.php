<?php 
    if(!empty($_POST["btnregistro"])){
        if (empty($_POST["nombre"]) || empty($_POST["apaterno"]) || empty($_POST["amaterno"]) || empty($_POST["correo"]) || empty($_POST["contrasena"]) || empty($_POST["numero"]) ){
            echo '<div class="alert alert-danger">CAMPO/S VACIO/S</div>';
        } else {
            $conexion = conectar();
            $nombre = $_POST['nombre'];
            $apaterno = $_POST['apaterno'];
            $amaterno = $_POST['amaterno'];
            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];
            $contrasena_encriptada = $encriptar($contrasena);
            $numero = $_POST['numero'];
            $tipousuario = $_POST['tipousuario'];

            $query = "SELECT * FROM usuario WHERE correo='$correo'";
            $resultado = mysqli_query($conexion, $query);
            $usu=mysqli_fetch_array($resultado);
            if($usu['correo']==$correo) {
                echo '<div class="alert alert-danger">CORREO YA REGISTRADO</div>';
            } elseif (strlen($contrasena)<8) {
                echo '<div class="alert alert-danger">LA CONTRASEÑA DEBE CONTENER MINIMO 8 CARACTERES</div>';
            } elseif (strlen($numero)<10 || strlen($numero)>10){
                echo '<div class="alert alert-danger">EL NUMERO TELEFONICO DEBE CONTENER 10 DIGITOS</div>';
            } else {
                $query = "SELECT * FROM usuario WHERE numero='$numero'";
                $resultado = mysqli_query($conexion, $query);
                $usu=mysqli_fetch_array($resultado);
                if($usu['numero']==$numero) {
                    echo '<div class="alert alert-danger">NUMERO TELEFONICO YA REGISTRADO</div>';
                } else {
                    $query = "INSERT INTO usuario (nombre, apaterno, amaterno, correo, contrasena, fotoperfil, numero, tipousuario) 
                    VALUES('$nombre', '$apaterno', '$amaterno', '$correo', '$contrasena_encriptada', '', '$numero', '$tipousuario')";
                    $resultado = mysqli_query($conexion, $query);
                    if($resultado) {
                        echo '<div class="alert alert-success">REGISTRO EXITOSO</div>';
                    } else {
                        echo '<div class="alert alert-danger">ERROR INESPERADO, INTENTE MAS TARDE</div>';
                    } 
                }
            }

            
        }
    } 
    /*
    $query = "INSERT INTO usuario (nombre, apaterno, amaterno, correo, contrasena, fotoperfil, numero, tipousuario) 
                VALUES('$nombre', '$apaterno', '$amaterno', '$correo', '$contrasena_encriptada', '', '$numero', '$tipousuario')";

    $resultado = mysqli_query($conexion, $query);

    if($resultado) {
        header('location: ../../front/index.html');
    } else {
        
        echo 'FUCK ';
    } 
    */
?>