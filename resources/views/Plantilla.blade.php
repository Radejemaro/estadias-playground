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
    <style>
     header nav {
    display: flex;
    justify-content: space-between; /* Para distribuir los elementos a los extremos */
    align-items: center; /* Para alinear verticalmente los elementos */
    background-color: #333;
    color: white;
    padding: 10px;
}

header nav a {
    float: left;
    display: block;
    color: white;
    text-align: center;
    padding: 14px 20px;
    text-decoration: none;
}

header nav a:hover {
    background-color: #ddd;
    color: black;
}

.left-links {
    display: flex; /* Para que los elementos se comporten como una fila */
}

.left-links a {
    color: white;
    text-decoration: none;
    padding: 10px;
    margin-right: 10px;
}

.right-links {
    display: flex; /* Para que los elementos se comporten como una fila */
    align-items: center; /* Para alinear verticalmente los elementos */
}

.right-links input[type="search"],
.right-links button {
    margin-left: 10px;
    padding: 5px;
}

.right-links a {
    color: white;
    text-decoration: none;
    padding: 10px;
    margin-left: 10px;
}

</style>
</head>

<body>

    {{-- Barra de Navegacion, falta agg el inv e inicio --}}
    <header>
    <nav>
    <div class="left-links">
        <a href="{{ asset('Index') }}">SEMRC-IT Data Automatization</a>
        <a href="#">Inventario</a>
    </div>
    <div class="right-links">
        <input type="search" placeholder="Search" aria-label="Search">
        <button type="submit">Buscar</button>
        <a href="#">Usuario</a>
        <a href="{{ asset('/') }}">Salir</a>
    </div>
</nav>

    @yield('Contenido')

    <footer>
        <p style="margin-top: 1.5%">Copyright &copy; 2024 SEMRC-IT Data Automatization</p>
    </footer>

</body>

</html>
