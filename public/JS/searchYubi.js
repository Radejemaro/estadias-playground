document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("mysearch");
    const tableBody = document.querySelector("#yubikey-table tbody");

    searchInput.addEventListener("keyup", function () {
        const query = searchInput.value.trim();
        fetch(`/search/yubi?valor=${query}`)
            .then((response) => response.json())
            .then((data) => {
                tableBody.innerHTML = ""; // Limpiar el contenido actual de la tabla
                if (data.estado === 1) {
                    const results = data.result;
                    results.forEach((item) => {
                        let tr = document.createElement("tr");
                        tr.innerHTML = `
                            <td>${item.COLEGA}</td>
                            <td>${item.PUESTO}</td>
                            <td>${item.SN_YUBIKEY}</td>
                            <td id="PinYubikey">
                                <input type="password" id="PIN" class="password-wrapper" value="${item.PIN_YUBIKEY}" readonly>
                                <i class="fas fa-eye toggle-password"></i>
                            </td>
                        `;
                        tableBody.appendChild(tr);
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
                            $("#edit-PUESTO").val(
                                currentRow.find("td:eq(1)").text()
                            );
                            $("#edit-SN_YUBIKEY").val(
                                currentRow.find("td:eq(2)").text()
                            );
                            $("#edit-PIN_YUBIKEY").val(
                                currentRow.find("td:eq(3) input").val()
                            );
                        });

                        // Guardar cambios
                        $("#save-changes").click(function () {
                            var formData = {
                                COLEGA: $("#edit-COLEGA").val(),
                                PUESTO: $("#edit-PUESTO").val(),
                                SN_YUBIKEY: $("#edit-SN_YUBIKEY").val(),
                                PIN_YUBIKEY: $("#edit-PIN_YUBIKEY").val(),
                            };

                            $.ajax({
                                url: `/yubi/update/${currentRowId}`,
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
                                        currentRow
                                            .find("td:eq(0)")
                                            .text(formData.COLEGA);
                                        currentRow
                                            .find("td:eq(1)")
                                            .text(formData.PUESTO);
                                        currentRow
                                            .find("td:eq(2)")
                                            .text(formData.SN_YUBIKEY);
                                        currentRow
                                            .find("td:eq(3) input")
                                            .val(formData.PIN_YUBIKEY);

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

                    });
                    });


                }
            })
            .catch((error) => console.error("Error:", error));
    });
});
