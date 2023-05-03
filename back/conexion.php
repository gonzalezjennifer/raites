<?php
    $hostname = "localhost";
    $username = "id20653231_losraiteros";
    $password = "e&Fly45=*fGIynoF";
    $db = "id20653231_raites10";
    // Create connection
    $conn = new mysqli($hostname, $username, $password, $db);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else{
        
    }
?>