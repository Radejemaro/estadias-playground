@extends ('Plantilla')

@section('Titulo', 'Computers')

@section('Estilo')

    <link rel="stylesheet" type="text/css" href="css/Computers.css">

@endsection

@section('Contenido')

    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Articulo</th>
                    <th>No. Serie</th>
                    <th>Modelo</th>
                    <th>Tipo</th>
                    <th>Marca</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($computers as $computer)
                    <tr data-id="{{ $computer->id }}" class="computer-row">
                        <td>{{ $computer->Articulo }}</td>
                        <td>{{ $computer->No_Serie }}</td>
                        <td>{{ $computer->Modelo }}</td>
                        <td>{{ $computer->Tipo }}</td>
                        <td>{{ $computer->Marca }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="computer-info" style="display: none;">
        <!-- Aquí se mostrará la información adicional -->
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.computer-row').forEach(function(row) {
                row.addEventListener('click', function() {
                    const id = this.dataset.id;
                    fetch(`/Categorias/Computers/${id}`)
                        .then(response => response.json())
                        .then(data => {
                            const infoDiv = document.getElementById('computer-info');
                            infoDiv.innerHTML = `
                        <p><strong>Articulo:</strong> ${data.Articulo}</p>
                        <p><strong>No. Serie:</strong> ${data.No_Serie}</p>
                        <p><strong>Modelo:</strong> ${data.Modelo}</p>
                        <p><strong>Tipo:</strong> ${data.Tipo}</p>
                        <p><strong>Marca:</strong> ${data.Marca}</p>
                    `;
                            infoDiv.style.display = 'block';
                        });
                });
            });
        });
    </script>

@endsection
