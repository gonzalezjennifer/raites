<?php
    if(!empty($_POST["btnapartar"])){
        $id_raite = $_POST['idraite'];
        $id_pasa = $_SESSION["id"];
        $conexion = conectar();

    $que = "SELECT * FROM apartar";
    $rep = mysqli_query($conexion, $que);
    $mo = mysqli_fetch_array($rep);

    $sql = "SELECT * FROM raite WHERE id='$id_raite'";
    $res = mysqli_query($conexion, $sql);
    $apar = mysqli_fetch_array($res);

    $sql3 = "SELECT * FROM raite t INNER JOIN apartar ap ON ap.id_raite = t.id WHERE ap.id_usuario = $id_pasa";
    $resultado2 = mysqli_query($conexion, $sql3);
    $ya = mysqli_fetch_array($resultado2);

    $dias1 = str_word_count($apar['dias'], 1);

    $dias2 = str_word_count($ya['dias'], 1);

    $coincidencias = array_intersect($dias1, $dias2);

    if($resultado2 and $apar['hora']==$ya['hora'] ){
        if(!empty($coincidencias)){
            foreach ($coincidencias as $palabra) {
            echo '<div class="alert alert-danger">El dia '.$palabra .' a las '.$ya['hora'].' horas ya tienes un raite activo</div>';
        }
    }
    } else {
            if($rep){
                $query = "INSERT INTO apartar(id_raite, id_usuario) VALUES ('$id_raite', '$id_pasa') ";
                $resultado = mysqli_query($conexion, $query);
                if ($resultado){
                    $sql2 = "SELECT * FROM apartar WHERE id_raite='$id_raite'";
                    $resp = mysqli_query($conexion, $sql2);
                    $ver = mysqli_fetch_array($resp); 
        
                    if($apar['id']==$ver['id_raite']){
                        $actua = "UPDATE raite SET lugares=lugares - '1' WHERE id='$id_raite'";
                        $corre = mysqli_query($conexion, $actua);
                    }
                header("location: ./index.php");
            
                }
                echo '<div class="alert alert-success">REGISTRO EXITOSO</div>';
                
            }else {
                    echo '<div class="alert alert-danger">ERROR INESPERADO, INTENTE MAS TARDE</div>';
                }
        }
    }
    /**/
?>
