<?php
    session_start();
    session_destroy();
    header('location: ../../front/components/login/login.php');
?>