document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("mysearch");
    const tableBody = document.querySelector("#printer-table tbody");

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
                            <td>${item.No_SERIE}</td>
                            <td>${item.IP_USB}</td>
                            <td>${item.MAC_ACTIVA}</td>
                            <td>${item.TIPO}</td>
                            <td>${item.MARCA}</td>
                            <td>${item.UBICACION}</td>
                            <td>${item.DEPARTAMENTO}</td>
                        `;
                        tableBody.appendChild(tr);
                    });
                }
            })
            .catch(error => console.error("Error:", error));
    });

    $(document).ready(function () {
        $("#menu_derecho").hide();
        $("#edit-modal").hide();
        $("#quick-add-modal").hide();

        let currentRow;
        let currentRowId;

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

        $("#edit").click(function () {
            $("#edit-modal").show();
            $("#edit-No_SERIE").val(currentRow.find("td:eq(0)").text());
            $("#edit-IP_USB").val(currentRow.find("td:eq(1)").text());
            $("#edit-MAC_ACTIVA").val(currentRow.find("td:eq(2)").text());
            $("#edit-TIPO").val(currentRow.find("td:eq(3)").text());
            $("#edit-MARCA").val(currentRow.find("td:eq(4)").text());
            $("#edit-UBICACION").val(currentRow.find("td:eq(5)").text());
            $("#edit-DEPARTAMENTO").val(currentRow.find("td:eq(6)").text());
        });

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
                        currentRow.find("td:eq(0)").text(data.data.No_SERIE);
                        currentRow.find("td:eq(1)").text(data.data.IP_USB);
                        currentRow.find("td:eq(2)").text(data.data.MAC_ACTIVA);
                        currentRow.find("td:eq(3)").text(data.data.TIPO);
                        currentRow.find("td:eq(4)").text(data.data.MARCA);
                        currentRow.find("td:eq(5)").text(data.data.UBICACION);
                        currentRow.find("td:eq(6)").text(data.data.DEPARTAMENTO);
                        $("#edit-modal").hide();
                    } else {
                        alert("Error al actualizar el registro.");
                    }
                },
            });
        });

        $("#quick-add-button").click(function () {
            $("#quick-add-modal").show();
        });

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
                            <td>${data.data.No_SERIE}</td>
                            <td>${data.data.IP_USB}</td>
                            <td>${data.data.MAC_ACTIVA}</td>
                            <td>${data.data.TIPO}</td>
                            <td>${data.data.MARCA}</td>
                            <td>${data.data.UBICACION}</td>
                            <td>${data.data.DEPARTAMENTO}</td>
                        `;
                        tableBody.appendChild(newRow);
                        $("#quick-add-modal").hide();
                    } else {
                        alert("Error al agregar la impresora.");
                    }
                },
            });
        });

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
