document.addEventListener('DOMContentLoaded', function () {
    const rows = document.querySelectorAll('tbody tr');
    rows.forEach(row => {
        row.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            fetch(`Categorias/Computers/${id}`)
                .then(response => response.json())
                .then(data => {
                    const infoDiv = document.getElementById('info');
                    infoDiv.innerHTML = `
                        <p><strong>Articulo:</strong> ${data.NOMBRE_PC}</p>
                        <p><strong>No.Serie:</strong> ${data.No_SERIE}</p>
                        <p><strong>Modelo:</strong> ${data.MODELO_PC}</p>
                        <p><strong>Tipo:</strong> ${data.TIPO}</p>
                        <p><strong>Marca:</strong> ${data.DIVISION}</p>
                        <!-- Agrega más campos aquí -->
                    `;
                    infoDiv.style.display = 'block';
                });
        });
    });
});
