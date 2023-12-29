<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../vendor/fontawesome-free-6.4.2-web/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/estilos.css">
    <link href="../../public/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="../../public/images/favicon.ico" type="image/x-icon">



    <title>Ingreso Sistema</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form>
                <h1>Registrarse</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-x-twitter"></i></a>
                </div>
                <input type="text" placeholder="Nombre">
                <input type="email" placeholder="Correo electrónico">
                <input type="password" placeholder="Contraseña">
                <button>Regístrate</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="javascript:void(0);" method="POST" id="loginform" onsubmit="app.loginUser()">
                <h1>Iniciar Sesión</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-x-twitter"></i></a>
                </div>
                <input type="email" name="username" placeholder="Correo electrónico">
                <input type="password" name="password" placeholder="Contraseña">
                <a href="#">¿Olvidaste tu contraseña?</a>
                <button type="submit">Iniciar Sesion</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Bienvenido!</h1><br>
                    <p hidden>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Inicia Sesión</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hola, Amigo!</h1><br>
                    <p hidden>Si aún no te has registrado, es el momento perfecto para hacerlo</p>
                    <button class="hidden" id="register">Regístrese</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../src/script.js"></script>
    <script src="../src/login.js"></script>

    <script src="../../public/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../../public/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../.../public/libs/toastr.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../../public/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- <script src="../../public/vendor/parsley/parsley.js"></script> -->
    <script src="../../public/libs/js/main-js.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="../../public/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../public/vendor/datatables/js/data-table.js"></script>

    <script src="../../public/libs/js/quagga.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.5/JsBarcode.all.min.js" integrity="sha512-QEAheCz+x/VkKtxeGoDq6nsGyzTx/0LMINTgQjqZ0h3+NjP+bCsPYz3hn0HnBkGmkIFSr7QcEZT+KyEM7lbLPQ==" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>