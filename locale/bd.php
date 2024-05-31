<?php

    class Conectar{

        public static function conexion(){

            $server = "localhost";
            $user = "root";
            $password = "";
            $db = "zenhub";
            
            $conexion = new mysqli($server, $user, $password, $db);
            $conexion->query("SET NAMES 'utf8'");
            return $conexion;
        }
        
    }
    
?>