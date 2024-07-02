export class search {
    constructor(url, input, tableBody) {
        this.url = url;
        this.input = input;
        this.tableBody = tableBody;
    }

    InputSearch() {
        this.input.addEventListener("keyup", () => {
            let query = this.input.value;

            if (query !== "") {
                fetch(`${this.url}?valor=${query}`)
                    .then((response) => response.json())
                    .then((data) => {
                        this.tableBody.innerHTML = "";
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
                            this.tableBody.appendChild(tr);

                            tr.addEventListener("click", function () {
                                const infoRow = this.nextElementSibling;
                                if (
                                    infoRow &&
                                    infoRow.classList.contains("info-row")
                                ) {
                                    infoRow.remove();
                                } else {
                                    fetch(`/computers/${item.id}`)
                                        .then((response) => response.json())
                                        .then((data) => {
                                            let detailsRow =
                                                document.createElement("tr");
                                            detailsRow.classList.add(
                                                "info-row"
                                            );
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

                        if (this.input.key === "Enter") {
                            const rows = this.tableBody.querySelectorAll("tr");
                            if (rows.length > 5) {
                                for (let i = 5; i < rows.length; i++) {
                                    rows[i].style.display = "none";
                                }
                            }
                        }
                    });
            } else {
                this.tableBody.innerHTML = "";
            }
        });
    }
}
