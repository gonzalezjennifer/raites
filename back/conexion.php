<?php 
    function conectar() {
        $host = "localhost:8889";
        $user = "root";
        $password = "root";
        $db = "raites";

        $conn = mysqli_connect($host, $user, $password);
        mysqli_select_db($conn, $db);
        return $conn;
    }
?>