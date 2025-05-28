<?php
header('Content-Type: application/json');
require "includes/database.php";

// Verificar si se recibió una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados en el cuerpo de la solicitud
    $input = json_decode(file_get_contents('php://input'), true);

    // Validar los datos
    if (isset($input['id']) && isset($input['estado']) && isset($input['fechaHorafin'])) {
        $ticketId = $input['id'];
        $nuevoEstado = $input['estado'];
        $fechafin = $input['fechaHorafin'];
    
        // Conectar a la base de datos

        if ($db->connect_error) {
            echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos']);
            exit;
        }

       // $query = "SELECT ID_STATUS_TKT FROM status_tkt WHERE DESC_STATUS_TKT = '$nuevoEstado'";
       // $result = mysqli_query($db, $query);
       // $cambio = mysqli_fetch_assoc($result);
        
        // Actualizar el estado del ticket
        $stmt = $db->prepare("UPDATE ticket SET ID_STATUS_TKT = ?, FECHA_FIN = ? WHERE  ID_TKT= ?");
        $stmt->bind_param('isi', $nuevoEstado, $fechafin,  $ticketId);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el estado']);
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
