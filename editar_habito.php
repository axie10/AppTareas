<?php
include "locale/security.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="icon" type="image/png" href="img/logo9.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar habito</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="jquery/jquery.js"></script>

</head>

<body style="margin-left: 10px;">

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

    <!-- DONDE EMPIEZA LA TABLA DE LOS USUARIOS-->

    <div class="container-fluid" id="caja-tabla-usuario">
        <br>
        <div class="row">
            <h2>Tabla De Hábitos</h2>
        </div>
        <hr>

        <!-- ENCABEZADO DE LA TABLA -->
        <div class="row">
            <div class="col-3">
                <label for="" style="display: grid;justify-content: center;font-weight: 800;">NOMBRE</label>
            </div>
            <div class="col-3">
                <label for="" style="font-weight: 800;">DESCRIPCION</label>
            </div>
            <div class="col-2">
                <label for="" style="font-weight: 800;">REALIZADO</label>
            </div>

        </div>
        <hr>


        <!-- DONDE SACAMOS LOS HABITOS DEL LOS USUARIOS -->
        <?php

        include "locale/bd.php";
        $conexion = Conectar::conexion();

        if ($conexion->connect_error) {
            die("Erro de conexion: " . $conexion->connect_error);
        }

        $id = $_SESSION['id'];

        $sql1 = "SELECT * FROM habitos WHERE usuario_id = '$id' ";
        $result1 = $conexion->query($sql1);

        if ($result1->num_rows > 0) {

            while ($row = $result1->fetch_assoc()) {
        ?>

                <div class="row">
                    <div class="col-3" style="display: grid;justify-content: center;">
                        <input id="nombre_<?php echo $row['id'] ?>" style="border: 0;background-color:" value="<?php echo $row['nombre'] ?>" type="text">
                    </div>

                    <div class="col-3">
                        <input id="descripcion_<?php echo $row['id'] ?>" style="border: 0;background-color: " value="<?php echo $row['descripcion'] ?>" type="text">
                    </div>

                    <div class="col-2">
                        <?php
                        if ($row['realizada'] == 1) { ?>
                            <button laid2="<?php echo $row['id'] ?>" type="button" class="boton-pendiente btn btn-success btn-md">Completado</button>
                        <?php } ?>
                        <?php
                        if ($row['realizada'] == 0) { ?>
                            <button laid2="<?php echo $row['id'] ?>" type="button" class="boton-completado btn btn-danger btn-md">Pendiente</button>
                        <?php } ?>
                    </div>

                    <!-- BOTON MODIFICAR -->
                    <div class="col-1" style="display: grid;justify-content: center;">
                        <button type="button" class="boton-modificar btn btn-warning " laid="<?php echo $row['id'] ?>">Modificar</button>
                    </div>
                    <!-- BOTON BORRAR -->
                    <div class="col-1" style="display: grid;justify-content: center;">
                        <button id="" type="button" class="btn btn-outline-dark boton-borrar" laid1="<?php echo $row['id'] ?>">Borrar</button>
                    </div>
                </div>

                <hr>

        <?php
            };
        }
        ?>

        <a href="index.php">
            <button type="button" class="btn btn-outline-dark">Atrás</button>
        </a>





</body>

<script>
    $(".boton-completado").click(function() {

        var laid = $(this).attr("laid2");
        var opcion = 4;

        $.ajax({
            type: "POST",
            url: "controladores/HabitoControlador.php",
            data: {
                laid: laid,
                opcion: opcion
            },
            success: function() {
                location.reload();
            }
        })
    })

    $(".boton-pendiente").click(function() {

        var laid = $(this).attr("laid2");
        var opcion = 5;

        $.ajax({
            type: "POST",
            url: "controladores/HabitoControlador.php",
            data: {
                laid: laid,
                opcion: opcion
            },
            success: function() {
                location.reload();
            }
        })
    })

    $(".boton-modificar").click(function() {

        var opcion = 3;
        var laid = $(this).attr("laid");
        var nombre = $("#nombre_" + laid).val();
        var descripcion = $("#descripcion_" + laid).val();

        $.ajax({
            type: "POST",
            url: "controladores/HabitoControlador.php",
            data: {
                opcion: opcion,
                laid: laid,
                nombre: nombre,
                descripcion: descripcion,
            },
            success: function(a) {
                location.reload();
            }
        })
    })


    $(".boton-borrar").click(function() {

        var laid1 = $(this).attr("laid1");
        var opcion = 2;

        $.ajax({
            type: "POST",
            url: "controladores/HabitoControlador.php",
            data: {
                laid1: laid1,
                opcion: opcion,
            },
            success: function(a) {
                location.reload();
            }
        })

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