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
                        tr.setAttribute("data-id", item.id);
                        tr.innerHTML = `
                            <td>${item.COLEGA}</td>
                            <td>${item.CUENTA}</td>
                            <td>
                                <div class="password-wrapper">
                                    <input type="password" class="password-wrapper" value="${item.ACOUNT_PASSWORD}" readonly>
                                    <i class="fas fa-eye toggle-password"></i>
                                </div>
                            </td>
                            <td>
                                <div class="password-wrapper">
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
                }
            })
            .catch((error) => console.error("Error:", error));
    });

    $("#mysearch").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#tablet-table tbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    $("#edit-modal, #quick-add-modal").on("hide.bs.modal", function () {
        $("#edit-COLEGA, #edit-CUENTA, #edit-ACOUNT_PASSWORD, #edit-PIN_DESBLOQUEO, #edit-MARCA, #edit-MODELO, #edit-AREA").val("");
    });
});
