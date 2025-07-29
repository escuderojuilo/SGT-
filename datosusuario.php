<?php

header('Content-Type: application/json');
require "includes/database.php";

    
    if(!isset($_SESSION)){
        session_start();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cambiar rol
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['accion']) && $input['accion'] === 'cambiar_rol' && isset($input['id'], $input['nuevoRol'])) {
        $usuarioId = intval($input['id']);
        $nuevoRol = $input['nuevoRol'];

        // Obtener el ID_ROL correspondiente al nombre del rol
        $stmt = $db->prepare("SELECT ID_ROL FROM rol WHERE NOM_ROL = ?");
        $stmt->bind_param('s', $nuevoRol);
        $stmt->execute();
        $stmt->bind_result($idRol);

        if ($stmt->fetch()) {
            $stmt->close();
            // Actualizar el usuario con el nuevo rol
            $stmt2 = $db->prepare("UPDATE usuario SET ID_ROL = ? WHERE ID_USR = ?");
            $stmt2->bind_param('ii', $idRol, $usuarioId);

            if ($stmt2->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'No se pudo actualizar el rol']);
            }
            $stmt2->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Rol no encontrado']);
        }


        $db->close();
        exit;
    } else {
            echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
            $db->close();
            exit;
    }

}
    
    
    $auth = $_SESSION['login'] ?? false;
    $query = "SELECT usuario.ID_USR, usuario.NOMBRE, usuario.AP_PAT, usuario.STATUS_USR, rol.NOM_ROL FROM usuario 
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