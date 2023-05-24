<?php
    session_start();
    include_once "../conexion.php";

    $id_raite = $_GET['id'];
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

    if($resultado2 and !empty($coincidencias)){
        echo '<div class="alert alert-danger">Ya tienes raites para alguno de los dias que sucede este raite</div>';
    } else {
        if ($num_conflictos > 0) {
            echo "No se puede";
            echo $dias[0];
            echo $da[0];
            echo $num_conflictos;
        } else {
            echo "Si jala";
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
                header("location: ../../front/components/usuariopasajero/verraites.php");
                }
                echo '<div class="alert alert-success">REGISTRO EXITOSO</div>';
                
            }else {
                    echo '<div class="alert alert-danger">ERROR INESPERADO, INTENTE MAS TARDE</div>';
                }
        }
    }
    /**/
?>