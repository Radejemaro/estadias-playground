@extends('Plantilla')

@section('Titulo', 'YubiKeys')

@section('Estilo')
    <link rel="stylesheet" type="text/css" href="/css/YubiKeys.css">
@endsection

@section('Contenido')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('JS/show_info.js') }}"></script>
    <script src="{{ asset('JS/search.js') }}" type="module"></script>
    <script src="{{ asset('JS/ddl_buttons.js') }}"></script>

    <div id="menu_derecho">
        <ul>
            <li id="delete"><a>Eliminar</a></li>
            <li id="edit"><a>Editar</a></li>
        </ul>
    </div>

    <div id="edit-modal"
        style="display:none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border: 1px solid black; z-index: 1000;">
        <h3>Editar Computadora</h3>
        <form id="edit-form">
            <label for="edit-COLEGA">Nombre del Colega:</label>
            <input type="text" id="edit-COLEGA" name="COLEGA"><br>

            <label for="edit-PUESTO">Puesto:</label>
            <input type="text" id="edit-PUESTO" name="PUESTO"><br>

            <label for="edit-SN_YUBIKEYC">Serial:</label>
            <input type="text" id="edit-SN_YUBIKEY" name="SN_YUBIKEY"><br>

            <label for="edit-TIPO">PIN:</label>
            <input type="password" id="edit-TIPO" name="PIN_YUBIKEY"><br>

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
                    <tr data-id="{{ $yubikeys->id }}">
                        <td>{{ $yubikey->COLEGA }}</td>
                        <td>{{ $yubikey->PUESTO }}</td>
                        <td>{{ $yubikey->SN_YUBIKEY }}</td>
                        <td type="password">{{ $yubikey->PIN_YUBIKEY }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
