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

    <!-- Link de btstrp-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">

    <link rel="icon" type="image/x-icon" href="{{ asset('public/Imagenes/Storage.ico') }}" />

    {{-- Vinculos a estilos y fuentes --}}

    <link rel="stylesheet" type="text/css" href="/css/Plantilla.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rethink+Sans" rel="stylesheet">

    @yield('Estilo')

</head>

<body>

    {{-- Barra de Navegacion, falta agg el inv e inicio --}}
    <header>
        <nav class="navbar" style="background-color: #dadde2;">
            <div class="container-fluid">
                <a class="navbar-brand" style="color: #000000;" href="{{ asset('Index') }}"><b>SEMRC-IT Data Automatization</b></a>
                <div class="d-flex">
                    <form class="d-flex me-2" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-secondary" type="submit" style="border-color: #000000; color: #000000">Search</button>
                    </form>
                    <button class="btn btn-outline-secondary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="border-color: #000000;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16" style="color: rgb(0, 0, 0)">
                        <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z"/>
                    </svg></button>
                </div>
            </div>
        </nav>

<!-- Contenido del offcanva de filtros-->

  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasRightLabel">Offcanvas right</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body"></div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    @yield('Contenido')

    <footer>
        <p style="margin-top: 1.5%">Copyright &copy; 2024 SEMRC-IT Data Automatization</p>
    </footer>

</body>

</html>
