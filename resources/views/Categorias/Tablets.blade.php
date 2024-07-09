@extends('Plantilla')

@section('Titulo', 'Tablets')

@section('Estilo')
    <link rel="stylesheet" type="text/css" href="/css/Computers.css">
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
        <h2><input type="text" id="mysearch" placeholder="Buscar en Tablets"></h2>

        <table id="computers-table">
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
                @foreach ($tablets as $tablet)
                    <tr data-id="{{ $tablet->id }}">
                        <td>{{ $tablet->NOMBRE_PC }}</td>
                        <td>{{ $tablet->No_SERIE }}</td>
                        <td>{{ $tablet->MODELO_PC }}</td>
                        <td>{{ $tablet->TIPO }}</td>
                        <td>{{ $tablet->PUESTO }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
