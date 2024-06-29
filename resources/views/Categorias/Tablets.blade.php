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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const rows = document.querySelectorAll('tbody tr');
    rows.forEach(row => {
        row.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            fetch(`Categorias/Computers/${id}`)
                .then(response => response.json())
                .then(data => {
                    const infoDiv = document.getElementById('info');
                    infoDiv.innerHTML = `
                        <p><strong>Articulo:</strong> ${data.NOMBRE_PC}</p>
                        <p><strong>No.Serie:</strong> ${data.No_SERIE}</p>
                        <p><strong>Modelo:</strong> ${data.MODELO_PC}</p>
                        <p><strong>Tipo:</strong> ${data.TIPO}</p>
                        <p><strong>Marca:</strong> ${data.DIVISION}</p>
                        <!-- Agrega más campos aquí -->
                    `;
                    infoDiv.style.display = 'block';
                });
        });
    });
});
</script>
@endsection