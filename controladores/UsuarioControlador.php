<?php

//esto es para los errores
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include_once "../modelos/class_usuario.php";
include_once "../locale/bd.php";

$opcion = $_POST['opcion'];

switch ($opcion) {

    case '1':

        //INICIAR SESION
        session_start();

        $email = $_POST ['email'];
        $contra = $_POST ['contraseña'];
        $conexion = Conectar::conexion();
        modelo_usuario::iniciar_sesion($conexion, $email, $contra);
        
        break;

    case '2':

        //REGISTRAR USUARIO
        $nombre = $_POST ['usuario'];
        $contra = $_POST ['contraseña'];
        $email = $_POST ['email'];
        $conexion = Conectar::conexion();
        modelo_usuario::registrar_usuario($conexion, $email, $contra, $nombre);
        
        break;

    case '3':
        // CERRAR SESION
        $conexion = Conectar::conexion();
        modelo_usuario::cerrar_sesion($conexion);
        break;

    default:
        // Acción por defecto si $opcion no coincide con ningún caso anterior
        echo "Opción no válida.";
        break;
}

?>