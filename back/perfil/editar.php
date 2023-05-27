<?php 
    if(!empty($_POST["btneditar"])){
        if (empty($_POST["nombre"]) || empty($_POST["apaterno"]) || empty($_POST["amaterno"]) || empty($_POST["contrasena"]) || empty($_POST["numero"]) ){
            echo '<div class="alert alert-danger">CAMPO/S VACIO/S</div>';
        } else {
            $conexion = conectar();
            $user_id = $_SESSION["id"];
            $nombre = $_POST['nombre'];
            $apaterno = $_POST['apaterno'];
            $amaterno = $_POST['amaterno'];
            $contrasena = $_POST['contrasena'];
            $contrasena_encriptada = $encriptar($contrasena);
            $numero = $_POST['numero'];

            $querynumero = "SELECT numero FROM usuario WHERE id=$user_id";
            $resulnumero = mysqli_query($conexion, $querynumero);
            $numeroriginal = mysqli_fetch_array($resulnumero);
            $originalnumero = $numeroriginal['numero'];

            if (strlen($contrasena)<8) {
                echo '<div class="alert alert-danger">LA CONTRASEÑA DEBE CONTENER MINIMO 8 CARACTERES</div>';
            } elseif (strlen($numero)<10 || strlen($numero)>10){
                echo '<div class="alert alert-danger">EL NUMERO TELEFONICO DEBE CONTENER 10 DIGITOS</div>';
            } else {
                $query = "UPDATE usuario SET numero='0000000000' WHERE id=$user_id";
                $resul = mysqli_query($conexion, $query);
                if ($resul){
                    $query = "SELECT * FROM usuario WHERE numero='$numero'";
                    $resultado = mysqli_query($conexion, $query);
                    $usu=mysqli_fetch_array($resultado);
                    if($usu['numero']==$numero) {
                        $querynum = "UPDATE usuario SET numero='$originalnumero' WHERE id=$user_id";
                        $resulnum = mysqli_query($conexion, $querynum);
                        echo '<div class="alert alert-danger">NUMERO TELEFONICO YA REGISTRADO</div>';
                    } else {
                        $query = "UPDATE usuario SET nombre='$nombre', 
                                                    apaterno='$apaterno', 
                                                    amaterno='$amaterno', 
                                                    contrasena='$contrasena_encriptada', 
                                                    numero='$numero' 
                                                    WHERE id=$user_id";
                        $resultado = mysqli_query($conexion, $query);
                        if($resultado) {
                            header('location: perfil.php');
                        } else {
                            echo '<div class="alert alert-danger">ERROR INESPERADO, INTENTE MAS TARDE</div>';
                        } 
                    }
                } else {
                    echo '<div class="alert alert-danger">ERROR INESPERADO, INTENTE MAS TARDE</div>';
                }
            }

            
        }
    } 
?>