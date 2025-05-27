<?php

header('Content-Type: application/json');
require "includes/database.php";

    
    if(!isset($_SESSION)){
        session_start();
    }

    $auth = $_SESSION['login'] ?? false;

    

    $query = "SELECT ticket.ID_TKT, ticket.ID_STATUS_TKT, ticket.ID_USR, status_tkt.DESC_STATUS_TKT,
    ticket.ID_DISPO, ticket.FECHA_INI, ticket.MOTIVO, ticket.CUBICULO, ticket.FECHA_FIN, dispositivo.N_INVENTARIO, 
    dispositivo.MARCA, dispositivo.MODELO, usuario.NOMBRE, usuario.AP_PAT
    FROM ticket INNER JOIN dispositivo on ticket.ID_DISPO = dispositivo.ID_DISPO 
    INNER JOIN usuario on ticket.ID_USR = usuario.ID_USR INNER JOIN status_tkt on ticket.ID_STATUS_TKT = status_tkt.ID_STATUS_TKT";

    $resul = mysqli_query($db,$query);

    header('Content-Type: application/json');
    

    while ($row = $resul->fetch_assoc()) {
        if($row ["ID_STATUS_TKT"] === "1"){
            $datos[] = $row;
    }elseif($row ["ID_STATUS_TKT"] === "2"){
        $datos[] = $row;
    }elseif($row ["ID_STATUS_TKT"] === "3"){
        $datos[] = $row;    
    }}



echo json_encode($datos);

    mysqli_close($db);
    exit;


    ?>