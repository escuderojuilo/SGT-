<?php
header('Content-Type: application/json');
require "includes/database.php";

// Verificar si se recibió una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados en el cuerpo de la solicitud
    $input = json_decode(file_get_contents('php://input'), true);

    // Validar los datos

    if (isset($input['idtkt']) && isset($input['idserv']) && isset($input['fecha'])) {
        $ticketId = $input['idtkt'];
        $servicioid = $input['idserv'];
        $fechasig = $input['fecha'];
    
        // Conectar a la base de datos
        if ($db->connect_error) {
            http_response_code(response_code: 500);
            echo json_encode(value: ['success' => false, 'message' => 'Error de conexión a la base de datos']);
            exit;
        }

        $query = "SELECT ID_UC FROM personal_uc WHERE ID_USR = '$servicioid' ";
        $result = mysqli_query($db, $query);
        $cambio = mysqli_fetch_assoc($result);
        
        

        // Actualizar el estado del ticket
        $stmt = $db->prepare("INSERT INTO asignacion (ID_TKT, ID_UC, FECHA_ASIG) VALUES (?, ?, ?)");
        $stmt->bind_param('iis', $ticketId, $cambio['ID_UC'] , $fechasig);

        if ($stmt->execute()) {
            http_response_code(response_code: 200);
            echo json_encode(value: ['success' => true]);
        } else {
            http_response_code(response_code: 500);
            echo json_encode(value: ['success' => false, 'message' => 'Error al ingresar la asignación']);
        }

        $stmt->close();
        $db->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>
