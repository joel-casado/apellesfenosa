function search() {
    var input, filter, table_body, tr, td, i, j, txtValue;
    input = document.getElementById("q"); //campo de busqueda
    filter = input.value.toUpperCase(); //PAsa a mayuscula el texto
    table_body = document.getElementById("the_table_body"); //
    tr = table_body.getElementsByTagName("tr"); //obtienen todas las filas

    for (i = 0; i < tr.length; i++) {
        let rowMatches = false;  // Variable para verificar si hay coincidencia en la fila
        td = tr[i].getElementsByTagName("td"); //guarda las celdas de la fila 

        for (j = 0; j < td.length; j++) {
            if (td[j]) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    rowMatches = true; // Si encuentra coincidencia en alguna celda, marcar como true
                    break; // Dejar de buscar en esta fila si ya hay coincidencia
                }
            }
        }
        
        // Mostrar la fila si hay coincidencia, ocultarla si no la hay
        tr[i].style.display = rowMatches ? "" : "none";
    }
}
document.getElementById('q').addEventListener('keyup', function () {
    search(); // Esta es la función que ya tienes implementada para la búsqueda
    toggleGeneratePdfButton(); // Verifica si el botón debe habilitarse
});

// Habilita/deshabilita el botón según el estado de la tabla
function toggleGeneratePdfButton() {
    const tableBody = document.getElementById('the_table_body');
    const rows = tableBody.querySelectorAll('tr');
    const generatePdfButton = document.getElementById('generate-pdf');

    // Verifica si alguna fila está visible
    const hasVisibleRows = Array.from(rows).some(row => row.style.display !== 'none');

    // Habilita o deshabilita el botón
    generatePdfButton.disabled = !hasVisibleRows;

    // Opcional: cambia el estilo del botón
    generatePdfButton.classList.toggle('disabled', !hasVisibleRows);
}
// Antes de enviar el formulario, llena el campo hidden con los datos visibles
document.getElementById('generate-pdf').addEventListener('click', function () {
    const tableBody = document.getElementById('the_table_body');
    const rows = tableBody.querySelectorAll('tr');
    const filteredData = [];

    // Recorre las filas visibles y extrae sus datos
    rows.forEach(row => {
        if (row.style.display !== 'none') {
            const rowData = {};
            const cells = row.querySelectorAll('td');
            rowData.imagen_url = cells[0].querySelector('img')?.src || '';
            rowData.numero_registro = cells[1]?.textContent.trim();
            rowData.titulo = cells[2]?.textContent.trim();
            rowData.nombre_autor = cells[3]?.textContent.trim();
            rowData.texto_tecnica = cells[4]?.textContent.trim();
            rowData.ubicacion = cells[5]?.textContent.trim();
            rowData.texto_material = cells[6]?.textContent.trim();
            filteredData.push(rowData);
        }
    });

    // Asigna los datos visibles al campo hidden
    document.getElementById('filteredData').value = JSON.stringify(filteredData);
});
function toggleGeneratePdfButton() {
    const tableBody = document.getElementById('the_table_body');
    const rows = tableBody.querySelectorAll('tr');
    const generatePdfButton = document.getElementById('generate-pdf');

    // Verifica si alguna fila está visible
    const hasVisibleRows = Array.from(rows).some(row => row.style.display !== 'none');

    // Habilita o deshabilita el botón
    generatePdfButton.disabled = !hasVisibleRows;

    // Cambia el estilo del botón
    if (hasVisibleRows) {
        generatePdfButton.classList.add('active'); // Agrega la clase activa
    } else {
        generatePdfButton.classList.remove('active'); // Remueve la clase activa
    }
}

