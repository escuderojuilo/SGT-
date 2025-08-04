<?php

header('Content-Type: application/json');
require "includes/database.php";

    
    if(!isset($_SESSION)){
        session_start();
    }

    $auth = $_SESSION['login'] ?? false;

    

    $query = "SELECT ticket.ID_TKT, ticket.ID_STATUS_TKT, ticket.ID_USR, status_tkt.DESC_STATUS_TKT,
    ticket.ID_DISPO, ticket.FECHA_INI, ticket.MOTIVO, ticket.CUBICULO, ticket.FECHA_FIN, ticket.SOLUCION, dispositivo.N_INVENTARIO, 
    dispositivo.MARCA, dispositivo.MODELO, usuario.NOMBRE, usuario.AP_PAT, usuario_asignado.nombre AS NOMBRE_ASIGNADO
    FROM ticket 
    INNER JOIN dispositivo on ticket.ID_DISPO = dispositivo.ID_DISPO 
    INNER JOIN usuario on ticket.ID_USR = usuario.ID_USR
    INNER JOIN status_tkt on ticket.ID_STATUS_TKT = status_tkt.ID_STATUS_TKT
    LEFT JOIN (
    SELECT a.*
    FROM asignacion a
    INNER JOIN (
        SELECT ID_TKT, MAX(ID_ASIGNACION) AS max_asig
        FROM asignacion
        GROUP BY ID_TKT
    ) ult
    ON a.ID_TKT = ult.ID_TKT AND a.ID_ASIGNACION = ult.max_asig
    ) asignacion on ticket.ID_TKT = asignacion.ID_TKT
    LEFT JOIN usuario AS USUARIO_ASIGNADO ON usuario_asignado.ID_USR = asignacion.ID_USR
    where asignacion.ID_USR = {$_SESSION['ID_USR']}";


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