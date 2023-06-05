<?php
    if(!empty($_POST["btndarraite"])){
    if (empty($_POST["origen"]) || empty($_POST["destino"]) || empty($_POST["hora"]) || empty($_POST["lugares"]) ){
        echo '<div class="alert alert-danger text-center">CAMPO/S VACIO/S</div>';
    } else {
        $conexion = conectar();
        $idraitero = $_SESSION["id"];
        $origen = $_POST['origen'];
        $destino = $_POST['destino'];
        $hora = $_POST['hora'];
        $pasapor = $_POST['pasapor'];
        $lugares = $_POST['lugares'];


        if (empty($_POST["Lunes"])) {
            $lunes = "";
        } else {
            $lunes = $_POST['Lunes'];
        }
        if (empty($_POST["Martes"])) {
            $martes = "";
        } else {
            $martes = $_POST['Martes'];
        }
        if (empty($_POST["Miercoles"])) {
            $miercoles = "";
        } else {
            $miercoles = $_POST['Miercoles'];
        }
        if (empty($_POST["Jueves"])) {
            $jueves = "";
        } else {
            $jueves = $_POST['Jueves'];
        }
        if (empty($_POST["Viernes"])) {
            $viernes = "";
        } else {
            $viernes = $_POST['Viernes'];
        }
        if (empty($_POST["Sabado"])) {
            $sabado = "";
        } else {
            $sabado = $_POST['Sabado'];
        }
        if (empty($_POST["Domingo"])) {
            $domingo = "";
        } else {
            $domingo = $_POST['Domingo'];
        }

        $dias = $lunes . " " . $martes . " " . $miercoles . " " . $jueves . " " . $viernes . " " . $sabado . " " . $domingo;
        $sql = "SELECT * FROM raite WHERE idraitero='$idraitero' AND hora='$hora'";
        $result1 = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result1) > 0) {
            $revisar1 = mysqli_fetch_array($result1);
            $dias1 = str_word_count($revisar1['dias'], 1);
            $dias2 = str_word_count($dias, 1);
            $coincidencias = array_intersect($dias1, $dias2);

            if ($revisar1 && !empty($coincidencias)) {
                foreach ($coincidencias as $palabra) {
                    echo '<div class="alert alert-danger text-center">El dia ' . $palabra . ' a las ' . $hora . ' horas ya estas ofreciendo un raite</div>';
                }
            }
        }
        else{
            $querys2 = "INSERT INTO raite (idraitero, origen, destino, hora, pasapor, lugares, dias) VALUES('$idraitero', '$origen', '$destino', '$hora', '$pasapor', '$lugares', '$dias')";
            $resultado = mysqli_query($conexion, $querys2);
            if($resultado) {
                echo '<div class="alert alert-success text-center">REGISTRO EXITOSO</div>';
                header('location: index.php');
            } else {
                echo '<div class="alert alert-danger text-center">ERROR INESPERADO, INTENTE MAS TARDE</div>';
            }
        }
    }
}
    
?>