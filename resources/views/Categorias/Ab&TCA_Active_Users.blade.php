@extends('Plantilla')

@section('Titulo', 'Abril&TCA - Active Users')

@section('Estilo')
    <link rel="stylesheet" type="text/css" href="/css/Active_Users.css">
@endsection

@section('Contenido')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div id="menu_derecho" style="display: none;">
        <ul>
            <li id="delete"><a>Eliminar</a></li>
            <li id="edit"><a>Editar</a></li>
            <li id="add"><a>Agregar</a></li>
        </ul>
    </div>

    <div id="form-modal" class="modal-scrollable" style="display: none;">
        <h3 id="form-title">Agregar Usuario</h3>
        <input type="text" id="search-add-fields" placeholder="Buscar en formulario">
        <form id="form" method="POST" action="">
            @csrf
            <input type="hidden" id="form-method" name="_method" value="POST">
            @foreach (['ID_JUPITER', 'PLATAFORMA', 'NOMBRE', 'CLAVE_CORTA', 'COLABORADOR', 'PUESTO', 'FECHA_ALTA'] as $field)
                <div class="form-group">
                    <label for="form-{{ $field }}">{{ ucwords(str_replace('_', ' ', strtolower($field))) }}:</label>
                    <input type="text" id="form-{{ $field }}" name="{{ $field }}">
                </div>
            @endforeach
            <button type="submit" id="save-button">Guardar</button>
            <button type="button" onclick="$('#form-modal').hide();">Cancelar</button>
        </form>
    </div>

    <div class="container">
        <h2><input type="text" id="mysearch" placeholder="Buscar en Active Users"></h2>

        <table id="active_users-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>PLATAFORMA</th>
                    <th>NOMBRE</th>
                    <th>CLAVE CORTA</th>
                    <th>COLABORADOR</th>
                    <th>PUESTO</th>
                    <th>FECHA ALTA</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($active_users as $active_user)
                    <tr data-id="{{ $active_user->id }}">
                        <td>{{ $active_user->ID_JUPITER }}</td>
                        <td>{{ $active_user->PLATAFORMA }}</td>
                        <td>{{ $active_user->NOMBRE }}</td>
                        <td>{{ $active_user->CLAVE_CORTA }}</td>
                        <td>{{ $active_user->COLABORADOR }}</td>
                        <td>{{ $active_user->PUESTO }}</td>
                        <td>{{ $active_user->FECHA_ALTA }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table><br>

        <button type="button" onclick="tableToCSV()" id="btn_csv">
            Exportar como CSV
        </button><br>
        <button type="button" id="btn_add">
            Agregar Usuario
        </button>
    </div>

    <script>
        $(document).ready(function() {

            // Dynamic search in table
            $('#mysearch').on('keyup', function() {
                const value = $(this).val().toLowerCase();
                $("#active_users-table tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            // Dynamic search in form
            $('#search-add-fields').on('keyup', function() {
                const value = $(this).val().toLowerCase();
                $("#form .form-group").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            // Handle right-click menu
            $('#active_users-table tbody tr').contextmenu(function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $('#menu_derecho').css({
                    display: 'block',
                    left: e.pageX,
                    top: e.pageY
                }).data('id', id);
            });

            $(document).click(function() {
                $('#menu_derecho').hide();
            });

            $('#add').click(function() {
                $('#form-modal').show();
                $('#form').attr('action', "{{ route('tcausers.store') }}");
                $('#form-method').val('POST');
                $('#form-title').text('Agregar Usuario Activo');
                $('#form')[0].reset();
            });

            $('#btn_add').click(function() {
                $('#form-modal').show();
                $('#form').attr('action', "{{ route('tcausers.store') }}");
                $('#form-method').val('POST');
                $('#form-title').text('Agregar Usuario Activo');
                $('#form')[0].reset();
            });

            $('#edit').click(function() {
                let id = $('#menu_derecho').data('id');
                if (id) {
                    $.get("{{ url('tcausers') }}/" + id + "/edit", function(data) {
                        $('#form').attr('action', "{{ url('tcausers') }}/" + id);
                        $('#form-method').val('PUT');
                        $('#form-title').text('Editar Usuario');
                        $.each(data, function(key, value) {
                            $('#form-' + key).val(value);
                        });
                        $('#form-modal').show(); // Move this line here
                    });
                }
            });

            $('#delete').click(function() {
                let id = $('#menu_derecho').data('id');
                if (id) {
                    if (confirm('¿Estás seguro de que deseas eliminar este usuario activo?')) {
                        $.ajax({
                            url: "{{ url('tcausers') }}/" + id,
                            type: 'DELETE',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function() {
                                window.location.reload();
                            }
                        });
                    }
                }
            });
        });

        // Function to export to CSV
        function tableToCSV() {
            let csv_data = [];
            let rows = document.getElementsByTagName('tr');
            for (let i = 0; i < rows.length; i++) {
                let cols = rows[i].querySelectorAll('td,th');
                let csvrow = [];
                for (let j = 0; j < cols.length; j++) {
                    csvrow.push(cols[j].innerText);
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
