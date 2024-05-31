<?php

//esto es para los errores
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include_once "../modelos/class_calendario.php";
include_once "../locale/bd.php";

$opcion = $_POST['opcion'];

switch ($opcion) {

    case '1':

        //CARGAMOS LOS EVENTOS DEL CALENDARIO
        $conexion = Conectar::conexion();
        modelo_calendario::cargar_eventos($conexion);
        // print("<pre>".print_r($h,true)."</pre>");
        break;

    case '2':

        //GUARDAMOS LOS EVENTOS EN EL CALENDARIO
        $eventos = json_decode($_POST['eventos'], true);
        $conexion = Conectar::conexion();
        modelo_calendario::guardar_eventos($conexion, $eventos);
        // print("<pre>".print_r($h,true)."</pre>");
        break;

    case '3':

        //BORRAMOS LOS EVENTOS
        $eventos = json_decode($_POST['eventos'], true);
        $conexion = Conectar::conexion();
        modelo_calendario::eliminar_eventos($conexion, $eventos);
        //print("<pre>".print_r($h,true)."</pre>");
        break;

    case '4':

        //MODIFICAMOS LOS EVENTOS
        $laid = $_POST['laid'];
        $title = $_POST['title'];
        $conexion = Conectar::conexion();
        modelo_calendario::modificar_eventos($conexion, $title, $laid);
        //print("<pre>".print_r($h,true)."</pre>");
        break;

    case '5':


        break;
        
}

?>