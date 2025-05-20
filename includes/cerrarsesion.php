<?php
    session_start();

    $_SESSION = [];

    session_destroy();
    
    header('Location: /SGT-Boostrap/index.php');

  
?>