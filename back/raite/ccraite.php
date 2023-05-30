<?php
    include '../conexion.php';
    $conexion = conectar();

    $idRaite = $_POST['idraite'];

    $query1 = "DELETE FROM raite WHERE id = $idRaite";
    $query2 = "DELETE FROM apartar WHERE id_raite = $idRaite";

    $resultado1 = mysqli_query($conexion, $query1);
    $resultado2 = mysqli_query($conexion, $query2);

    if($resultado1 AND $resultado2){
        header('location: ../../front/components/usuarioconductor');
    } else {
        echo '<div class="alert alert-danger">ERROR INESPERADO, INTENTE MAS TARDE</div>';
    }