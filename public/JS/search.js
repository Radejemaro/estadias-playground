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
