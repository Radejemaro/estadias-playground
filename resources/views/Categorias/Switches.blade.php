@extends('Plantilla')

@section('Titulo', 'Switches')

@section('Estilo')
    <link rel="stylesheet" type="text/css" href="/css/Switches.css">
@endsection

@section('Contenido')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('JS/show_info.js') }}"></script>
    <script src="{{ asset('JS/searchSwit.js') }}" type="module"></script>
    <script src="{{ asset('JS/ddl_buttons_Swit.js') }}"></script>

    <div id="menu_derecho">
        <ul>
            <li id="delete"><a>Eliminar</a></li>
            <li id="edit"><a>Editar</a></li>
            <li id="add"><a href="{{ route('jupiter.create') }}">Agregar</a></li>
        </ul>
    </div>

    <div id="edit-modal"
        style="display:none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border: 1px solid black; z-index: 1000;">
        <h3>Editar Computadora</h3>
        <form id="edit-form">
            <label for="edit-NOMBRE_PC">Nombre Dispositivo:</label>
            <input type="text" id="edit-NOMBRE_PC" name="NOMBRE_PC"><br>

            <label for="edit-No_SERIE">No. Serie:</label>
            <input type="text" id="edit-No_SERIE" name="No_SERIE"><br>

            <label for="edit-MODELO_PC">Modelo:</label>
            <input type="text" id="edit-MODELO_PC" name="MODELO_PC"><br>

            <label for="edit-TIPO">Tipo:</label>
            <input type="text" id="edit-TIPO" name="TIPO"><br>

            <label for="edit-PUESTO">Asignado:</label>
            <input type="text" id="edit-PUESTO" name="PUESTO"><br>

            <button type="button" id="save-changes">Guardar Cambios</button>
            <button type="button" onclick="$('#edit-modal').hide();">Cancelar</button>
        </form>
    </div>

    <div class="container">
        <h2><input type="text" id="mysearch" placeholder="Buscar en Switches"></h2>

        <table id="switches-table">
            <thead>
                <tr>
                    <th>Nombre Dispositivo</th>
                    <th>No.Serie</th>
                    <th>Modelo</th>
                    <th>Tipo</th>
                    <th>Asignado</th>
                </tr>
            </thead>
            <tbody>
                 @foreach ($switches as $switches)
                    <tr data-id="{{ $switches->id }}">
                        <td>{{ $switches->NOMBRE_PC }}</td>
                        <td>{{ $switches->No_SERIE }}</td>
                        <td>{{ $switches->MODELO_PC }}</td>
                        <td>{{ $switches->TIPO }}</td>
                        <td>{{ $switches->PUESTO }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
