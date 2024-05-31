<?php

    class modelo_calendario{

        //FUNCION PARA CARGAR LOS EVENTOS AUTOMATICAMENTE EN EL CALENDARIO
        public static function cargar_eventos($conexion)
        {

            session_start();
            $id = $_SESSION['id'];
            $cadauno = [];
            $eventos = [];

            if ($eviysql = $conexion->prepare('SELECT title, start, end FROM diario WHERE usuario_id = ?')) {

                $eviysql->bind_param('i', $id);

                $eviysql->execute();

                $res = $eviysql->get_result();

                while ($row = $res->fetch_assoc()) {

                    $cadauno = [
                        "title" => $row['title'],
                        "start" => $row['start'],
                        "end" => $row['end'],
                    ];

                    array_push($eventos, $cadauno);
                }
            }

            echo json_encode($eventos);

            $conexion->close();
        }


        //FUNCION PARA GUARDAR LOS EVENTOS EN EL CALENDARIO
        public static function guardar_eventos($conexion, $eventos){

            session_start();
            $id = $_SESSION['id'];

            // Obtener eventos existentes para este usuario
            $sqlExistente = "SELECT id, start, title FROM diario WHERE usuario_id = '$id'";
            $resultadosExistente = $conexion->query($sqlExistente);

            // Crear un array con las claves únicas de los eventos existentes
            $clavesExistente = array();
            while ($rowExistente = $resultadosExistente->fetch_assoc()) {
                $clavesExistente[] = $rowExistente['start'] . $rowExistente['title'];
            }

            // Filtrar solo los eventos que tienen una clave única que no existe en la base de datos
            $eventosParaInsertar = array_filter($eventos, function ($evento) use ($clavesExistente) {
                $claveEvento = $evento['start'] . $evento['title'];
                return !in_array($claveEvento, $clavesExistente);
            });

            foreach ($eventosParaInsertar as $evento) {

                $title = $conexion->real_escape_string($evento['title']);
                $start = $conexion->real_escape_string($evento['start']);
                $end = $conexion->real_escape_string($evento['end']);

                if ($eviysql = $conexion->prepare('INSERT INTO diario (start, end, title, usuario_id) VALUES (?,?,?,?)')) {

                    //Vinculamos el valor que hemos puesto antes de '?' lo que nos entra.
                    $eviysql->bind_param('sssi', $start, $end, $title, $id);
                    //'Execute' para ejecutar las Consultas Preparadas
                    $eviysql->execute();
                }
            }

            $conexion->close();

        }

        //FUNCION PARA ELIMINAR EVENTOS DEL CALENDARIO
        public static function eliminar_eventos($conexion, $eventos){

            foreach ($eventos as $evento) {
                $title = $conexion->real_escape_string($evento['title']);
                $start = $conexion->real_escape_string($evento['start']);
                $end = $conexion->real_escape_string($evento['end']);
        
                $sqlExistente = "DELETE FROM diario WHERE start = '$start' AND end = '$end' AND title = '$title'";
                $resultadosExistente = $conexion->query($sqlExistente);
                if ($resultadosExistente === false) {
                    echo json_encode(['success' => false, 'message' => 'Error al borrar el evento: ' . $conexion->error]);
                } else {
                    echo json_encode(['success' => true, 'message' => 'Evento borrado exitosamente']);
                }
            }
        
        $conexion->close();

            
            
        }

        public static function modificar_eventos($conexion, $title, $laid){

            $sql = ("UPDATE diario SET title=? WHERE id=?");


            if ($stm = $conexion->prepare($sql)
            ) {

                $stm->bind_param('si', $title, $laid);

                if ($stm->execute() == TRUE) {
                } else {
                    echo "Conexion Fallida: " . $conexion->connect_error;
                }
            } else {
                echo "Error en la conexion: " . $conexion->connect_error;
            }

            $stm->close();
            $conexion->close();
        }

    }

?>