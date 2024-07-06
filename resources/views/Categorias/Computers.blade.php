@extends('Plantilla')

@section('Titulo', 'Computers')

@section('Estilo')
    <link rel="stylesheet" type="text/css" href="/css/Computers.css">
@endsection

@section('Contenido')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('JS/show_info.js') }}"></script>
    <script src="{{ asset('JS/search.js') }}" type="module"></script>
    <script src="{{ asset('JS/ddl_buttons.js') }}"></script>

    <div id="menu_derecho">
        <ul>
            <li><a href="#">Eliminar</a></li>
            <li><a href="#">Editar</a></li>
        </ul>
    </div>

    <div class="container">
        <h2><input type="text" id="mysearch" placeholder="Buscar en Computers"></h2>

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
                @foreach ($computers as $computer)
                    <tr data-id="{{ $computer->id }}">
                        <td>{{ $computer->NOMBRE_PC }}</td>
                        <td>{{ $computer->No_SERIE }}</td>
                        <td>{{ $computer->MODELO_PC }}</td>
                        <td>{{ $computer->TIPO }}</td>
                        <td>{{ $computer->PUESTO }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
