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



    <link rel="icon" type="image/x-icon" href="{{ asset('public/Imagenes/Storage.ico') }}" />

    {{-- Vinculos a estilos y fuentes --}}

    <link rel="stylesheet" type="text/css" href="/css/Plantilla.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rethink+Sans" rel="stylesheet">

    @yield('Estilo')
</head>

<body>
    <header>
        <nav>
            <div class="left-links">
                <a href="{{ asset('Index') }}" id="LogoSecrets"><img src="{{ asset('/Public/Imagenes/Logo.png') }}"
                        alt="SEMRC-IT Data Automatization"></a>
                <a href="#">Inventario</a>
            </div>
            <div class="right-links">
                <input type="search" placeholder="Search" aria-label="Search" id="GlobalSearch">
                <button type="submit" id="GlobalSearchButton">Buscar</button>
                <a href="#">Usuario</a>
                <a href="{{ asset('/') }}">Salir</a>
            </div>
        </nav>

        @yield('Contenido')

        <footer>
            <p style="margin-top: 1.5%">Copyright &copy; 2024 SEMRC-IT Data Automatization</p>
        </footer>

</body>

<script>
    $(document).ready(function() {
        // Evento para cambiar entre mostrar y ocultar la contraseña
        $(document).on('click', '.toggle-password', function() {
            let input = $(this).prev('input');
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                $(this).removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                input.attr('type', 'password');
                $(this).removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
</script>

<script>

</script>

</html>
