<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="img/logo9.png"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindTask | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="jquery/jquery.js"></script>


</head>

<body>

    <!-- LOGIN -->
    <div class="row" style="margin-top: 150px;">
        <div class="col 4">

        </div>

        <div class="col 4">
            <div id="login" class="container" style="align-items: center;">
                <div class="row">
                    <div class="col 6">
                        <form action="controladores/UsuarioControlador.php" method="POST">
                            <fieldset>
                                <h1 style="font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                                ">MindTask</h1>
                                    <input name="opcion" value="1" hidden>
                                <div class="mb-3">
                                    <label for="disabledTextInput" class="form-label">Email</label>
                                    <input name="email" type="text" id="disabledTextInput" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="disabledTextInput" class="form-label">Contraseña</label>
                                    <input name="contraseña" type="password" id="disabledTextInput" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-warning">Iniciar</button>
                                <button id="boton-registrarse" type="button" class="btn btn-outline-dark">Registrarse</button>
                            </fieldset>
                        </form>
                    </div>

                </div>
            </div>

        </div>

        <div class="col 4">

        </div>

    </div>

    <!-- REGISTRO -->
    <div class="row" style="margin-top: 10px;">
        <div class="col 4">

        </div>

        <div class="col 4">
            <div id="registro" class="container" style="align-items: center;">

                <div class="col 6" style="border-radius: 1px solid black;">
                    <form action="controladores/UsuarioControlador.php" method="POST">
                        <fieldset>
                            <h1 style="font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                             ">MindTask</h1>
                                <input name="opcion" value="2" hidden>
                            <div class="mb-3">
                                <label for="disabledTextInput" class="form-label">Usuario</label>
                                <!-- hay que dar los name a los input para que se los lleve el form -->
                                <input name="usuario" type="text" id="disabledTextInput" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="disabledTextInput" class="form-label">Contraseña</label>
                                <input name="contraseña" type="password" id="disabledTextInput" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="disabledTextInput" class="form-label">Email</label>
                                <input name="email" type="text" id="disabledTextInput" class="form-control">
                            </div>
                            <button id="boton-volver" type="submit" class="btn btn-warning">Registrar</button>
                            <button type="submit" class="btn btn-outline-dark">Volver</button>
                        </fieldset>
                    </form>
                </div>

            </div>

        </div>

        <div class="col 4">

        </div>

    </div>



</body>

<script>
    $("#registro").hide();

    $("#boton-registrarse").click(function() {
        $("#login").hide();
        $("#registro").show();
    });

    $("#boton-volver").click(function() {
        $("#registro").hide();
        $("#login").show();
    });
</script>

</html>