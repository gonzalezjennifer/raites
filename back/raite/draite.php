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
        $lunes = $_POST['Lunes'];
        $martes = $_POST['Martes'];
        $miercoles = $_POST['Miercoles'];
        $jueves = $_POST['Jueves'];
        $viernes = $_POST['Viernes'];
        $sabado = $_POST['Sabado'];
        $domingo = $_POST['Domingo'];

        $sql = "SELECT * FROM raite WHERE idraitero='$idraitero' AND hora='$hora'";
        $result1 = mysqli_query($conexion, $sql);
        $revisar1 = mysqli_fetch_array($result1);
        $dias1 = str_word_count($revisar1['dias'], 1);
        
        $dias = $lunes . " " . $martes . " " . $miercoles . " " . $jueves ." " . $viernes . " " . $sabado. " ". $domingo ;
        $dias2 = str_word_count($dias, 1);

        $coincidencias = array_intersect($dias1, $dias2);

        if($revisar1['hora']==$hora AND !empty($coincidencias)){
            foreach($coincidencias as $palabra) {
                echo '<div class="alert alert-danger text-center">El dia '.$palabra .' a las '.$hora.' horas ya estas ofreciendo un raite</div>';
            }
        }
        else{
            $query = "INSERT INTO raite (idraitero, origen, destino, hora, pasapor, lugares, dias) VALUES('$idraitero', '$origen', '$destino', '$hora', '$pasapor', '$lugares', '$dias')";
            $resultado = mysqli_query($conexion, $query);
            if($resultado) {
                echo '<div class="alert alert-success text-center">REGISTRO EXITOSO</div>';
            } else {
                echo '<div class="alert alert-danger text-center">ERROR INESPERADO, INTENTE MAS TARDE</div>';
            }
        }
    }
}
    
?>