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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
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

    <div class="row" style="margin-top: 150px;">
        <div class="col 4">

        </div>

        <div class="col 4">
            <div id="registro" class="container" style="align-items: center;">

                <div class="col 6" style="border-radius: 1px solid black;">
                    <form action="controladores/HabitoControlador.php" method="POST">
                        <fieldset>
                            <h1 style="font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                             ">AÑADIR HABITO</h1>
                            <input name="opcion" value="1" hidden>
                            <div class="mb-3">
                                <label for="disabledTextInput" class="form-label">Nombre</label>
                                <!-- hay que dar los name a los input para que se los lleve el form -->
                                <input name="nombre" type="text" id="disabledTextInput" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="disabledTextInput" class="form-label">Descripcion</label>
                                <input name="descripcion" type="text" id="disabledTextInput" class="form-control" style="height: 90px;">
                            </div>
                            <button id="boton-volver" type="submit" class="btn btn-warning">Añadir habito</button>
                            <a href="index.php">
                                <button type="button" class="btn btn-outline-dark">Atras</button>
                            </a>
                        </fieldset>
                    </form>
                </div>

            </div>

        </div>

        <div class="col 4">

        </div>

    </div>

</body>

</html>