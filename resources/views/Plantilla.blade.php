<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Datos Generales --}}
    <meta name="description" content="SEMRC-IT Data Automatization" />
    <meta name="author" content="Macias Ramirez Ramon de Jesus" />

    {{-- Titulo Editable --}}
    <title>@yield('Titulo', 'SEMRC-IT Data Automatization')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('Imagenes/Storage.ico') }}" />

    {{-- Vinculos a estilos y fuentes --}}

    <link rel="stylesheet" type="text/css" href="/css/Plantilla.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rethink+Sans" rel="stylesheet">

    @yield('Estilo')

</head>

<body>

    {{-- Barra de Navegacion --}}
    <header>
        <nav>
            <ul>
                <li><a href="/Index">Inicio</a></li>
                <li><a href="/Inventario_Gral">Inventario</a></li>
                <li><input type="text" placeholder="Buscar"></li>
                <li>SEMRC-IT Data Automatization</li>
                <li><a href="/">Log out</a></li>
                <li><a href="/User">User</a></li>
            </ul>
        </nav>
    </header>

    @yield('Contenido')

    <footer>
        <p>Copyright &copy; 2024 SEMRC-IT Data Automatization</p>
    </footer>

</body>

</html>
