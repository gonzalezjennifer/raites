<?php
    include "mcript.php";

    $dato = "123456789";
    //Encripta informaciÃ³n:
    $dato_encriptado = $encriptar($dato);
    //Desencripta informaciÃ³n:
    $dato_desencriptado = $desencriptar($dato_encriptado);
    echo 'Dato encriptado: '. $dato_encriptado . '<br>';
    echo 'Dato desencriptado: '. $dato_desencriptado . '<br>';
    
    
?>