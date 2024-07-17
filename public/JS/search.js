import { search } from "./export_search.js";

const mysearch = document.querySelector("#mysearch");
const tableBody = document.querySelector("#computers-table tbody");
const myurl = "/computers/search";

mysearch.addEventListener("keyup", function (event) {
    const query = this.value;

    if (query !== "") {
        fetch(`${myurl}?valor=${query}`)
            .then((response) => response.json())
            .then((data) => {
                tableBody.innerHTML = ""; // Clear current table content

                data.result.forEach((item) => {
                    let tr = document.createElement("tr");
                    tr.setAttribute("data-id", item.id);
                    tr.innerHTML = `
                        <td>${item.NOMBRE_PC}</td>
                        <td>${item.No_SERIE}</td>
                        <td>${item.MODELO_PC}</td>
                        <td>${item.TIPO}</td>
                        <td>${item.PUESTO}</td>
                    `;
                    tableBody.appendChild(tr);

                    tr.addEventListener("click", function () {
                        const infoRow = this.nextElementSibling;
                        if (infoRow && infoRow.classList.contains("info-row")) {
                            infoRow.remove();
                        } else {
                            fetch(`/computers/${item.id}`)
                                .then((response) => response.json())
                                .then((data) => {
                                    let detailsRow =
                                        document.createElement("tr");
                                    detailsRow.classList.add("info-row");
                                    detailsRow.innerHTML = `
                                        <td colspan="5">
                                            <div><strong>Nombre Dispositivo:</strong> ${data.NOMBRE_PC}</div>
                                            <div><strong>No. Serie:</strong> ${data.No_SERIE}</div>
                                            <div><strong>Modelo:</strong> ${data.MODELO_PC}</div>
                                            <div><strong>Tipo:</strong> ${data.TIPO}</div>
                                            <div><strong>Asignado:</strong> ${data.PUESTO}</div>
                                        </td>
                                    `;
                                    this.parentNode.insertBefore(
                                        detailsRow,
                                        this.nextSibling
                                    );
                                });

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
                                    $("#edit-NOMBRE_PC").val(
                                        currentRow.find("td:eq(0)").text()
                                    );
                                    $("#edit-No_SERIE").val(
                                        currentRow.find("td:eq(1)").text()
                                    );
                                    $("#edit-MODELO_PC").val(
                                        currentRow.find("td:eq(2)").text()
                                    );
                                    $("#edit-TIPO").val(
                                        currentRow.find("td:eq(3)").text()
                                    );
                                    $("#edit-PUESTO").val(
                                        currentRow.find("td:eq(4)").text()
                                    );
                                });

                                // Guardar cambios
                                $("#save-changes").click(function () {
                                    var formData = {
                                        NOMBRE_PC: $("#edit-NOMBRE_PC").val(),
                                        No_SERIE: $("#edit-No_SERIE").val(),
                                        MODELO_PC: $("#edit-MODELO_PC").val(),
                                        TIPO: $("#edit-TIPO").val(),
                                        PUESTO: $("#edit-PUESTO").val(),
                                    };

                                    $.ajax({
                                        url: `/computers/update/${currentRowId}`,
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
                                                    .text(formData.NOMBRE_PC);
                                                currentRow
                                                    .find("td:eq(1)")
                                                    .text(formData.No_SERIE);
                                                currentRow
                                                    .find("td:eq(2)")
                                                    .text(formData.MODELO_PC);
                                                currentRow
                                                    .find("td:eq(3)")
                                                    .text(formData.TIPO);
                                                currentRow
                                                    .find("td:eq(4)")
                                                    .text(formData.PUESTO);

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
                                            url: `/computers/delete/${id}`,
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

                                // Cuando hagamos click, el menú desaparecerá
                                $(document).click(function (e) {
                                    if (e.button == 0) {
                                        $("#menu_derecho").css(
                                            "display",
                                            "none"
                                        );
                                    }
                                });

                                // Si pulsamos escape, el menú desaparecerá
                                $(document).keydown(function (e) {
                                    if (e.keyCode == 27) {
                                        $("#menu_derecho").css(
                                            "display",
                                            "none"
                                        );
                                        $("#edit-modal").hide(); // Ocultamos el modal de edición
                                    }
                                });
                            });
                        }
                    });
                });

                if (event.key === "Enter") {
                    const rows = tableBody.querySelectorAll("tr");
                    if (rows.length > 5) {
                        for (let i = 5; i < rows.length; i++) {
                            rows[i].style.display = "none";
                        }
                    }
                }
            });
    } else {
        tableBody.innerHTML = ""; // Clear table content if search is empty
    }
});
