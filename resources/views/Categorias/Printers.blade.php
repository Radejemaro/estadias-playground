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
            <li id="add"><a href="{{ route('jupiter.create') }}">Agregar</a></li>
        </ul>
    </div>

    <div id="edit-modal"
        style="display:none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border: 1px solid black; z-index: 1000;">
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

        <table id="printers-table">
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

        <button type="button" onclick="tableToCSV()">
            Exportar como CSV
        </button><br>
    </div>

    {{-- Logica para exportar mi busqueda actual a CSV --}}
    <script type="text/javascript">
        function tableToCSV() {
            // Variable to store the final csv data
            let csv_data = [];

            // Get each row data
            let rows = document.getElementsByTagName('tr');
            for (let i = 0; i < rows.length; i++) {
                // Get each column data
                let cols = rows[i].querySelectorAll('td,th');
                // Stores each csv row data
                let csvrow = [];
                for (let j = 0; j < cols.length; j++) {
                    // Get the text data of each cell
                    // of a row and push it to csvrow
                    csvrow.push(cols[j].innerHTML);
                }
                // Combine each column value with comma
                csv_data.push(csvrow.join(","));
            }
            // Combine each row data with new line character
            csv_data = csv_data.join('\n');
            // Call this function to download csv file
            downloadCSVFile(csv_data);
        }

        function downloadCSVFile(csv_data) {
            // Create CSV file object and feed
            // our csv_data into it
            CSVFile = new Blob([csv_data], {
                type: "text/csv"
            });

            // Create to temporary link to initiate
            // download process
            let temp_link = document.createElement('a');

            // Download csv file
            temp_link.download = "Consulta.csv";
            let url = window.URL.createObjectURL(CSVFile);
            temp_link.href = url;

            // This link should not be displayed
            temp_link.style.display = "none";
            document.body.appendChild(temp_link);

            // Automatically click the link to
            // trigger download
            temp_link.click();
            document.body.removeChild(temp_link);
        }
    </script>
@endsection
