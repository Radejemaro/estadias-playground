document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('mysearch');
    const tableBody = document.querySelector('#yubikey-table tbody');

    searchInput.addEventListener('keyup', function () {
        const query = searchInput.value.trim();
        fetch(`/search/yubi?valor=${query}`)
            .then(response => response.json())
            .then(data => {
                tableBody.innerHTML = ''; // Limpiar el contenido actual de la tabla
                if (data.estado === 1) {
                    const results = data.result;
                    results.forEach(item => {
                        let tr = document.createElement('tr');
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
                    });
                }
            })
            .catch(error => console.error('Error:', error));
    });
});
