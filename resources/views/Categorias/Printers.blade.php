@extends('Plantilla')

@section('Titulo', 'Printers')

@section('Estilo')
    <link rel="stylesheet" type="text/css" href="/css/Printers.css">
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
        <h3 id="form-title">Agregar Impresora</h3>
        <input type="text" id="search-add-fields" placeholder="Buscar en formulario">
        <form id="form" method="POST" action="">
            @csrf
            <input type="hidden" id="form-method" name="_method" value="POST">
            @foreach (['No_SERIE', 'IP_USB', 'IP_HYATT', 'MAC_ACTIVA', 'TIPO', 'MARCA', 'MODELO', 'UBICACION', 'DEPARTAMENTO', 'COMENTARIOS', 'SWITCH', 'IP_SWITCH', 'PUERTO_SW'] as $field)
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

        <button type="button" onclick="tableToCSV()" id="btn_csv">
            Exportar como CSV
        </button><br>
        <button type="button" id="btn_add">
            Agregar Impresora
        </button>
    </div>

    <script>
        $(document).ready(function() {
            // Búsqueda dinámica en la tabla
            $('#mysearch').on('keyup', function() {
                const value = $(this).val().toLowerCase();
                $("#printer-table tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });

            // Búsqueda dinámica en el formulario
            $('#search-add-fields').on('keyup', function() {
                const value = $(this).val().toLowerCase();
                $("#form .form-group").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });

            // Manejo del menú de clic derecho
            $('#printer-table tbody tr').on('contextmenu', function(e) {
                e.preventDefault(); // Evitar el menú contextual del navegador
                let id = $(this).data('id');

                $('#menu_derecho').css({
                    display: 'block',
                    left: e.pageX,
                    top: e.pageY
                }).data('id', id);
            });

            // Manejo de clic fuera del menú
            $(document).on('click', function(e) {
                if (!$(e.target).closest('#menu_derecho').length) {
                    $('#menu_derecho').hide();
                }
            });

            // Manejo de clic dentro del menú para evitar que se oculte
            $('#menu_derecho').on('click', function(e) {
                e.stopPropagation();
            });

            $('#add').click(function() {
                $('#form-modal').show();
                $('#form').attr('action', "{{ route('printers.store') }}");
                $('#form-method').val('POST');
                $('#form-title').text('Agregar Impresora');
                $('#form')[0].reset();
                $('#menu_derecho').hide(); // Ocultar menú al agregar
            });

            $('#btn_add').click(function() {
                $('#form-modal').show();
                $('#form').attr('action', "{{ route('printers.store') }}");
                $('#form-method').val('POST');
                $('#form-title').text('Agregar Impresora');
                $('#form')[0].reset();
            });

            $('#edit').click(function() {
                let id = $('#menu_derecho').data('id');
                if (id) {
                    $.get("{{ url('printers') }}/" + id + "/edit", function(data) {
                        $('#form-modal').show();
                        $('#form').attr('action', "{{ url('printers') }}/" + id);
                        $('#form-method').val('PUT');
                        $('#form-title').text('Editar Impresora');
                        $.each(data, function(key, value) {
                            $('#form-' + key).val(value);
                        });
                        $('#menu_derecho').hide(); // Ocultar menú al editar
                    });
                }
            });

            $('#delete').click(function() {
                let id = $('#menu_derecho').data('id');
                if (id) {
                    if (confirm('¿Estás seguro de que deseas eliminar esta Impresora?')) {
                        $.ajax({
                            url: "{{ url('printers') }}/" + id,
                            type: 'DELETE',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function() {
                                $('#printer-table tbody tr[data-id="' + id + '"]').remove();
                                $('#menu_derecho').hide(); // Ocultar menú después de eliminar
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    }
                }
            });
        });

        // Function to export to CSV
        function tableToCSV() {
            let csv_data = [];
            let rows = $('#printer-table thead tr, #printer-table tbody tr:visible');
            rows.each(function() {
                let cols = $(this).find('td, th');
                let csvrow = [];
                cols.each(function() {
                    csvrow.push($(this).text());
                });
                csv_data.push(csvrow.join(","));
            });
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
