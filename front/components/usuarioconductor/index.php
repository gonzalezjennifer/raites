<?php
    session_start();
    if(empty($_SESSION["id"])){
        header('location: ../login/login.php');
    }

    $user = $_GET['user'];
    echo "usuario conductor con nua:";
    echo $user;
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Hello, world!</title>
  </head>
  <body>

    <a href="../../../back/login/control_logout.php" class="btn btn-danger">Salir</a>
    <a href="../draite/raite.php?user=<?php echo $user ?>" class="btn btn-primary">Ofrecer raite</a>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>