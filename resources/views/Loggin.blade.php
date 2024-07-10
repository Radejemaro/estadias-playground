<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Datos Generales --}}
    <meta name="description" content="SEMRC-IT Data Automatization" />
    <meta name="author" content="Macias Ramirez Ramon de Jesus" />

    {{-- Titulo Editable --}}
    <title>Login</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('Imagenes/Storage.ico') }}" />

    {{-- Vinculos a estilos y fuentes --}}
    @yield('Estilo')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rethink+Sans" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/Login.css">

</head>

<body>

    <div class="login-container">
        <label for="usuario">Usuario</label>
        <input type="text" id="usuario" name="usuario" placeholder="Usuario">
        <br>
        <label for="contraseña">Contraseña</label>
        <input type="password" id="pwd" name="pwd" placeholder="Contraseña">
        <br>
        <div class="botones">
            <a href="/Index" id="btn_login"><button>Login</button></a>
            <a href="/Registro"><button>Registrarse</button></a>
        </div>
    </div>

    <footer>
        <p>Copyright &copy; 2024 SEMRC-IT Data Automatization</p>
    </footer>
</body>

</html>
