<?php
    session_start();
    include_once '../conexion.php';
    if (empty($_POST["origen"]) || empty($_POST["destino"]) || empty($_POST["hora"]) || empty($_POST["lugares"]) ){
        echo '<div class="alert alert-danger">CAMPO/S VACIO/S</div>';
    } else {
        $conexion = conectar();
        $idraitero = $_SESSION["id"];
        $origen = $_POST['origen'];
        $destino = $_POST['destino'];
        $hora = $_POST['hora'];
        $pasapor = $_POST['pasapor'];
        $lugares = $_POST['lugares'];
        $lunes = $_POST['Lunes'];
        $martes = $_POST['Martes'];
        $miercoles = $_POST['Miercoles'];
        $jueves = $_POST['Jueves'];
        $viernes = $_POST['Viernes'];
        $sabado = $_POST['Sabado'];
        $domingo = $_POST['Domingo'];

        $dias = $lunes . " " . $martes . " " . $miercoles . " " . $jueves ." " . $viernes . " " . $sabado. " ". $domingo ;
        $query = "INSERT INTO raite (idraitero, origen, destino, hora, pasapor, lugares, dias) VALUES('$idraitero', '$origen', '$destino', '$hora', '$pasapor', '$lugares', '$dias')";
        $resultado = mysqli_query($conexion, $query);
        if($resultado) {
            echo '<div class="alert alert-success">REGISTRO EXITOSO</div>';
            header("location: ../../front/components/usuarioconductor");
        } else {
            echo '<div class="alert alert-danger">ERROR INESPERADO, INTENTE MAS TARDE</div>';
        }
    }

    
?>