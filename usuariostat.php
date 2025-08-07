<?php

header('Content-Type: application/json');
require "includes/database.php";

    
    if(!isset($_SESSION)){
        session_start();
    }

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['id']) && isset($input['nuevoEstado'])) {
                $usuarioId = $input['id'];
    $nuevoEstado = filter_var($input['nuevoEstado'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0;

                

                $stmt3 = $db->prepare("UPDATE usuario SET STATUS_USR = ? WHERE ID_USR = ?");
                $stmt3->bind_param('ii', $nuevoEstado, $usuarioId);

                if ($stmt3->execute()) {
                    echo json_encode(['success' => true]);
                } else {
                    error_log("Error SQL: " . $stmt3->error);
                    echo json_encode(['success' => false, 'message' => 'No se pudo actualizar el estado']);
                }
                $stmt3->close();
                $db->close();
                exit;

        } else {
            echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
            $db->close();
            exit;
        }
}
