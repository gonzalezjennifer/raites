<?php
    include '../conexion.php';
    $conexion = conectar();

    $idraite = $_POST['idraite'];
    $idpasajero = $_POST['idpasajero'];
    $query = "DELETE FROM apartar WHERE id_raite = '$idraite' AND id_usuario = '$idpasajero'";
    $resultado = mysqli_query($conexion, $query);
    if($resultado){
        $actua = "UPDATE raite SET lugares=lugares + '1' WHERE id='$idraite'";
        $corre = mysqli_query($conexion, $actua);
        header('location: ../../front/components/usuariopasajero/index.php');
    } else {
        echo '<div class="alert alert-danger">ERROR INESPERADO, INTENTE MAS TARDE</div>';
    }
?>