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
