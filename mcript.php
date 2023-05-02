<?php 
    $clave = 'Somos el equipo raites, dicis,, sistemas computacionales, ingenieria de software, piriwiris';
    $method = 'aes-256-cbc';
    $iv = base64_decode("uO3Jb3hgCNp8V7ykUuRlAQ==");
    $encriptar = function ($valor) use ($method, $clave, $iv) {
        return openssl_encrypt ($valor, $method, $clave, false, $iv);
    };
    $desencriptar = function ($valor) use ($method, $clave, $iv) {
        $encrypted_data = base64_decode($valor);
        return openssl_decrypt($valor, $method, $clave, false, $iv);
    };

    /*
    Genera un valor para IV
    */
    $getIV = function () use ($method) {
        return base64_encode(openssl_random_pseudo_bytes(openssl_cipher_iv_length($method)));
    };
?>