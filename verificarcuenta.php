<?php

require "includes/database.php";

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verificar si el token existe en la base de datos
    $stmt = $db->prepare("SELECT ID_USR FROM usuario WHERE TOKEN=? LIMIT 1");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Token válido, actualizar estado del usuario
        $stmt->close();
        $stmt = $db->prepare("UPDATE usuario SET TOKEN=NULL, confirmado='1' WHERE TOKEN=?");
        $stmt->bind_param("s", $token);

        if($stmt->execute()){
            echo "Registro exitoso";
            echo ' <button onclick="window.location.href=\'/SGT-Boostrap/index.php\'">Regresar a la pagina principal</button>';
        }else{
            echo "Fallo el registro ";
        }

    } else {

        echo "Token inválido o expirado.";
    }

    $stmt->close();
    $db->close();

} else {

}

?>



