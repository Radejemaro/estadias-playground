@extends('Plantilla')

@section('Titulo', 'Computers')

@section('Estilo')
    <link rel="stylesheet" type="text/css" href="/css/Computers.css">
@endsection

@section('Contenido')
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
                <tr class="dropdown-row" style="display: none;">
                    <td colspan="5">
                        <div class="dropdown-content">
                            <p><strong>GID:</strong> {{ $computer->GID }}</p>
                            <p><strong>ID JUPITER:</strong> {{ $computer->ID_JUPITER }}</p>
                            <p><strong>DIVISION:</strong> {{ $computer->DIVISION }}</p>
                            <!-- Agrega más campos aquí -->
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="info-row" style="display: none;">
        <!-- Detalles adicionales aquí -->
    </div>
</div>

<script src="{{ asset('JS/show_info.js') }}"></script>
<script src="{{ asset('JS/search.js') }}" type="module"></script>
@endsection
