<?php

// Funcion para el registro de usuarios en el sistema
function servicio(){
    try {
        //Importar credenciales
        require "database.php";
        //Importar la funcion para enviar el correo electronico
        require "enviar_mail.php";
        
        //Recibir datos 
        $nombre = $_POST['name'] ?? NULL;
        $pat = $_POST['pat'] ?? NULL;
        $mat = $_POST['mat'] ?? NULL;
        $numero = $_POST['numero'] ?? NULL;
        $tel = $_POST['tel'] ?? NULL;
        $mai = $_POST['mai'] ?? NULL;
        $pass = $_POST['pass'] ?? '';
        $stat = "Activo";
        $cubic = $_POST['cub'] ?? NULL;
        $cubic2 = $_POST['cub2'] ?? NULL;
        $rol = "3";
        $depa = $_POST['depa'] ?? NULL;
        $confi = "0";
        $cubiculo = $cubic ."-". $cubic2;

        $passwordHash = password_hash($pass, PASSWORD_BCRYPT) ;
        
        $con = $db -> prepare('SELECT COUNT(*) FROM USUARIO WHERE EMAIL = ?');

        $con -> bind_param('s',$mai);
        $con -> execute();
        $con -> bind_result($count);
        $con -> fetch();
        $con -> close();
        
        if($count === 0){

             $tok = uniqid();
             //Insertar datos en la tabla
             $stmt = $db->prepare("INSERT INTO USUARIO (NOMBRE, 
             AP_PAT, AP_MAT, N_TRABAJADOR, TELEFONO, EMAIL, PASS, 
             STATUS_USR, CUBICULO, ID_ROL, ID_DEPTO, TOKEN, confirmado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
             $stmt->bind_param('sssiissssiisi', $nombre, $pat, $mat, $numero, $tel, $mai, $passwordHash, $stat, $cubiculo, $rol, $depa, $tok, $confi);
 
             if ($stmt ->execute()) {
                envmail($nombre, $mai,$tok);
             } else {
                 echo 'Error ' ;
             }
             //Terminar conexión
             $stmt->close();
             mysqli_close($db);
    
        }else{
            echo "El correo electronico ya fue registrado previamente";
        }

    } catch(\Throwable $e) {
        //echo $e->getMessage();
    }

}

// Función para identificar que nivel de privilegio tiene el usuario 
/*function usr_acc(): void{

    session_start();

    switch ($_SESSION['ID_ROL']) {
        case "1":
            header("Location: Ticket.php");
            break;
    case "2":
            header("Location: TicketSS.php");
            echo "no se que pasa xd";
           break;
    default:
            header("Location: SoporteUsuario.php");
            echo "no se que pasa xd";
            break;
    }
}*/


// Función para levantar un ticket 
function dispotkt(): void{

    //Importar credenciales
    require "database.php";   
    date_default_timezone_set("America/Mexico_City");
    
    $error = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $numinv = mysqli_real_escape_string($db,$_POST['inventario']);
        $marca = mysqli_real_escape_string($db,$_POST['marca']);
        $modelos = mysqli_real_escape_string($db,$_POST['mod']);
        $serie = mysqli_real_escape_string($db,$_POST['serie']);
        $motivos = $_POST['motivo'];
        $date = date("Y-m-d H:i:s");
        $status = "1";
        $userid = $_SESSION['ID_USR'];
        $cubiculo = $_POST['cubi'];

        if(!$numinv){
            
            $query1 = "SELECT * FROM dispositivo WHERE N_SERIE = '$serie' ";
            $resuls1 = mysqli_query($db,$query1);

            if($resuls1){
                $user = mysqli_fetch_assoc($resuls1);
                var_dump($user);
                if($user){

                    $tik = $db->prepare("INSERT INTO ticket (ID_USR, FECHA_INI, MOTIVO, ID_STATUS_TKT, ID_DISPO, CUBICULO ) VALUES (?, ?, ?, ?, ?, ?)");
                    $tik->bind_param('isssss', $userid, $date, $motivos, $status, $user['ID_DISPO'], $cubiculo);
                
                    if ($tik ->execute()) {
                        echo 'Registro exitoso';
                    } else {
                        echo 'Error' ;
                    }
                
                    //Terminar conexión
                    $tik->close();
                    mysqli_close($db);

                }else{
                    echo "El número de serie no es valido o no existe";
                }
            }

        }elseif(!$serie){
        
            $query1 = "SELECT * FROM dispositivo WHERE N_INVENTARIO = '$numinv' ";
            $resuls1 = mysqli_query($db,$query1);

            if($resuls1){
                $user = mysqli_fetch_assoc($resuls1);
                if($user){
                    echo "Número de inventario encontrado";
                    $tik = $db->prepare("INSERT INTO ticket (ID_USR, FECHA_INI, MOTIVO, ID_STATUS_TKT, ID_DISPO, CUBICULO ) VALUES (?, ?, ?, ?, ?, ?)");
                    $tik->bind_param('isssss', $userid, $date, $motivos, $status, $user['ID_DISPO'], $cubiculo);
                    
                    if ($tik ->execute()) {
                        echo 'Registro exitoso';
                    } else {
                        echo 'Error' ;
                    }
                
                    //Terminar conexión
                    $tik->close();
                    mysqli_close($db);
                }else{
                    echo "El número de inventario no es valido o no existe";
                }
            }
    
        }
        
    }

}


// Función para acceder al sistema con el usuario
function logusr(){

    //Conexión a la base de datos
    require "includes/database.php";

    $errores = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //validar que el e-mail y contraseña sean correctos 
        $email = mysqli_real_escape_string($db,filter_var($_POST['email'],FILTER_VALIDATE_EMAIL));
        $pass = mysqli_real_escape_string($db,$_POST['pass']);

        //En caso de no ser correcto arroja los siguientes mensajes
        if(!$email){
            $errores[] = "El email es obligatorio o no es válido";
        }

        if(!$pass){
            $errores[] = "El password es obligatorio";
        }

        //si no existen errores, se valida que la informacion exista dentro de la base de datos
        if(empty($errores)){
            $query = "SELECT * FROM usuario WHERE email = '$email' ";
            $resultado = mysqli_query($db,$query);
            $usuario = mysqli_fetch_assoc($resultado);
            
            if($usuario['confirmado'] === '1'){

                if($resultado->num_rows){

                    if (!empty($usuario['TOKEN'])) {
                        // ❌ Ya tiene una sesión activa
                        header('Location: /SGT-Boostrap/SesionActiva.php');
                        exit();
                    }
                    
                    $auth = password_verify($pass, $usuario['PASS']);

                    if($auth) {
                      
                        //El usuario está autenticado
                        session_start();
                        $_SESSION['ID_USR'] = $usuario['ID_USR'];
                        $_SESSION['TOKEN'] = session_id();

                        //Insertar un token de sesión para el usuario para asegurar que solo este su sesion activa
                        $stmt = $db->prepare("UPDATE usuario SET TOKEN = ? WHERE ID_USR = ?");
                        $stmt->bind_param("si", $_SESSION['TOKEN'], $usuario['ID_USR']);
                        $stmt->execute();
                        
                        echo json_encode([
                        "token" => $_SESSION['TOKEN']
                         ]);
                        
                        //LLenar el arreglo de la sesión
                        $_SESSION['EMAIL'] = $usuario['EMAIL'];
                        $_SESSION['login'] = true;
                        $_SESSION['ID_ROL'] = $usuario['ID_ROL'];
                        $_SESSION['NOMBRE'] = $usuario['NOMBRE'];
                        
                      // usr_acc();
                        //header('Location: /ticket.php');

                        echo "<pre>";
                            var_dump($_SESSION);
                        echo "</pre>";

                    }else {
                        $errores[] = "El password es incorrecto";
                    }

                }else{
                    $errores[] = "El usuario no existe";
                }
            }else{
                echo "El usuario no ha sido registrado o no ha sido confirmado";
            }
        }
    }
}

function equipo() {
    require "includes/database.php";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $inventario =  mysqli_real_escape_string($db,$_POST['no_inventario']);
        $nserie =  mysqli_real_escape_string($db, $_POST['no_serie']);
        $marca =  mysqli_real_escape_string($db, $_POST['marca']);
        $modelo =  mysqli_real_escape_string($db, $_POST['modelo']);
        $ipalam =  mysqli_real_escape_string($db, $_POST['ip-alambrica']);
        $ipinalam =  mysqli_real_escape_string($db, $_POST['ip_inalambrica']);
        $macalam =  mysqli_real_escape_string($db, $_POST['mac_alambrica']);
        $macinalam =  mysqli_real_escape_string($db, $_POST['mac_inalambrica']);
        $opcion = mysqli_real_escape_string($db, $_POST['opcion']);
        $tipocom = mysqli_real_escape_string($db, $_POST['tipo-computadora']);
        $so = mysqli_real_escape_string($db, $_POST['sistemaop']);
        $procesador = mysqli_real_escape_string($db, $_POST['procesador']);
        $ram = mysqli_real_escape_string( $db, $_POST['ram']);
        $alma = mysqli_real_escape_string($db, $_POST['almacenamiento']);
        $host = mysqli_real_escape_string($db, $_POST['host']);
        $tipoimp = mysqli_real_escape_string( $db, $_POST['tipo-impresora']);
        $desc = mysqli_real_escape_string($db, $_POST['descripcion-otro']);
        $labo = mysqli_real_escape_string($db, $_POST['laboratorio']);
        $nomlab= mysqli_real_escape_string($db, $_POST['sallab']);
        
        $con = $db -> prepare('SELECT COUNT(*) FROM dispositivo WHERE N_INVENTARIO = ?');

        $con -> bind_param('s',$inventario);
        $con -> execute();
        $con -> bind_result($count);
        $con -> fetch();
        $con -> close();

        if ($count === 0){


        $disp = $db->prepare("INSERT INTO dispositivo (N_INVENTARIO, N_SERIE, MARCA, MODELO, IP_ALAMB, 
        IP_INALAMB, MAC_ALAMB, MAC_INALAMB ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $disp->bind_param('isssssss', $inventario, $nserie, $marca, $modelo, $ipalam, $ipinalam, $macalam, $macinalam);

        if ($disp ->execute()) {
            echo 'Registro exitoso';

            $query = "SELECT * FROM dispositivo WHERE N_INVENTARIO = '$inventario' ";
            $resul = mysqli_query($db,$query);
            $usuario = mysqli_fetch_assoc($resul);
            
            switch($opcion){
            
                case 'computadora':

                    $disp = $db->prepare("INSERT INTO  computo(ID_DISPO, TIPO, PROCESADOR, RAM, ALMACENAMIENTO, NOM_HOST, SO) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $disp->bind_param('issssss',$usuario['ID_DISPO'], $tipocom, $procesador, $ram, $alma, $host, $so);
                    $disp->execute();
                    $disp->close();

                    if($lab === 'Si'){

                        $query = "SELECT ID_LAB FROM laboratorio WHERE NOM_LAB = '$nomlab' ";
                        $resul = mysqli_query($db,$query);
                        $lab = mysqli_fetch_assoc($resul);


                        $disp = $db->prepare("INSERT INTO disp_lab(ID_DISPO, ID_LAB) VALUES (?, ?)");
                        $disp->bind_param('ii', $USUARIO['ID_DISPO'], $lab['ID_LAB']);
                        $disp->execute();
                        $disp->close();
                    }
                    
                case 'impresora':
                case 'otro':
                
                    $disp->close();
                    mysqli_close($db);
            }

        } else {
            echo 'Error' ;
        }
    } else {
        echo "El  número de inventario ya fue registrado";
    }
}
}


function reg(){
    try {
        //Importar credenciales
        require "database.php";
        //Importar la funcion para enviar el correo electronico
        require "includes/enviar_mail.php";
        
        //Recibir datos 
        $nombre = $_POST['nombre'] ?? NULL;
        $pat = $_POST['pat'] ?? NULL;
        $mat = $_POST['mat'] ?? NULL;
        $numero = $_POST['num'] ?? NULL;
        $tel = $_POST['telefono'] ?? NULL;
        $mai = $_POST['correo'] ?? NULL;
        $pass = $_POST['pass'] ?? '';
        $stat = "Activo";
        $cubic = $_POST['cubiculo'] ?? NULL;
        $rol = $_POST['tipo_usuario'] ?? NULL;
        $depa = $_POST['depa'] ?? NULL;
        $confi = "0";
        $activ = '1';
    
        $passwordHash = password_hash($pass, PASSWORD_BCRYPT) ;
        
        $con = $db -> prepare('SELECT COUNT(*) FROM USUARIO WHERE EMAIL = ?');

        $con -> bind_param('s',$mai);
        $con -> execute();
        $con -> bind_result($count);
        $con -> fetch();
        $con -> close();
        
        if($count === 0){
            
             $tok = uniqid();
             //Insertar datos en la tabla
             $stmt = $db->prepare("INSERT INTO USUARIO (NOMBRE, 
             AP_PAT, AP_MAT, N_TRABAJADOR, TELEFONO, EMAIL, PASS, 
             STATUS_USR, CUBICULO, ID_ROL, ID_DEPTO, TOKEN, confirmado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
             $stmt->bind_param('sssiissssiisi', $nombre, $pat, $mat, $numero, $tel, $mai, $passwordHash, $stat, $cubic, $rol, $depa, $tok, $confi);
 
             if ($stmt ->execute()) {
                echo 'Registro exitoso';
                envmail($nombre, $mai,$tok);

             } else {
                 echo 'Error ' ;
             }

             //Terminar conexión
             $stmt->close();

             if($rol === '2'){

                $query = "SELECT ID_USR FROM USUARIO WHERE  EMAIL = '$mai' ";
                $resul = mysqli_query($db,$query);
                $usuario = mysqli_fetch_assoc($resul);

                $ss = $db->prepare("UPDATE usuario SET UC=1 WHERE ID_USR = ?");

                $ss->bind_param('i', $usuario['ID_USR']);

                $ss->execute();
                $ss->close();
             }

             mysqli_close($db);
    
        }else{
            echo "El correo electronico ya fue registrado previamente";
        }

    } catch(\Throwable $e) {
        
    }

}

function verificarcuenta(){
    //Importar credenciales
    require "includes/database.php";

    if (isset($_GET['token'])) {
        $token = $_GET['token'];

        // Verificar si el token existe en la base de datos
        $stmt = $db->prepare("SELECT ID_USR FROM usuario WHERE TOKEN=? LIMIT 1");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Token válido, actualizar estado del usuario y regresa a null el tocken
            $stmt->close();
            $stmt = $db->prepare("UPDATE usuario SET TOKEN=NULL, confirmado='1' WHERE TOKEN=?");
            $stmt->bind_param("s", $token);
            $stmt->execute();

        } else {

            echo "Token inválido o expirado.";
        }

        $stmt->close();
        $db->close();

    } else {

    }
}

function recucontra(){

    try{
    //Importar credenciales
        require "database.php";
        //Importar la funcion para enviar el correo electronico
        require "includes/enviar_mail.php";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $email = mysqli_real_escape_string($db,filter_var($_POST['email'],FILTER_VALIDATE_EMAIL));

        if(!$email){
            echo "El email es obligatorio o no es válido";
        }else{
            $query = "SELECT * FROM usuario WHERE email = '$email' ";
            $resultado = mysqli_query($db,$query);
            $usuario = mysqli_fetch_assoc($resultado);

            if($resultado->num_rows){

                contraseña($usuario['NOMBRE'], $email);

            }else{
                echo "El usuario no existe";
            }
        }
    }
    }

    catch(\Throwable $e) {
        //echo $e->getMessage();
    }
}

function cambio_contra(){

     require "includes/database.php";

    if (isset($_GET['EMAIL'])) {
        $correo = $_GET['EMAIL'];
        echo $correo;

        // Verificar si el token existe en la base de datos
        $stmt = $db->prepare("SELECT ID_USR FROM usuario WHERE EMAIL=? LIMIT 1");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt-> num_rows > 0) {
            $stmt->close();
            

            if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $contra = $_POST['confirmPassword']; 
            $hash = password_hash($contra, PASSWORD_BCRYPT);  

            $stmt2 = $db->prepare("UPDATE usuario SET PASS=? WHERE EMAIL=?");
            $stmt2->bind_param("ss", $hash, $correo);

             if ($stmt2->execute()) {
                    header('Location: /SGT-Boostrap/contrasena-cambiada-exito.php');
                } else {
                    echo "Error al actualizar la contraseña.";
                }
                 $stmt2->close();   
                }
        
        } else {

            echo "contraseña mala :C.";
        }

       
        $db->close();

    }

}




?>