@extends('Plantilla')

@section('Titulo', 'Usuarios')

@section('Estilo')
<link rel="stylesheet" type="text/css" href="/css/Yubikeys.css">
@endsection

@section('Contenido')
<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div id="form-modal" class="modal-scrollable" style="display: none;">
    <h3 id="form-title">Editar Usuario</h3>
    <form id="form" method="POST" action="">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="form-name">Nombre:</label>
            <input type="text" id="form-name" name="name" required>
        </div>
        <div class="form-group">
            <label for="form-password">Contraseña:</label>
            <input type="password" id="form-password" name="password">
            <button type="button" id="toggle-password">Mostrar</button>
        </div>
        <button type="submit" id="save-button">Guardar</button>
        <button type="button" onclick="$('#form-modal').hide();">Cancelar</button>
    </form>
</div>

<div class="container">
    <h2>Usuarios</h2>

    <table id="user-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Contraseña</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr data-id="{{ $user->id }}">
                    <td>{{ $user->name }}</td>
                    <td class="password-cell">
                        <span class="password">{{ str_repeat('*', strlen($user->password)) }}</span>
                        <button type="button" class="toggle-password">Mostrar</button>
                    </td>
                    <td>
                        <button type="button" class="edit-button">Editar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        // Manejo de clic para mostrar/ocultar contraseña
        $(document).on('click', '.toggle-password', function() {
            let passwordCell = $(this).closest('.password-cell');
            let passwordSpan = passwordCell.find('.password');
            let passwordText = passwordSpan.text();
            if ($(this).text() === 'Mostrar') {
                passwordSpan.text(passwordText);
                $(this).text('Ocultar');
            } else {
                passwordSpan.text('*'.repeat(passwordText.length));
                $(this).text('Mostrar');
            }
        });

        // Manejo de clic para editar usuario
        $('.edit-button').click(function() {
            let id = $(this).closest('tr').data('id');
            let name = $(this).closest('tr').find('td:first').text();
            $('#form-modal').show();
            $('#form').attr('action', '/users/' + id);
            $('#form-name').val(name);
            $('#form-password').val('');
            $('#form-title').text('Editar Usuario');
        });

        // Manejo de clic para cancelar
        $('#form-modal button[type="button"]').click(function() {
            $('#form-modal').hide();
        });

        // Mostrar/Ocultar contraseña en el formulario
        $('#toggle-password').click(function() {
            let passwordField = $('#form-password');
            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                $(this).text('Ocultar');
            } else {
                passwordField.attr('type', 'password');
                $(this).text('Mostrar');
            }
        });
    });
</script>
@endsection
