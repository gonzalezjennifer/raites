<?php
    session_start();
    if(!empty($_POST["btnregistro"])) {
        if (empty($_POST["origen"]) || empty($_POST["destino"]) || empty($_POST["hora"]) || empty($_POST["fotoauto"]) || empty($_POST["lugares"]) ){
            echo '<div class="alert alert-danger">CAMPO/S VACIO/S</div>';
        } else {
            $conexion = conectar();
            $idraitero = $_GET['user'];
            $origen = $_POST['origen'];
            $destino = $_POST['destino'];
            $hora = $_POST['hora'];
            $fotoauto = $_POST['fotoauto'];
            $pasapor = $_POST['pasapor'];
            $lugares = $_POST['lugares'];
            $query = "INSERT INTO raite (idraitero, origen, destino, hora, fotoauto, pasapor, lugares) VALUES('$idraitero', '$origen', '$destino', '$hora', '$fotoauto', '$pasapor', '$lugares')";
            $resultado = mysqli_query($conexion, $query);
            if($resultado) {
                echo '<div class="alert alert-success">REGISTRO EXITOSO</div>';
            } else {
                echo '<div class="alert alert-danger">ERROR INESPERADO, INTENTE MAS TARDE</div>';
            } 
        }
    } 
    
?>