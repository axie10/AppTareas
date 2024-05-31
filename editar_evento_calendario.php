<?php
include "locale/security.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <h2>Diario</h2>
        </div>
        <hr>

        <!-- ENCABEZADO DE LA TABLA -->
        <div class="row">

            <div class="col-6" style=" margin-left:30px;display: grid;justify-content: center;">
                <label for="" style="font-weight: 800;">DESCRIPCION</label>
            </div>
            <div class="col-2">
                <label for="" style="font-weight: 800;">INICIO</label>
            </div>
            <div class="col-2">
                <label for="" style="font-weight: 800;">FIN</label>
            </div>
        </div>
        <hr>

        <!-- DONDE EMPIEZAN LOS DATOS DE LOS USUARIOS, UTILIZANDO EL PHP PARA PODER SACAR TODOS LOS USUARIOS DEL ARCHIVO  -->
        <?php

        include "locale/bd.php";
        $conexion = Conectar::conexion();

        $id = $_SESSION['id'];

        $sql1 = "SELECT * FROM diario WHERE usuario_id = '$id' ";
        $result1 = $conexion->query($sql1);

        if ($result1->num_rows > 0) {

            while ($row = $result1->fetch_assoc()) {
        ?>

                <div class="row">
                    <div class="col-6" style="margin-left:30px;display: grid;justify-content: center;">
                        <input id="title_<?php echo $row['id'] ?>" style="border: 0;height: 1cm; width: 10cm" value="<?php echo $row['title'] ?>" type="text">
                    </div>

                    <div class="col-2">
                        <p id="start_<?php echo $row['id'] ?>" style="border: 0;background-color:"> <?php echo $row['start'] ?></p>
                    </div>

                    <div class="col-2">
                        <p id="end_<?php echo $row['id'] ?>" style="border: 0;background-color:"> <?php echo $row['end'] ?></p>
                    </div>

                    <!-- BOTON MODIFICAR -->
                    <div class="col-1" style="display: grid;justify-content: center;">
                        <button type="button" class="boton-modificar btn btn-md" laid="<?php echo $row['id'] ?>" style="color: white;background: rgb(42, 132, 216);margin-left: 3pt;font-weight: 400;border: 1px solid green;">Modificar</button>
                    </div>
                </div>

                <hr>

        <?php
            };
        }
        ?>
        <a href="calendario.php">
            <button type="button" class="btn btn btn-lg">Atrás</button>
        </a>

</body>

<script>
    $(".boton-modificar").click(function() {

        var laid = $(this).attr("laid");

        var title = $("#title_" + laid).val();

        $.ajax({
            type: "POST",
            url: "controladores/CalendarioControlador.php",
            data: {
                opcion : 4,
                laid: laid,
                title: title,
            },
            success: function(a) {
                location.reload();
            }
        })
    })

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