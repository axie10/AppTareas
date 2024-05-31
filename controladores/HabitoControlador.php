<?php

//esto es para los errores
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include_once "../modelos/class_habitos.php";
include_once "../locale/bd.php";

$opcion = $_POST['opcion'];

switch ($opcion) {

    case '1':

        //AÑADIR HABITO
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $conexion = Conectar::conexion();
        modelo_habito::añadir_habito($conexion, $nombre, $descripcion);
        break;

    case '2':

        //BORRAR HABITO
        $laid = $_POST["laid1"];
        $conexion = Conectar::conexion();
        modelo_habito::borrar_habito($conexion, $laid);
        
        break;

    case '3':
        //MODIFICAR HABITO
        $laid = $_POST['laid'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $conexion = Conectar::conexion();
        modelo_habito::modificar_habito($conexion, $nombre, $descripcion, $laid);
        break;

    case '4':
        //PONERLO EN MODO COMPLETADO
        $id = $_POST['laid'];
        $completado = 1;
        $conexion = Conectar::conexion();
        modelo_habito::habito_completado($conexion, $completado, $id);
        break;

    case '5':
        //PONERLO EN MODO PENDIENTE
        $id = $_POST['laid'];
        $pendiente = 0;
        $conexion = Conectar::conexion();
        modelo_habito::habito_pendiente($conexion, $pendiente, $id);
        break;
        
}

?>