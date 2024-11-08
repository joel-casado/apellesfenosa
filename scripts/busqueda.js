function search(){
    var input, filter, table_body, tr, td, i, txtValue;
    input = document.getElementById("q");
    filter = input.value.toUpperCase();
    table_body = document.getElementById("the_table_body");
    tr = table_body.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[3]; // Índice 3 para la columna "Título"
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
