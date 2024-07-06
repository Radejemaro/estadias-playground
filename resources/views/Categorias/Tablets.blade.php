@extends('Plantilla')

@section('Titulo', 'Tablets')

@section('Estilo')

    <link rel="stylesheet" type="text/css" href="/css/Tablets.css">

@endsection

@section('Contenido')
<div class="container">
    <table>
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
    <div id="info" style="display: none;">
        <!-- Detalles adicionales aquí -->
    </div>
</div>
@endsection
