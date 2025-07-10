<?php
header('Content-Type: application/json');
require "includes/database.php";

// Verificar si se recibió una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados en el cuerpo de la solicitud
    $input = json_decode(file_get_contents('php://input'), true);

    // Validar los datos

    if (isset($input['idtkt']) && isset($input['idserv']) && isset($input['fecha']) && isset($input['sechoja'])) {
        $ticketId = $input['idtkt'];
        $servicioid = $input['idserv'];
        $fechasig = $input['fecha'];
        $hoja = $input['sechoja'];
    
        // Conectar a la base de datos
        if ($db->connect_error) {
            http_response_code(response_code: 500);
            echo json_encode(value: ['success' => false, 'message' => 'Error de conexión a la base de datos']);
            exit;
        }

        // Actualizar el estado del ticket
        $stmt = $db->prepare("INSERT INTO asignacion (ID_TKT, ID_USR, FECHA_ASIG) VALUES (?, ?, ?)");
        $stmt->bind_param('iis', $ticketId, $servicioid , $fechasig);


        if ($stmt->execute()) {
            http_response_code(response_code: 200);
            echo json_encode(value: ['success' => true]);
        } else {
            http_response_code(response_code: 500);
            echo json_encode(value: ['success' => false, 'message' => 'Error al ingresar la asignación']);
        }

        switch ($hoja) {
            case 'Hojachica':
                $stmt2 = $db->prepare("INSERT INTO asesoria (ID_TKT) VALUES (?)");
                $stmt2->bind_param('i', $ticketId);
                $stmt2->execute();
                break;
            case 'Hojagrande':
                $stmt2 = $db->prepare("INSERT INTO soporte (ID_TKT) VALUES (?)");
                $stmt2->bind_param('i', $ticketId);
                $stmt2->execute();
                break;
            default:
                http_response_code(response_code: 400);
                echo json_encode(value: ['success' => false, 'message' => 'Hoja de asignación no válida']);
                exit;
        }

        $stmt->close();
        $stmt2->close();
        $db->close();


    } else {
        echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>
