$(document).ready(function () {
    // Ocultamos el menú al cargar la página
    $("#menu_derecho").hide();
    $("#edit-modal").hide(); // Ocultamos el modal de edición

    var currentRow;
    var currentRowId;

    /* mostramos el menú si hacemos click derecho con el ratón en una celda de la tabla */
    $("table td").bind("contextmenu", function (e) {
        currentRow = $(this).closest("tr"); // Obtenemos la fila actual
        currentRowId = currentRow.data("id"); // Obtenemos el ID de la fila actual
        $("#menu_derecho").css({
            display: "block",
            left: e.pageX,
            top: e.pageY,
        });
        return false;
    });

    // Editar
    $("#edit").click(function () {
        $("#edit-modal").show(); // Mostramos el modal de edición

        // Rellenamos el formulario con los datos actuales
        $("#edit-COLEGA").val(currentRow.find("td:eq(0)").text());
        $("#edit-PUESTO").val(currentRow.find("td:eq(1)").text());
        $("#edit-SN_YUBIKEY").val(currentRow.find("td:eq(2)").text());
        $("#edit-PIN_YUBIKEY").val(currentRow.find("td:eq(3)").text());
    });

    // Guardar cambios
    $("#save-changes").click(function () {
        var formData = {
            NOMBRE_PC: $("#edit-COLEGA").val(),
            No_SERIE: $("#edit-PUESTO").val(),
            MODELO_PC: $("#edit-SN_YUBIKEY").val(),
            TIPO: $("#edit-PIN_YUBIKEY").val(),
        };

        $.ajax({
            url: `/yubikeys/update/${currentRowId}`,
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data) {
                if (data.status === "success") {
                    // Actualizamos la fila con los nuevos datos
                    currentRow.find("td:eq(0)").text(formData.COLEGA);
                    currentRow.find("td:eq(1)").text(formData.PUESTO);
                    currentRow.find("td:eq(2)").text(formData.SN_YUBIKEY);
                    currentRow.find("td:eq(3)").text(formData.PIN_YUBIKEY);

                    $("#edit-modal").hide(); // Ocultamos el modal de edición
                } else {
                    alert("Error al actualizar el registro.");
                }
            },
        });
    });

    // Eliminar
    $("#delete").click(function () {
        var id = currentRow.data("id");
        if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
            $.ajax({
                url: `/computers/delete/${id}`,
                type: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (data) {
                    if (data.status === "success") {
                        currentRow.remove();
                    } else {
                        alert("Error al eliminar el registro.");
                    }
                },
            });
        }
    });

    // Cuando hagamos click, el menú desaparecerá
    $(document).click(function (e) {
        if (e.button == 0) {
            $("#menu_derecho").css("display", "none");
        }
    });

    // Si pulsamos escape, el menú desaparecerá
    $(document).keydown(function (e) {
        if (e.keyCode == 27) {
            $("#menu_derecho").css("display", "none");
            $("#edit-modal").hide(); // Ocultamos el modal de edición
        }
    });
});
