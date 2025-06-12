<?php

header('Content-Type: application/json');
require "includes/database.php";

    
    if(!isset($_SESSION)){
        session_start();
    }

    $auth = $_SESSION['login'] ?? false;
    $query = "SELECT ID_USR.usuario, NOMBRE.usuairo, AP_PAT.usuairo, rol.NOM_ROL FROM usuario 
    INNER JOIN rol on usuario.ID_ROL = rol.ID_ROL";
    $resul = mysqli_query($db,$query);

    header('Content-Type: application/json');

    while ($row = $resul->fetch_assoc()) {
        $datos[] = $row;
    }
    
echo json_encode($datos);

    mysqli_close($db);
    exit;

    ?>