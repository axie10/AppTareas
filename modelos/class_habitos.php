<?php

    class modelo_habito{


        //FUNCION PARA AÑADIR HABITO
        public static function añadir_habito($conexion, $nombre, $descripcion){

            session_start();
            $usuario = $_SESSION['id'];

            if($eviysql = $conexion->prepare('INSERT INTO habitos(nombre, descripcion, usuario_id) VALUES (?, ?, ?)')){

                $eviysql->bind_param('ssi',$nombre, $descripcion, $usuario);
                $eviysql->execute();
                header('Location: ../index.php');
            }
        }

        //FUNCION PARA BORRAR HABITO
        public static function borrar_habito($conexion, $laid){

            if($eviysql = $conexion->prepare('DELETE FROM habitos WHERE id = ?')){

                $eviysql->bind_param('i',$laid);
                $eviysql->execute();
            }
        }

        //FUNCION PARA MODIFICAR HABITO
        public static function modificar_habito($conexion, $nombre, $descripcion, $laid){

            if($eviysql = $conexion->prepare('UPDATE habitos SET nombre = ?, descripcion = ? WHERE id = ?')){

                $eviysql->bind_param('ssi',$nombre, $descripcion, $laid);
                $eviysql->execute();
            } 
        }


        //FUNCION PARA PONER HABITO EN COMPLETADO
        public static function habito_completado($conexion, $completado, $id){

            if($eviysql = $conexion->prepare('UPDATE habitos SET realizada = ? WHERE id = ?')){

                $eviysql->bind_param('ii',$completado, $id);
                $eviysql->execute();
            } 

            
        }

        //FUNCION PARA PONER HABITO EN PENDIENTE
        public static function habito_pendiente($conexion, $pendiente, $id){

            if($eviysql = $conexion->prepare('UPDATE habitos SET realizada = ? WHERE id = ?')){

                $eviysql->bind_param('ii',$pendiente, $id);
                $eviysql->execute();
            } 
            
        }


    }

?>