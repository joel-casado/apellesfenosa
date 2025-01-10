function search() {
    const input = document.getElementById("q");
    const filter = normalizeText(input.value.toUpperCase());
    const table_body = document.getElementById("the_table_body");
    const tr = table_body.getElementsByTagName("tr");

    for (let i = 0; i < tr.length; i++) {
        let rowMatches = false;
        const td = tr[i].getElementsByTagName("td");

        for (let j = 0; j < td.length; j++) {
            if (td[j]) {
                const txtValue = normalizeText(td[j].textContent || td[j].innerText);
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    rowMatches = true;
                    break;
                }
            }
        }
        tr[i].style.display = rowMatches ? "" : "none";
    }
}

function normalizeText(text) {
    return text.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
}

document.getElementById('q').addEventListener('keyup', function () {
    search();
    toggleGeneratePdfButton();
});

document.getElementById('q').addEventListener('keypress', function (event) {
    if (event.key === 'Enter') {
        event.preventDefault();
    }
});

function toggleGeneratePdfButton() {
    const rows = document.getElementById('the_table_body').querySelectorAll('tr');
    const generatePdfButton = document.getElementById('generate-pdf');
    const hasVisibleRows = Array.from(rows).some(row => row.style.display !== 'none');
    generatePdfButton.disabled = !hasVisibleRows;
    generatePdfButton.classList.toggle('disabled', !hasVisibleRows);
}

document.getElementById('generate-pdf').addEventListener('click', function () {
    const rows = document.getElementById('the_table_body').querySelectorAll('tr');
    const filteredData = [];

    rows.forEach(row => {
        if (row.style.display !== 'none') {
            const cells = row.querySelectorAll('td');
            filteredData.push({
                imagen_url: cells[0].querySelector('img')?.src || '',
                numero_registro: cells[1]?.textContent.trim(),
                titulo: cells[2]?.textContent.trim(),
                nombre_autor: cells[3]?.textContent.trim(),
                texto_tecnica: cells[4]?.textContent.trim(),
                ubicacion: cells[5]?.textContent.trim(),
                texto_material: cells[6]?.textContent.trim()
            });
        }
    });

    document.getElementById('filteredData').value = JSON.stringify(filteredData);
});