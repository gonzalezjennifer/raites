<?php
    session_start();
    if(!empty($_POST["btningresar"])){
        if (!empty($_POST["correo"]) or !empty($_POST["contrasena"]) ){
            $usuario = $_POST["correo"];
            $contrasena = $_POST['contrasena'];
            $contrasena_encriptada = $encriptar($contrasena);
            
            $query = "SELECT * FROM usuario WHERE correo='$usuario'";
            $resultado = mysqli_query($conn, $query);

            //creo que falta algo para que si da error el resultado
            
            $usu=mysqli_fetch_array($resultado);
            $contrasena_desencriptada = $desencriptar($usu['contrasena']);
            if($usu['correo']==$usuario and $contrasena_desencriptada==$contrasena) {
                $_SESSION["id"]=$usu['id'];
                if ($usu['tipo']=="conductor") {
                    //header( "Location: temp.php? user = $user" );
                    //header("Location:temp.php?user=".$user);
                    header('location: https://raites.000webhostapp.com/components/usuarioconductor/index.php?user='.$usu['id']);
                } else {
                    header('location: https://raites.000webhostapp.com/components/usuariopasajero/index.php?user='.$usu['id']);
                }
            } else {
                echo '<div class="alert alert-danger">ACCESO DENEGADO</div>';
            } 
        } else {
           echo '<div class="alert alert-danger">CAMPO VACIO</div>';
        }
    }
    ob_flush();
?>