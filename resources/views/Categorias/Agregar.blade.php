@extends('Plantilla')

@section('Titulo', 'Agregar')

@section('Estilo')
    <link rel="stylesheet" type="text/css" href="/css/Agregar.css">
@endsection

@section('Contenido')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <div class="container">
        <h2>Agregar Nuevo Registro</h2>
        <form id="add-form">
        <div class="colum1">
            <label for="GID">GID</label>
            <input type="text" id="GID" name="GID"><br>

            <label for="ID_JUPITER">ID Jupiter</label>
            <input type="text" id="ID_JUPITER" name="ID_JUPITER"><br>

            <label for="COLEGA">Colega</label>
            <input type="text" id="COLEGA" name="COLEGA"><br>

            <label for="PUESTO">Puesto</label>
            <input type="text" id="PUESTO" name="PUESTO"><br>

            <label for="DIVISION">División</label>
            <input type="text" id="DIVISION" name="DIVISION"><br>

            <label for="DEPTO">Departamento:/label>
            <input type="text" id="DEPTO" name="DEPTO"><br>

            <label for="VIP">VIP</label>
            <input type="text" id="VIP" name="VIP"><br>

            <label for="EMAIL_HYATT">Email Hyatt</label>
            <input type="email" id="EMAIL_HYATT" name="EMAIL_HYATT"><br>

            <label for="CONTRASENA">Contraseña</label>
            <input type="password" id="CONTRASENA" name="CONTRASENA"><br>

            <label for="PIN_YUBIKEY">Pin YubiKey</label>
            <input type="password" id="PIN_YUBIKEY" name="PIN_YUBIKEY"><br>
</div>
<div class="colum2">
            <label for="SN_YUBIKEY">Serial YubiKey</label>
            <input type="text" id="SN_YUBIKEY" name="SN_YUBIKEY"><br>

            <label for="INTUNE">INTUNE</label>
            <input type="text" id="INTUNE" name="INTUNE"><br>

            <label for="COMPARTIDA">Compartida</label>
            <input type="text" id="COMPARTIDA" name="COMPARTIDA"><br>

            <label for="NOMBRE_PC">Nombre PC</label>
            <input type="text" id="NOMBRE_PC" name="NOMBRE_PC"><br>

            <label for="No_SERIE">No. Serie</label>
            <input type="text" id="No_SERIE" name="No_SERIE"><br>

            <label for="IP">IP</label>
            <input type="text" id="IP" name="IP"><br>

            <label for="IP_WIFION">IP WIFI ON</label>
            <input type="text" id="IP_WIFION" name="IP_WIFION"><br>

            <label for="TIPO">Tipo</label>
            <input type="text" id="TIPO" name="TIPO"><br>

            <label for="MODELO_PC">Modelo PC</label>
            <input type="text" id="MODELO_PC" name="MODELO_PC"></label><br>

            <label for="VENCIMIENTO_SOPORTE">Vencimiento Soporte</label>
            <input type="date" id="VENCIMIENTO_SOPORTE" name="VENCIMIENTO_SOPORTE"></label><br>
</div>
<div class="colum3">
            <label for="No_OS">Sistema Operativo</label>
            <input type="text" id="No_OS" name="No_OS"></label><br>

            <label for="No_PRODUCTO">No. Producto</label>
            <input type="text" id="No_PRODUCTO" name="No_PRODUCTO">

            <label for="BITS">Bits</label>
            <input type="text" id="BITS" name="BITS"></label><br>

            <label for="RAM">RAM</label>
            <input type="text" id="RAM" name="RAM"></label><br>

            <label for="DISCO_DURO">Disco Duro</label>
            <input type="text" id="DISCO_DURO" name="DISCO_DURO"></label><br>

            <label for="PROCESADOR">Procesador</label>
            <input type="text" id="PROCESADOR" name="PROCESADOR"></label><br>

            <label for="CUENTA_OFFICE_365">Cuenta Office 365</label>
            <input type="text" id="CUENTA_OFFICE_365" name="CUENTA_OFFICE_365"></label><br>

            <label for="ANTIVIRUS">Antivirus</label>
            <input type="text" id="ANTIVIRUS" name="ANTIVIRUS"></label><br>

            <label for="MONITOR">Monitor</label>
            <input type="text" id="MONITOR" name="MONITOR"></label><br>

            <label for="MODELO">Modelo</label>
            <input type="text" id="MODELO" name="MODELO"></label><br>
</div>
<div class="colum4">
            <label for="No_SERIAL">No. Serial</label>
            <input type="text" id="No_SERIAL" name="No_SERIAL"></label><br>

            <label for="OBSERVACIONES">Observaciones</label>
            <input type="text" id="OBSERVACIONES" name="OBSERVACIONES"></label><br>

            <label for="MAC">MAC</label>
            <input type="text" id="MAC" name="MAC"></label><br>

            <label for="SWITCH">Switch</label>
            <input type="text" id="SWITCH" name="SWITCH"></label><br>

            <label for="SWITCHPORT_CONNECTED">Switch Port Connected</label>
            <input type="text" id="SWITCHPORT_CONNECTED" name="SWITCHPORT_CONNECTED"></label><br>

            <label for="RESGUARDOS_FIRMADOS">Resguardos Firmados</label>
            <input type="text" id="RESGUARDOS_FIRMADOS" name="RESGUARDOS_FIRMADOS"></label><br>

            <label for="USB_POLICY">USB Policy</label>
            <input type="text" id="USB_POLICY" name="USB_POLICY"></label><br>

            <label for="JUSTIFICACION">Justificación</label>
            <input type="text" id="JUSTIFICACION" name="JUSTIFICACION"></label><br>

            <label for="RESGUARDO">Resguardo</label>
            <input type="text" id="RESGUARDO" name="RESGUARDO"></label><br>
</div>
            <button type="button" id="add-record">Agregar</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#add-record').click(function() {
                var formData = $('#add-form').serialize();
                $.ajax({
                    url: "{{ route('jupiter.store') }}",
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        alert('Campo agregado correctamente');
                        $('#add-form')[0].reset();
                    },
                    error: function(response) {
                        alert('Error al agregar el campo');
                    }
                });
            });
        });
    </script>
@endsection
