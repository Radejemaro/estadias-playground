@extends('Plantilla')

@section('Titulo', 'Tablets')

@section('Estilo')
    <link rel="stylesheet" type="text/css" href="/css/Tablets.css">
@endsection

@section('Contenido')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://kit.fontawesome.com/92b6cbde7e.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('JS/show_info_Tablet.js') }}"></script>
    <script src="{{ asset('JS/searchTablet.js') }}" type="module"></script>

    <div id="menu_derecho">
        <ul>
            <li id="delete"><a>Eliminar</a></li>
            <li id="edit"><a href="#" id="edit-button">Editar</a></li>
            <li id="add"><a href="#" id="add-button">Agregar</a></li>
        </ul>
    </div>

    <div id="quick-add-modal" class="modal-scrollable" style="display: none;">
        <h3>Agregar Tablet</h3>
        <input type="text" id="search-add-fields" placeholder="Buscar en formulario">
        <form id="add-form" method="POST" action="{{ route('tablets.store') }}">
            @csrf
            @foreach (['ID_JUPITER', 'COLEGA', 'CUENTA', 'ACOUNT_PASSWORD', 'PIN_DESBLOQUEO', 'ESTATUS', 'MARCA', 'MODELO', 'NO_SERIE', 'MAC', 'AREA', 'COMENTARIOS'] as $field)
                <div class="form-group">
                    <label for="add-{{ $field }}">{{ ucwords(str_replace('_', ' ', strtolower($field))) }}:</label>
                    <input type="text" id="add-{{ $field }}" name="{{ $field }}">
                </div>
            @endforeach
            <button type="submit" id="save-add">Guardar</button>
            <button type="button" onclick="$('#quick-add-modal').hide();">Cancelar</button>
        </form>
    </div>

    <div id="edit-modal" class="modal-scrollable" style="display: none;">
        <h3>Editar Tablet</h3>
        <form id="edit-form">
            @foreach (['COLEGA', 'CUENTA', 'ACOUNT_PASSWORD', 'PIN_DESBLOQUEO', 'MARCA', 'MODELO', 'AREA'] as $field)
                <div class="form-group">
                    <label for="edit-{{ $field }}">{{ ucwords(str_replace('_', ' ', strtolower($field))) }}:</label>
                    <input type="text" id="edit-{{ $field }}" name="{{ $field }}">
                </div>
            @endforeach
            <button type="button" id="save-changes">Guardar Cambios</button>
            <button type="button" onclick="$('#edit-modal').hide();">Cancelar</button>
        </form>
    </div>

    <div class="container">
        <h2><input type="text" id="mysearch" placeholder="Buscar en Tablets"></h2>

        <table id="tablet-table">
            <thead>
                <tr>
                    <th>Colega</th>
                    <th>Cuenta</th>
                    <th>Account Password</th>
                    <th>PIN Desbloqueo</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Area</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tablets as $tablet)
                    <tr data-id="{{ $tablet->id }}">
                        <td>{{ $tablet->COLEGA }}</td>
                        <td>{{ $tablet->CUENTA }}</td>
                        <td id="AccountPassword">
                            <div class="password-wrapper">
                                <input type="password" id="ACOUNT_PASSWORD" class="password-wrapper"
                                    value="{{ $tablet->ACOUNT_PASSWORD }}" readonly>
                                <i class="fas fa-eye toggle-password"></i>
                            </div>
                        </td>
                        <td id="PinDesbloqueo">
                            <div class="password-wrapper">
                                <input type="password" id="PIN_DESBLOQUEO" class="password-wrapper"
                                    value="{{ $tablet->PIN_DESBLOQUEO }}" readonly>
                                <i class="fas fa-eye toggle-password"></i>
                            </div>
                        </td>
                        <td>{{ $tablet->MARCA }}</td>
                        <td>{{ $tablet->MODELO }}</td>
                        <td>{{ $tablet->AREA }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table><br>

        <button type="button" onclick="tableToCSV()">
            Exportar como CSV
        </button><br>
    </div>

    <script>
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
            let CSVFile = new Blob([csv_data], {
                type: "text/csv"
            });
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
