<?php 
    session_start();
    if(!empty($_POST["btningresar"])){
        if (!empty($_POST["correo"]) or !empty($_POST["contrasena"]) ){

            $usuario = $_POST["correo"];
            $contrasena = $_POST['contrasena'];
            $contrasena_encriptada = $encriptar($contrasena);
            $conexion = conectar();

            $query = "SELECT * FROM usuario WHERE correo='$usuario'";
            $resultado = mysqli_query($conexion, $query);

            //creo que falta algo para que si da error el resultado
            
            $usu=mysqli_fetch_array($resultado);
            $contrasena_desencriptada = $desencriptar($usu['contrasena']);
            if($usu['correo']==$usuario and $contrasena_desencriptada==$contrasena) {
                $_SESSION["id"]=$usu['id'];
                $_SESSION["tipousuario"]=$usu['tipousuario'];
                if ($usu['tipousuario']=="conductor") {
                    //header( "Location: temp.php? user = $user" );
                    //header("Location:temp.php?user=".$user);
                    header("location: ../usuarioconductor/index.php");
                } else {
                    header("location: ../usuariopasajero/index.php");
                }
            } else {
                echo '<div class="alert alert-danger">ACCESO DENEGADO</div>';
            } 
        } else {
           echo '<div class="alert alert-danger">CAMPO VACIO</div>';
        }
        
    }
?>