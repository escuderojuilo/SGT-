<?php
header('Content-Type: application/json');
require "includes/database.php";

// Verificar si se recibió una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados en el cuerpo de la solicitud
    $input = json_decode(file_get_contents('php://input'), true);

    // Validar los datos
    

  
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>
