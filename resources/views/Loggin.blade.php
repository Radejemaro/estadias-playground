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
    <link rel="stylesheet" type="text/css" href="css/Login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rethink+Sans" rel="stylesheet">
</head>

<body>
    <div class="login-container">
        {{-- Mostrar mensajes de éxito o error --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->has('loginError'))
            <div class="alert alert-danger">
                {{ $errors->first('loginError') }}
            </div>
        @endif

        {{-- Botones para alternar entre Login y Registro --}}
        <div class="toggle-buttons">
            <button id="login-btn" onclick="showLoginForm()">Login</button>
            <button id="register-btn" onclick="showRegisterForm()">Registrarse</button>
        </div>

        {{-- Formulario de Inicio de Sesión --}}
        <form id="login-form" method="POST" action="{{ route('login') }}" style="display: none;">
            @csrf
            <label for="name">Usuario</label>
            <input type="text" id="name" name="name" placeholder="Usuario" value="{{ old('name') }}">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" placeholder="Contraseña">
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>
            <button type="submit">Login</button>
        </form>

        {{-- Formulario de Registro --}}
        <form id="register-form" method="POST" action="{{ route('register') }}" style="display: none;">
            @csrf
            <label for="register_name">Usuario</label>
            <input type="text" id="register_name" name="name" placeholder="Usuario">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>
            <label for="register_password">Contraseña</label>
            <input type="password" id="register_password" name="password" placeholder="Contraseña">
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmar Contraseña">
            <br>
            <button type="submit">Registrarse</button>
        </form>
    </div>

    <footer>
        <p>Copyright &copy; 2024 SEMRC-IT Data Automatization</p>
    </footer>

    <script>
        function showLoginForm() {
            document.getElementById('login-form').style.display = 'block';
            document.getElementById('register-form').style.display = 'none';
        }

        function showRegisterForm() {
            document.getElementById('login-form').style.display = 'none';
            document.getElementById('register-form').style.display = 'block';
        }

        // Mostrar el formulario de login por defecto
        showLoginForm();
    </script>
</body>

</html>
