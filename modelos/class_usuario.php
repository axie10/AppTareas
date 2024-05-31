<?php

    class modelo_usuario{


        //FUNCION PARA INICIAR SESION
        public static function iniciar_sesion($conexion, $email, $contra){

            if ($eviysql = $conexion->prepare('SELECT id, contraseña, nombre FROM usuarios WHERE correo = ?')) {

                //Vinculamos el valor que hemos puesto antes de '?' lo que nos entra.
                $eviysql->bind_param('s', $email);
                //'Execute' para ejecutar las Consultas Preparadas
                $eviysql->execute();

                //para asociar las columnas que traemos de la consulta a las variables que ponemos en la siguiente linea
                $res = $eviysql->get_result();
                //Metodo se utiliza para obtener el resultado actual de la consulta y almacenarlo en las variables vinculadas.
                if ($row = mysqli_fetch_assoc($res)) {

                    if ($contra == $row['contraseña']) {

                        $_SESSION['login'] = 1;
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['email'] = $row['correo'];
                        $_SESSION['usuario'] = $row['nombre'];
                        header('Location: ../index.php');
                    }
                }

            } else {

                header('Location: ../login_entrada.php');
                exit();

            }
        }

        //FUNCION PARA REGISTRAR A LOS USUARIOS
        public static function registrar_usuario($conexion, $correo, $contraseña, $nombre){

            if($eviysql = $conexion->prepare('INSERT INTO usuarios(nombre, correo, contraseña) VALUES (?, ?, ?)')){

                $eviysql->bind_param('sss',$nombre, $correo, $contraseña);
                $eviysql->execute();
                header('Location: ../index.php');
            }
           
        }

        //FUNCION PARA CERRAR SESION
        public static function cerrar_sesion($conexion){
            session_start();
            session_destroy();
        }


    }

?>