@extends('Plantilla')

@section('Titulo', 'Printers')

@section('Estilo')
    <link rel="stylesheet" type="text/css" href="/css/Printers.css">
@endsection

@section('Contenido')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('JS/show_info.js') }}"></script>
    <script src="{{ asset('JS/searchPrint.js') }}" type="module"></script>

    <div id="menu_derecho">
        <ul>
            <li id="delete"><a>Eliminar</a></li>
            <li id="edit"><a>Editar</a></li>
            <li id="quick-add-button"><a>Fast add</a></li>
        </ul>
    </div>

    <!-- Quick Add Modal -->
    <div id="quick-add-modal">
        <h3>Agregar Impresora Rápidamente</h3>
        <form id="quick-add-form">
            <label for="quick-add-No_SERIE">No. Serie:</label>
            <input type="text" id="quick-add-No_SERIE" name="No_SERIE"><br>

            <label for="quick-add-IP_USB">IP/USB:</label>
            <input type="text" id="quick-add-IP_USB" name="IP_USB"><br>

            <label for="quick-add-MAC_ACTIVA">Mac Activa:</label>
            <input type="text" id="quick-add-MAC_ACTIVA" name="MAC_ACTIVA"><br>

            <label for="quick-add-TIPO">Tipo:</label>
            <input type="text" id="quick-add-TIPO" name="TIPO"><br>

            <label for="quick-add-MARCA">Marca:</label>
            <input type="text" id="quick-add-MARCA" name="MARCA"><br>

            <label for="quick-add-UBICACION">Ubicación:</label>
            <input type="text" id="quick-add-UBICACION" name="UBICACION"><br>

            <label for="quick-add-DEPARTAMENTO">Departamento:</label>
            <input type="text" id="quick-add-DEPARTAMENTO" name="DEPARTAMENTO"><br>

            <button type="submit">Guardar</button>
            <button type="button" onclick="$('#quick-add-modal').hide();">Cancelar</button>
        </form>
    </div>

    <!-- Edit Modal -->
    <div id="edit-modal">
        <h3>Editar Impresora</h3>
        <form id="edit-form">
            <label for="edit-No_SERIE">No. Serie:</label>
            <input type="text" id="edit-No_SERIE" name="No_SERIE"><br>

            <label for="edit-IP_USB">IP/USB:</label>
            <input type="text" id="edit-IP_USB" name="IP_USB"><br>

            <label for="edit-MAC_ACTIVA">Mac Activa:</label>
            <input type="text" id="edit-MAC_ACTIVA" name="MAC_ACTIVA"><br>

            <label for="edit-TIPO">Tipo:</label>
            <input type="text" id="edit-TIPO" name="TIPO"><br>

            <label for="edit-MARCA">Marca:</label>
            <input type="text" id="edit-MARCA" name="MARCA"><br>

            <label for="edit-UBICACION">Ubicación:</label>
            <input type="text" id="edit-UBICACION" name="UBICACION"><br>

            <label for="edit-DEPARTAMENTO">Departamento:</label>
            <input type="text" id="edit-DEPARTAMENTO" name="DEPARTAMENTO"><br>

            <button type="button" id="save-changes">Guardar Cambios</button>
            <button type="button" onclick="$('#edit-modal').hide();">Cancelar</button>
        </form>
    </div>

    <div class="container">
        <h2><input type="text" id="mysearch" placeholder="Buscar en Printers"></h2>

        <table id="printer-table">
            <thead>
                <tr>
                    <th>No Serie</th>
                    <th>IP/USB</th>
                    <th>Mac Activa</th>
                    <th>Tipo</th>
                    <th>Marca</th>
                    <th>Ubicación</th>
                    <th>Departamento</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($printers as $printer)
                    <tr data-id="{{ $printer->id }}">
                        <td>{{ $printer->No_SERIE }}</td>
                        <td>{{ $printer->IP_USB }}</td>
                        <td>{{ $printer->MAC_ACTIVA }}</td>
                        <td>{{ $printer->TIPO }}</td>
                        <td>{{ $printer->MARCA }}</td>
                        <td>{{ $printer->UBICACION }}</td>
                        <td>{{ $printer->DEPARTAMENTO }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table><br>

        <button type="button" onclick="tableToCSV()">Exportar como CSV</button><br>
    </div>

    {{-- Logica para exportar mi busqueda actual a CSV --}}
    <script type="text/javascript">
        function tableToCSV() {
            let csv_data = [];
            let rows = document.getElementsByTagName('tr');
            for (let i = 0; i < rows.length; i++) {
                let cols = rows[i].querySelectorAll('td,th');
                let csvrow = [];
                for (let j = 0; j < cols.length; j++) {
                    csvrow.push(cols[j].innerHTML);
                }
                csv_data.push(csvrow.join(","));
            }
            csv_data = csv_data.join('\n');
            downloadCSVFile(csv_data);
        }

        function downloadCSVFile(csv_data) {
            let CSVFile = new Blob([csv_data], { type: "text/csv" });
            let temp_link = document.createElement('a');
            temp_link.download = "Consulta.csv";
            let url = window.URL.createObjectURL(CSVFile);
            temp_link.href = url;
            temp_link.style.display = "none";
            document.body.appendChild(temp_link);
            temp_link.click();
            document.body.removeChild(temp_link);
        }
    </script>
@endsection
