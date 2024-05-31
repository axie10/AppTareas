<?php
include "locale/security.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="img/logo9.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindTask</title>
    <link rel="stylesheet" href="style.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


</head>


<body style="margin-left: 10px;">

    <div id="datoscalendario"></div>

    <div style="margin-top: 12px;">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="index.php"><img width="60" height="60" class="d-inline-block align-top" alt="Logo" src="img/logo9.png" alt=""></a>
            <li class="nav-item" style="margin-top: 12px;">
                <a class="nav-link" href="calendario.php">Calendario</a>
            </li>
            <li class="nav-item" style="margin-top: 12px;">
                <a class="nav-link" href="añadir_habito.php">Nuevo habito</a>
            </li>
            <li class="nav-item" style="margin-top: 12px;">

                <!-- ESTE PHP ES SOLO DE PRUEBA, CUANDO TENGAMOS LA SESION INICIADA USAREMOS LAS VARIABLES QUE CAPTURAREMOS AL INICIAR SESION -->
                <!-- DE TODOS MODOS ESTE FUNCIONA NOS IMPRIME TODOS LOS USUARIOS -->
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><?php echo $_SESSION['usuario']  ?></a>
            </li>
            <li style="margin-top: 12px;">
                <button id="cerrar-sesion" type="button" class="btn btn-danger btn-md">Cerrar Sesión</button>
            </li>
        </ul>
    </div>


    <!-- CALENDARIO - AÑADIR HABITOS - LISTA DE HABITOS -->

    <div class="row" style="margin: 50px;">

        <!-- DONDE VA EL CALENDARIO -->
        <div class="col 6">
            <div style="background-color: rgba(1, 189, 252, 0.238);border: 3px solid rgb(0, 0, 0);" class="col 6" id="calendario"></div>
        </div>

        <!-- //añadir habitos -->
        <div style="margin-left: 30px;" class="col 6">
            <!-- BOTON DE AÑADIR HABITO -->
            <div class="row">
                <a href="añadir_habito.php">
                    <button type="button" class="btn btn-warning btn-lg">AÑADIR HÁBITO NUEVO</button>
                </a>
            </div>
            <br>
            <hr>

            <!-- DONDE SACAMSO LOS HABITOS DEL USUARIO -->
            <div class="row">
                <div class="col 12" style="text-align: center; font-weight: 500; font-size: large;color: black">HÁBITOS</div>
            </div>

            <br>

            <div class="row">
                <div class="col-12" style="overflow-y: scroll;overflow-x: hidden; height: 14cm;">
                    <!-- LISTADO DE HABITOS -->
                    <?php

                    include "locale/bd.php";
                    $conexion = Conectar::conexion();

                    $id = $_SESSION['id'];
                    $consulta = "SELECT * FROM habitos WHERE usuario_id = '$id'";
                    $result = $conexion->query($consulta);

                    if ($result->num_rows > 0) {

                        while ($row = $result->fetch_assoc()) {

                    ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card" style="background-color: rgba(1, 189, 252, 0.238); border: 1px solid black">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $row['nombre'] ?></h5>
                                            <p class="card-text"><?php echo $row['descripcion'] ?></p>
                                            <a href="editar_habito.php" class="btn btn-outline-dark">Editar</a>
                                            <br>
                                            <br>
                                            <?php
                                            if ($row['realizada'] == 1) { ?>
                                                <p style="color:green; font-weight: 500;">Completado</p>
                                            <?php } ?>
                                            <?php
                                            if ($row['realizada'] == 0) { ?>
                                                <p style="color:red; font-weight: 500;">Pendiente</p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>

                    <?php
                        }
                    }
                    ?>

                </div>

            </div>



        </div>

    </div>

</body>

<script>
    // INICIALIZAR FULLCALENDAR
    $(document).ready(function() {

        var eventosComunes = [];

        // Inicializar FullCalendar
        $('#calendario').fullCalendar({

            //especifica la estructura de la cabeza del calendario, incluyendo los botones de navegacion y la vista actual del calendario
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },

            //ponemos en true estas opciones. Perm,ite editar los eventos del calendario, seleccionar rango de fecha y mejora visual
            editable: true,
            selectable: true,
            selectHelper: false,

            //PARA CREAR UN EVENTO EN EL CALENDARIO
            select: function(start, end, jsEvent, view) {
                // console.log('Fecha de inicio:', start.format());
                // console.log('Fecha de fin:', end.format());
                var title = prompt('Diario:');
                if (title) {

                    var eventData = {
                        title: title,
                        start: start,
                        end: end
                    };

                    eventosComunes.push(eventData);
                    //llamamos a la funcion que creamos mas abajo para que nos guarde el evento que creaos en la base de datos
                    guardarEventosEnBaseDeDatos(eventosComunes);
                    //lo usamos para renderizar el evento en el calendario
                    $('#calendario').fullCalendar('renderEvent', eventData, true);
                }
                //deseleccionas el rango de fechas seleccionado
                $('#calendario').fullCalendar('unselect');
            },

            //PARA BORRAR UN EVENTO DEL CALENDARIO Y DE LA BASE DE DATOS
            eventClick: function(calEvent, jsEvent, view) {
                var confirmarBorrado = confirm('¿Estás seguro de que deseas borrar este diario?');

                if (confirmarBorrado) {

                    eventoParaEliminar = {
                        title: calEvent.title,
                        start: calEvent.start.format(),
                        end: calEvent.end.format(),
                    };

                    $.ajax({
                        url: 'controladores/CalendarioControlador.php',
                        type: 'POST',
                        data: {
                            opcion : 3,
                            eventos: JSON.stringify([eventoParaEliminar])
                        },
                        success: function(response) {
                            alert('Evento borrado exitosamente.');
                        },
                        error: function(error) {
                            console.error('Error al borrar el evento.');
                        }
                    });

                    // Actualiza el calendario
                    $('#calendario').fullCalendar('removeEvents', calEvent._id);
                }

            },
        });


        // Cargar eventos desde el servidor al inicializar el calendario
        cargarEventosDesdeServidor();

        //CARAGAMOS LOS EVENTOS DE NUESTRA BASE DE DATOS EN NUESTRO CALENDARIO
        function cargarEventosDesdeServidor() {
            $.ajax({
                url: 'controladores/CalendarioControlador.php',
                type: 'POST',
                data: {
                    opcion: 1
                },
                success: function(eventos) {
                    //nos convierte el array que traemos a un objeto json
                    eventosComunes = JSON.parse(eventos);
                    //utilizamos el objeto json creado antes "eventosComunbes" con el addEventSource para añadir al calendario los eventos de nuestra base de datos
                    $('#calendario').fullCalendar('addEventSource', eventosComunes);
                },
                error: function(error) {
                    console.error('Error al cargar eventos desde el servidor:', error);
                }
            });
        }

        // Función para guardar eventos en la base de datos
        function guardarEventosEnBaseDeDatos(eventos) {

            $.ajax({
                url: 'controladores/CalendarioControlador.php',
                type: 'POST',
                data: {
                    opcion: 2,
                    eventos: JSON.stringify(eventos)
                },
                success: function(response) {
                    alert('Evento guardado exitosamente.');
                    
                },
                error: function(error) {
                    console.error('Error al guardar eventos en la base de datos:');
                }
            });
            //para refrescar el calendario
            $('#calendario').fullCalendar('refetchEvents');
        }

    });


    $("#cerrar-sesion").click(function() {

        var opcion = 3;
        $.ajax({
            type: "POST",
            url: "controladores/UsuarioControlador.php",
            data: {
                opcion: opcion,
            },
            dataType: "text",
            success: function(a) {
                location.reload();
            }
        })

    });
</script>

</html>