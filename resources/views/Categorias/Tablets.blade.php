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
    <script src="{{ asset('JS/ddl_buttons_Tablet.js') }}"></script>

    <div id="menu_derecho">
        <ul>
            <li id="delete"><a>Eliminar</a></li>
            <li id="edit"><a href="#" id="edit-button">Editar</a></li>
            <li id="add"><a href="{{ route('tablets.create') }}">Agregar</a></li>
        </ul>
    </div>

    <div id="edit-modal" class="modal-scrollable" style="display: none;">
        <h3>Editar Tablet</h3>
        <form id="edit-form">
            <label for="edit-COLEGA">Colega:</label>
            <input type="text" id="edit-COLEGA" name="COLEGA"><br>

            <label for="edit-CUENTA">Cuenta:</label>
            <input type="text" id="edit-CUENTA" name="CUENTA"><br>

            <label for="edit-ACOUNT_PASSWORD">Account Password:</label>
            <div class="password-wrapper">
                <input type="password" id="edit-ACOUNT_PASSWORD" name="ACOUNT_PASSWORD">
                <i class="fas fa-eye toggle-password"></i>
            </div><br>

            <label for="edit-PIN_DESBLOQUEO">PIN Desbloqueo:</label>
            <div class="password-wrapper">
                <input type="password" id="edit-PIN_DESBLOQUEO" name="PIN_DESBLOQUEO">
                <i class="fas fa-eye toggle-password"></i>
            </div><br>

            <label for="edit-MARCA">Marca:</label>
            <input type="text" id="edit-MARCA" name="MARCA"><br>

            <label for="edit-MODELO">Modelo:</label>
            <input type="text" id="edit-MODELO" name="MODELO"><br>

            <label for="edit-AREA">Área:</label>
            <input type="text" id="edit-AREA" name="AREA"><br>

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
