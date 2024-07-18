document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("mysearch");
    const tableBody = document.querySelector("#printers-table tbody");

    searchInput.addEventListener("keyup", function () {
        const query = searchInput.value.trim();
        fetch(`/search/printers?valor=${query}`)
            .then(response => response.json())
            .then(data => {
                tableBody.innerHTML = "";
                if (data.estado === 1) {
                    const results = data.result;
                    results.forEach(item => {
                        let tr = document.createElement("tr");
                        tr.setAttribute("data-id", item.id);
                        tr.innerHTML = `
                            <td>${item.TIPO}</td>
                            <td>${item.COLEGA}</td>
                            <td>${item.MODELO}</td>
                        `;
                        tableBody.appendChild(tr);
                        $(document).ready(function () {
                            // Ocultamos el menú al cargar la página
                            $("#menu_derecho").hide();
                            $("#edit-modal").hide();
                            $("#quick-add-modal").hide();

                            var currentRow;
                            var currentRowId;

                            // Click derecho para mostrar menú
                            $("table td").bind("contextmenu", function (e) {
                                currentRow = $(this).closest("tr");
                                currentRowId = currentRow.data("id");
                                $("#menu_derecho").css({
                                    display: "block",
                                    left: e.pageX,
                                    top: e.pageY,
                                });
                                return false;
                            });

                            // Editar
                            $("#edit").click(function () {
                                $("#edit-modal").show();
                                $("#edit-TIPO").val(currentRow.find("td:eq(0)").text());
                                $("#edit-COLEGA").val(currentRow.find("td:eq(1)").text());
                                $("#edit-MODELO").val(currentRow.find("td:eq(2)").text());
                                $("#edit-id").val(currentRowId);
                            });

                            // Guardar cambios
                            $("#edit-form").submit(function (event) {
                                event.preventDefault();
                                const formData = $(this).serialize();
                                $.ajax({
                                    url: `/printers/update/${currentRowId}`,
                                    type: "POST",
                                    data: formData,
                                    headers: {
                                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                                    },
                                    success: function (data) {
                                        if (data.status === "success") {
                                            currentRow.find("td:eq(0)").text(data.data.TIPO);
                                            currentRow.find("td:eq(1)").text(data.data.COLEGA);
                                            currentRow.find("td:eq(2)").text(data.data.MODELO);
                                            $("#edit-modal").hide();
                                        } else {
                                            alert("Error al actualizar el registro.");
                                        }
                                    },
                                });
                            });

                            // Agregar rápidamente
                            $("#quick-add-form").submit(function (event) {
                                event.preventDefault();
                                const formData = $(this).serialize();
                                $.ajax({
                                    url: `/printers/create`,
                                    type: "POST",
                                    data: formData,
                                    headers: {
                                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                                    },
                                    success: function (data) {
                                        if (data.status === "success") {
                                            let newRow = document.createElement("tr");
                                            newRow.setAttribute("data-id", data.data.id);
                                            newRow.innerHTML = `
                                                <td>${data.data.TIPO}</td>
                                                <td>${data.data.COLEGA}</td>
                                                <td>${data.data.MODELO}</td>
                                            `;
                                            tableBody.appendChild(newRow);
                                            $("#quick-add-modal").hide();
                                        } else {
                                            alert("Error al agregar la impresora.");
                                        }
                                    },
                                });
                            });

                            // Eliminar
                            $("#delete").click(function () {
                                var id = currentRow.data("id");
                                if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
                                    $.ajax({
                                        url: `/printers/delete/${id}`,
                                        type: "DELETE",
                                        headers: {
                                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
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
                        });
                    });
                }
            })
            .catch(error => console.error("Error:", error));
    });
});
