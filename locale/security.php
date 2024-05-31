<?php
    
    session_start();

    if($_SESSION['login']== 1){

    } else{
        session_destroy();
        header('Location: login_entrada.php');
    }

?>