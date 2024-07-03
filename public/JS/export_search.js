export class search {
  constructor(url, inputField, tableBody) {
    this.url = url;
    this.inputField = inputField;
    this.tableBody = tableBody;
  }

  initSearch() {
    this.inputField.addEventListener("keyup", () => {
      const query = this.inputField.value.trim();

      if (query !== "") {
        this.fetchAndDisplayResults(query);
      } else {
        this.clearTable();
      }
    });
  }

  fetchAndDisplayResults(query) {
    fetch(`${this.url}?valor=${query}`)
      .then((response) => response.json())
      .then((data) => {
        this.clearTable();
        data.result.forEach((item) => {
          this.addRowToTable(item);
          this.addRowClickListener(item);
        });

        if (this.inputField.key === "Enter") {
          this.limitTableRows();
        }
      });
  }

  addRowToTable(item) {
    const row = document.createElement("tr");
    row.setAttribute("data-id", item.id);
    row.innerHTML = `
      <td>${item.NOMBRE_PC}</td>
      <td>${item.No_SERIE}</td>
      <td>${item.MODELO_PC}</td>
      <td>${item.TIPO}</td>
      <td>${item.PUESTO}</td>
    `;
    this.tableBody.appendChild(row);
  }

  addRowClickListener(item) {
    const row = this.tableBody.querySelector(`tr[data-id="${item.id}"]`);
    row.addEventListener("click", () => {
      this.toggleRowDetails(row, item);
    });
  }

  toggleRowDetails(row, item) {
    const detailsRow = row.nextElementSibling;
    if (detailsRow && detailsRow.classList.contains("info-row")) {
      detailsRow.remove();
    } else {
      this.fetchAndDisplayRowDetails(row, item);
    }
  }

  fetchAndDisplayRowDetails(row, item) {
    fetch(`/computers/${item.id}`)
      .then((response) => response.json())
      .then((data) => {
        const detailsRow = document.createElement("tr");
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
        row.parentNode.insertBefore(detailsRow, row.nextSibling);
      });
  }

  clearTable() {
    this.tableBody.innerHTML = "";
  }

  limitTableRows() {
    const rows = this.tableBody.querySelectorAll("tr");
    if (rows.length > 5) {
      for (let i = 5; i < rows.length; i++) {
        rows[i].style.display = "none";
      }
    }
  }
}
