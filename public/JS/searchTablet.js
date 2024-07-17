document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("mysearch");
    const tableBody = document.querySelector("#tablet-table tbody");

    searchInput.addEventListener("keyup", function () {
        const query = searchInput.value.trim();
        fetch(`/search/tablet?valor=${query}`)
            .then((response) => response.json())
            .then((data) => {
                tableBody.innerHTML = ""; // Limpiar el contenido actual de la tabla
                if (data.estado === 1) {
                    const results = data.result;
                    results.forEach((item) => {
                        let tr = document.createElement("tr");
                        tr.innerHTML = `
                            <td>${item.COLEGA}</td>
                            <td>${item.CUENTA}</td>
                            <td>
                                <div class="Showpwd">
                                    <input type="password" class="password-wrapper" value="${item.ACOUNT_PASSWORD}" readonly>
                                    <i class="fas fa-eye toggle-password"></i>
                                </div>
                            </td>
                            <td>
                                <div class="Showpwd">
                                    <input type="password" class="password-wrapper" value="${item.PIN_DESBLOQUEO}" readonly>
                                    <i class="fas fa-eye toggle-password"></i>
                                </div>
                            </td>
                            <td>${item.MARCA}</td>
                            <td>${item.MODELO}</td>
                            <td>${item.AREA}</td>
                        `;
                        tableBody.appendChild(tr);
                    });
                    $(document).ready(function () {
                        // Ocultamos el menú al cargar la página
                        $("#menu_derecho").hide();
                        $("#edit-modal").hide(); // Ocultamos el modal de edición
                        $("#quick-add-modal").hide(); // Ocultamos el modal de agregar rápidamente

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
                            $("#edit-COLEGA").val(
                                currentRow.find("td:eq(0)").text()
                            );
                            $("#edit-CUENTA").val(
                                currentRow.find("td:eq(1)").text()
                            );
                            $("#edit-ACOUNT_PASSWORD").val(
                                currentRow.find("td:eq(2)").text()
                            );
                            $("#edit-PIN_DESBLOQUEO").val(
                                currentRow.find("td:eq(3)").text()
                            );
                            $("#edit-MARCA").val(
                                currentRow.find("td:eq(4)").text()
                            );
                            $("#edit-MODELO").val(
                                currentRow.find("td:eq(5)").text()
                            );
                            $("#edit-AREA").val(
                                currentRow.find("td:eq(6)").text()
                            );
                        });

                        // Guardar cambios
                        $("#save-changes").click(function () {
                            var formData = {
                                COLEGA: $("#edit-COLEGA").val(),
                                CUENTA: $("#edit-CUENTA").val(),
                                ACOUNT_PASSWORD: $(
                                    "#edit-ACOUNT_PASSWORD"
                                ).val(),
                                PIN_DESBLOQUEO: $("#edit-PIN_DESBLOQUEO").val(),
                                MARCA: $("#edit-MARCA").val(),
                                MODELO: $("#edit-MODELO").val(),
                                AREA: $("#edit-AREA").val(),
                            };

                            $.ajax({
                                url: "/tablets/update/${currentRowId}",
                                type: "POST",
                                data: formData,
                                headers: {
                                    "X-CSRF-TOKEN": $(
                                        'meta[name="csrf-token"]'
                                    ).attr("content"),
                                },
                                success: function (data) {
                                    if (data.status === "success") {
                                        // Actualizamos la fila con los nuevos datos
                                        var row = $(
                                            'tr[data-id="' + currentRowId + '"]'
                                        );
                                        currentRow
                                            .find("td:eq(0)")
                                            .text(formData.COLEGA);
                                        currentRow
                                            .find("td:eq(1)")
                                            .text(formData.CUENTA);
                                        currentRow
                                            .find("td:eq(2) input")
                                            .text(formData.ACOUNT_PASSWORD);
                                        currentRow
                                            .find("td:eq(3) input")
                                            .val(formData.PIN_DESBLOQUEO);
                                        currentRow
                                            .find("td:eq(4)")
                                            .text(formData.MARCA);
                                        currentRow
                                            .find("td:eq(5)")
                                            .text(formData.MODELO);
                                        currentRow
                                            .find("td:eq(6)")
                                            .text(formData.AREA);

                                        $("#edit-modal").hide(); // Ocultamos el modal de edición
                                    } else {
                                        alert(
                                            "Error al actualizar el registro."
                                        );
                                    }
                                },
                            });
                        });

                        // Eliminar
                        $("#delete").click(function () {
                            var id = currentRow.data("id");
                            if (
                                confirm(
                                    "¿Estás seguro de que deseas eliminar este registro?"
                                )
                            ) {
                                $.ajax({
                                    url: `/yubi/delete/${id}`,
                                    type: "DELETE",
                                    headers: {
                                        "X-CSRF-TOKEN": $(
                                            'meta[name="csrf-token"]'
                                        ).attr("content"),
                                    },
                                    success: function (data) {
                                        if (data.status === "success") {
                                            currentRow.remove();
                                        } else {
                                            alert(
                                                "Error al eliminar el registro."
                                            );
                                        }
                                    },
                                });
                            }
                        });

                        // Agregar rápidamente
                        $("#quick-add").click(function () {
                            $("#quick-add-modal").show(); // Mostramos el modal de agregar rápidamente
                        });

                        // Agregar nuevo registro rápidamente
                        $("#add-new").click(function () {
                            var formData = {
                                COLEGA: $("#add-COLEGA").val(),
                                PUESTO: $("#add-PUESTO").val(),
                                SN_YUBIKEY: $("#add-SN_YUBIKEY").val(),
                                PIN_YUBIKEY: $("#add-PIN_YUBIKEY").val(),
                            };

                            $.ajax({
                                url: "/yubi/add",
                                type: "POST",
                                data: formData,
                                headers: {
                                    "X-CSRF-TOKEN": $(
                                        'meta[name="csrf-token"]'
                                    ).attr("content"),
                                },
                                success: function (data) {
                                    if (data.success) {
                                        location.reload(); // Recargar la página para mostrar los nuevos datos
                                    } else {
                                        alert("Error al agregar el registro");
                                    }
                                },
                            });
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
                                $("#quick-add-modal").hide(); // Ocultamos el modal de agregar rápidamente
                            }
                        });
                    });
                    // Mostrar y ocultar contraseñas
                }
            })
            .catch((error) => console.error("Error:", error));
    });
    // Limpiar campos de entrada si el campo de búsqueda está vacío
    $("#mysearch").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#tablet-table tbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    $("#edit-modal, #quick-add-modal").on("hide.bs.modal", function () {
        $(
            "#edit-COLEGA, #edit-CUENTA, #edit-ACOUNT_PASSWORD, #edit-PIN_DESBLOQUEO, #edit-MARCA, #edit-MODELO, #edit-AREA"
        ).val("");
    });
});
