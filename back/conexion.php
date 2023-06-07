<?php 
    function conectar() {
        //$host = "localhost:8889";
        $host = "localhost:3306"; 
        $user = "root";
        $password = "root";
        $db = "raites";

        $conn = mysqli_connect($host, $user, $password);
        mysqli_select_db($conn, $db);
        return $conn;
    }
?>