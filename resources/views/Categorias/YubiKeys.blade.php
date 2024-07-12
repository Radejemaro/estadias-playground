@extends('Plantilla')

@section('Titulo', 'YubiKeys')

@section('Estilo')
    <link rel="stylesheet" type="text/css" href="/css/YubiKeys.css">
@endsection

@section('Contenido')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://kit.fontawesome.com/92b6cbde7e.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('JS/show_info.js') }}"></script>
    <script src="{{ asset('JS/search.js') }}" type="module"></script>
    <script src="{{ asset('JS/ddl_buttons_Yubi.js') }}"></script>

    <div id="menu_derecho">
        <ul>
            <li id="delete"><a>Eliminar</a></li>
            <li id="edit"><a>Editar</a></li>
            <li id="add"><a href="{{ route('jupiter.create') }}">Agregar</a></li>
        </ul>
    </div>

    <div id="edit-modal"
        style="">
        <h3>Editar YubiKey</h3>
        <form id="edit-form">
            <label for="edit-COLEGA">Colega:</label>
            <input type="text" id="edit-COLEGA" name="COLEGA"><br>

            <label for="edit-PUESTO">Puesto:</label>
            <input type="text" id="edit-PUESTO" name="PUESTO"><br>

            <label for="edit-SN_YUBIKEY">YubiKey:</label>
            <input type="text" id="edit-SN_YUBIKEY" name="SN_YUBIKEY"><br>

            <label for="edit-PIN_YUBIKEY">Pin YubiKey:</label>
            <div class="password-wrapper">
                <input type="password" id="edit-PIN_YUBIKEY" name="PIN_YUBIKEY">
                <i id="toggle-password" class="fas fa-eye toggle-password"></i>
            </div><br>

            <button type="button" id="save-changes">Guardar Cambios</button>
            <button type="button" onclick="$('#edit-modal').hide();">Cancelar</button>
        </form>
    </div>

    <div class="container">
        <h2><input type="text" id="mysearch" placeholder="Buscar en YubiKeys"></h2>

        <table id="yubikey-table">
            <thead>
                <tr>
                    <th>Colega</th>
                    <th>Puesto</th>
                    <th>YubiKey</th>
                    <th>Pin YubiKey</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($yubikeys as $yubikey)
                    <tr data-id="{{ $yubikey->id }}">
                        <td>{{ $yubikey->COLEGA }}</td>
                        <td>{{ $yubikey->PUESTO }}</td>
                        <td>{{ $yubikey->SN_YUBIKEY }}</td>
                        <td id="PinYubikey">
                            <input type="password" id="PIN" class="password-wrapper" value="{{ $yubikey->PIN_YUBIKEY }}" readonly>
                                <i class="fas fa-eye toggle-password"></i>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
