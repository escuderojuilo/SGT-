<?php

header('Content-Type: application/json');
require "includes/database.php";

    
    if(!isset($_SESSION)){
        session_start();
    }

    $auth = $_SESSION['login'] ?? false;
    $query = "SELECT ID_USR, NOMBRE, AP_PAT FROM usuario WHERE ID_ROL = 2";
    $resul = mysqli_query($db,$query);

    header('Content-Type: application/json');

    while ($row = $resul->fetch_assoc()) {
        $datos[] = $row;
    }
    
echo json_encode($datos);

    mysqli_close($db);
    exit;

    ?>