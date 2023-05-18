<?php
    if(!empty($_POST["btnarchivo"])){ 
        $ifimagen = getimagesize($_FILES["file"]["tmp_name"]);
        if ($ifimagen != false) {
            if ( $_FILES["file"]["size"] > 4000000 ) {
                echo '<div class="alert alert-danger">El archivo es demasiado grande</div>';
            } else {
                $extension  = pathinfo( $_FILES["file"]["name"], PATHINFO_EXTENSION ); 
                if ($extension=="jpeg" || $extension=="jpg" || $extension=="pjpeg" || $extension=="png"){
                    $filename   = $_SESSION["id"];
                    $basename   = $filename . "." . $extension; 
                    $source       = $_FILES["file"]["tmp_name"];
                    $destination  = "../../img/perfiles/{$basename}";

                    $conexion = conectar();
                    $query = "UPDATE usuario SET fotoperfil='$basename' WHERE id=$filename";
                    $resultado = mysqli_query($conexion, $query);
                    if($resultado) {
                        if (move_uploaded_file( $source, $destination )) {
                            header('location: perfil.php');
                        } else {
                            echo '<div class="alert alert-danger">Error inesperado, intentelo mas tarde</div>';
                        }
                    } else {
                            echo '<div class="alert alert-danger">Error inesperado, intentelo mas tarde</div>';
                    }        
                } else {
                    echo '<div class="alert alert-danger">Solo se admiten archivos jpge/jpg/pjpeg/png </div>';
                }
            }
        } else {
            echo '<div class="alert alert-danger">El archivo no es una imagen</div>';
        }
    }
?>