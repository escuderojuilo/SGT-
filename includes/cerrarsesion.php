<?php
    require "database.php";
    session_start();

    if (isset($_SESSION['ID_USR'])) {

        $stmt = $db->prepare("UPDATE usuario SET TOKEN = NULL WHERE ID_USR = ?");
        $stmt->bind_param("i", $_SESSION['ID_USR']);
        $stmt->execute();
    }


    $_SESSION = [];   
    session_unset();
    session_destroy();
    
    echo json_encode(['success' => true, 'message' => 'Sesión cerrada']);

    
    file_put_contents('php://stderr', "Cierre de sesión ejecutado\n", FILE_APPEND);

    header('Location: /SGT-Boostrap/index.php');

  
?>