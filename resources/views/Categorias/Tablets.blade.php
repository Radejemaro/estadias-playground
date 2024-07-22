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
        <form id="add-form">
            @foreach ([
                'ID_JUPITER', 'COLEGA', 'CUENTA', 'ACOUNT_PASSWORD', 'PIN_DESBLOQUEO',
                'ESTATUS', 'MARCA', 'MODELO', 'NO_SERIE', 'MAC', 'AREA', 'COMENTARIOS'
            ] as $field)
                <div class="form-group">
                    <label for="add-{{ $field }}">{{ ucwords(str_replace('_', ' ', strtolower($field))) }}:</label>
                    <input type="text" id="add-{{ $field }}" name="{{ $field }}">
                </div>
            @endforeach
            <button type="button" id="save-add">Guardar</button>
            <button type="button" onclick="$('#quick-add-modal').hide();">Cancelar</button>
        </form>
    </div>

    <div id="edit-modal" class="modal-scrollable" style="display: none;">
        <h3>Editar Tablet</h3>
        <form id="edit-form">
            @foreach ([
                'COLEGA', 'CUENTA', 'ACOUNT_PASSWORD', 'PIN_DESBLOQUEO',
                'MARCA', 'MODELO', 'AREA'
            ] as $field)
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
                                <input type="password" id="ACOUNT_PASSWORD" class="password-wrapper" value="{{ $tablet->ACOUNT_PASSWORD }}" readonly>
                                <i class="fas fa-eye toggle-password"></i>
                            </div>
                        </td>
                        <td id="PinDesbloqueo">
                            <div class="password-wrapper">
                                <input type="password" id="PIN_DESBLOQUEO" class="password-wrapper" value="{{ $tablet->PIN_DESBLOQUEO }}" readonly>
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

        $(document).ready(function() {
            $('#add-button').click(function() {
                $('#quick-add-modal').show();
            });

            $('#save-add').click(function() {
                let formData = $('#add-form').serialize();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('tablets.create') }}',
                    data: formData,
                    success: function(response) {
                        alert('Tablet agregada exitosamente');
                        location.reload();
                    },
                    error: function(error) {
                        console.log(error);
                        alert('Hubo un error al agregar la tablet');
                    }
                });
            });

            $('#save-changes').click(function() {
                let id = $('#edit-form').data('id');
                let formData = $('#edit-form').serialize();
                $.ajax({
                    type: 'PUT',
                    url: `/tablets/${id}`,
                    data: formData,
                    success: function(response) {
                        alert('Cambios guardados exitosamente');
                        location.reload();
                    },
                    error: function(error) {
                        console.log(error);
                        alert('Hubo un error al guardar los cambios');
                    }
                });
            });

            $('#search-add-fields').on('input', function() {
                let value = $(this).val().toLowerCase();
                $('#add-form .form-group').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });

            $(document).on('click', '.toggle-password', function() {
                let input = $(this).siblings('input');
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                } else {
                    input.attr('type', 'password');
                }
            });

            $('#tablet-table').on('click', 'tr', function() {
                let id = $(this).data('id');
                let row = $(this);
                $('#edit-form').data('id', id);
                $('#edit-COLEGA').val(row.find('td').eq(0).text());
                $('#edit-CUENTA').val(row.find('td').eq(1).text());
                $('#edit-ACOUNT_PASSWORD').val(row.find('#ACOUNT_PASSWORD input').val());
                $('#edit-PIN_DESBLOQUEO').val(row.find('#PinDesbloqueo input').val());
                $('#edit-MARCA').val(row.find('td').eq(4).text());
                $('#edit-MODELO').val(row.find('td').eq(5).text());
                $('#edit-AREA').val(row.find('td').eq(6).text());
                $('#edit-modal').show();
            });
        });
    </script>
@endsection
