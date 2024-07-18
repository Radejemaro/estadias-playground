@extends('Plantilla')

@section('Titulo', 'YubiKeys')

@section('Estilo')
    <link rel="stylesheet" type="text/css" href="/css/YubiKeys.css">
@endsection

@section('Contenido')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://kit.fontawesome.com/92b6cbde7e.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('JS/show_info.js') }}"></script>
    <script src="{{ asset('JS/searchYubi.js') }}" type="module"></script>

    <div id="menu_derecho">
        <ul>
            <li id="delete"><a>Eliminar</a></li>
            <li id="edit"><a>Editar</a></li>
            <li id="add"><a href="{{ route('jupiter.create') }}">Agregar</a></li>
        </ul>
    </div>

    <div id="edit-modal" style="">
        <h3>Editar YubiKey</h3>
        <form id="edit-form">
            <label for="edit-COLEGA">Colega:</label>
            <input type="text" id="edit-COLEGA" name="COLEGA"><br>

            <label for="edit-PUESTO">Puesto:</label>
            <input type="text" id="edit-PUESTO" name="PUESTO"><br>

            <label for="edit-SN_YUBIKEY">YubiKey:</label>
            <input type="text" id="edit-SN_YUBIKEY" name="SN_YUBIKEY"><br>

            <label for="edit-PIN_YUBIKEY">Pin YubiKey:</label>
            <div class="password-wrapper">
                <input type="password" id="edit-PIN_YUBIKEY" name="PIN_YUBIKEY">
                <i id="toggle-password" class="fas fa-eye toggle-password"></i>
            </div><br>

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
                    <tr data-id="{{ $yubikey->id }}">
                        <td>{{ $yubikey->COLEGA }}</td>
                        <td>{{ $yubikey->PUESTO }}</td>
                        <td>{{ $yubikey->SN_YUBIKEY }}</td>
                        <td id="PinYubikey">
                            <input type="password" id="PIN" class="password-wrapper"
                                value="{{ $yubikey->PIN_YUBIKEY }}" readonly>
                            <i class="fas fa-eye toggle-password"></i>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table><br>

        <button type="button" onclick="tableToCSV()">
            Export as CSV
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
